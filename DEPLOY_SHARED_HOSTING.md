# Shared hosting deploy
PHP 8.2+, MySQL/MariaDB, SSL required. Upload WP core + this `wp-content`, create DB, set non-secret values from `.env.example` in `wp-config.php`, activate theme/plugin/WooCommerce. Enable Cloudflare Free Full (strict), daily offsite backup (14 days), 2FA and login limiting. Install only official payment/Nova Poshta plugins after owner provides keys.
