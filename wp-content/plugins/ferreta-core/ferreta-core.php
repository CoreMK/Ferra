<?php
/** Plugin Name: Ferreta Core; Version: 1.1 */
declare(strict_types=1);

namespace Ferreta;

if (!defined('ABSPATH')) {
    exit;
}

final class Core {
    public static function boot(): void {
        add_action('init', [self::class, 'init']);
        add_action('rest_api_init', [self::class, 'rest']);
        add_action('woocommerce_product_options_inventory_product_data', [self::class, 'fields']);
        add_action('woocommerce_admin_process_product_object', [self::class, 'save']);
        add_action('woocommerce_order_status_changed', [self::class, 'order'], 10, 4);
        add_action('woocommerce_checkout_create_order', [self::class, 'utm'], 10, 2);
    }

    public static function init(): void {
        register_post_type('ferreta_lead', ['label' => 'Заявки Ferreta', 'public' => false, 'show_ui' => true, 'supports' => ['title', 'editor']]);
        register_post_type('ferreta_project', ['label' => 'Проєкти', 'public' => true, 'show_ui' => true, 'supports' => ['title', 'editor', 'thumbnail']]);
        foreach (['height' => 'Висота', 'style' => 'Колекція', 'color' => 'Колір', 'space' => 'Простір'] as $key => $label) {
            register_taxonomy('pa_' . $key, 'product', ['label' => $label, 'public' => true, 'show_ui' => true]);
        }
        if (!get_role('ferreta_sales')) {
            add_role('ferreta_sales', 'Менеджер продажів', ['read' => true, 'edit_ferreta_leads' => true]);
            add_role('ferreta_content', 'Контент-менеджер', ['read' => true, 'edit_posts' => true, 'upload_files' => true, 'edit_products' => true]);
            add_role('ferreta_warehouse', 'Склад/виробництво', ['read' => true, 'edit_products' => true]);
        }
    }

    public static function rest(): void {
        register_rest_route('ferreta/v1', '/lead', ['methods' => 'POST', 'callback' => [self::class, 'lead'], 'permission_callback' => '__return_true']);
    }

    public static function lead(\WP_REST_Request $request): \WP_REST_Response|\WP_Error {
        $submitted = $request->get_json_params();
        if (empty($submitted['name']) || empty($submitted['phone']) || empty($submitted['consent'])) {
            return new \WP_Error('required', 'Заповніть обов’язкові поля', ['status' => 422]);
        }

        $fields = [
            'type' => 'Тип заявки',
            'name' => 'Ім’я',
            'phone' => 'Телефон',
            'email' => 'Email',
            'object_type' => 'Тип об’єкта',
            'comment' => 'Опис / коментар',
            'consent' => 'Згода на обробку даних',
            'utm_source' => 'UTM source',
            'utm_medium' => 'UTM medium',
            'utm_campaign' => 'UTM campaign',
        ];
        $values = [];
        foreach ($fields as $key => $label) {
            $values[$key] = $key === 'comment'
                ? sanitize_textarea_field($submitted[$key] ?? '')
                : sanitize_text_field($submitted[$key] ?? '');
        }
        $values['consent'] = !empty($submitted['consent']) ? 'Так' : 'Ні';

        $lead_id = wp_insert_post([
            'post_type' => 'ferreta_lead',
            'post_status' => 'publish',
            'post_title' => $values['name'],
        ]);
        if (is_wp_error($lead_id) || !$lead_id) {
            return new \WP_Error('lead_create_failed', 'Не вдалося створити заявку', ['status' => 500]);
        }

        foreach ($values as $key => $value) {
            update_post_meta($lead_id, '_ferreta_' . $key, $value);
        }
        update_post_meta($lead_id, '_ferreta_status', 'new');

        $message = "🔔 Нова заявка #{$lead_id}";
        foreach ($fields as $key => $label) {
            $value = $values[$key];
            $message .= "\n{$label}: " . ($value !== '' ? $value : '—');
        }
        self::tg($message);

        return new \WP_REST_Response(['id' => $lead_id], 201);
    }

    public static function fields(): void {
        woocommerce_wp_text_input(['id' => '_ferreta_barcode', 'label' => 'Штрихкод']);
        woocommerce_wp_text_input(['id' => '_ferreta_cost', 'label' => 'Собівартість', 'type' => 'number']);
        woocommerce_wp_text_input(['id' => '_ferreta_min_stock', 'label' => 'Мінімальний залишок', 'type' => 'number']);
    }

    public static function save(\WC_Product $product): void {
        foreach (['_ferreta_barcode', '_ferreta_cost', '_ferreta_min_stock'] as $key) {
            $product->update_meta_data($key, wc_clean($_POST[$key] ?? ''));
        }
    }

    public static function utm(\WC_Order $order, array $data): void {
        foreach (['utm_source', 'utm_medium', 'utm_campaign'] as $key) {
            if (isset($_COOKIE[$key])) {
                $order->update_meta_data('_ferreta_' . $key, sanitize_text_field($_COOKIE[$key]));
            }
        }
    }

    public static function order(int $order_id, string $from, string $to, \WC_Order $order): void {
        if (in_array($to, ['processing', 'completed'], true)) {
            self::tg("💳 Оплачено #{$order_id}");
        }
    }

    private static function tg(string $text): void {
        $token = defined('FERRETA_TELEGRAM_BOT_TOKEN') ? FERRETA_TELEGRAM_BOT_TOKEN : '';
        $chats = defined('FERRETA_TELEGRAM_CHAT_IDS') ? array_filter(array_map('trim', explode(',', FERRETA_TELEGRAM_CHAT_IDS))) : [];
        if (!$token || !$chats) {
            error_log('[Ferreta] Telegram test mode: ' . $text);
            return;
        }
        foreach ($chats as $chat) {
            $response = wp_remote_post("https://api.telegram.org/bot{$token}/sendMessage", [
                'timeout' => 15,
                'body' => ['chat_id' => $chat, 'text' => $text],
            ]);
            if (is_wp_error($response) || wp_remote_retrieve_response_code($response) >= 300) {
                error_log('[Ferreta] Telegram error: ' . (is_wp_error($response) ? $response->get_error_message() : wp_remote_retrieve_response_code($response)));
            }
        }
    }
}

Core::boot();
