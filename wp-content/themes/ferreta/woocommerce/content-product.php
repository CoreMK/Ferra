<?php
defined('ABSPATH')||exit;
global $product;
if(empty($product)||!$product->is_visible())return;
?>
<li <?php wc_product_class('catalog-card',$product); ?>>
  <div class="catalog-card__media"><a href="<?=esc_url(get_permalink($product->get_id()))?>"><?=wp_get_attachment_image($product->get_image_id(),'woocommerce_thumbnail',false,['loading'=>'lazy'])?></a><div class="catalog-card__actions"><button type="button" data-compare="<?=$product->get_id()?>" aria-label="Порівняти">⇄</button><button type="button" data-save="<?=$product->get_id()?>" aria-label="Зберегти">♡</button></div><?php if(!$product->is_in_stock()):?><span class="catalog-card__label">Немає в наявності</span><?php endif;?></div>
  <div class="catalog-card__body"><small><?=esc_html($product->get_sku())?></small><h2><a href="<?=esc_url(get_permalink($product->get_id()))?>"><?=esc_html($product->get_name())?></a></h2><div class="catalog-card__bottom"><span><?=wp_kses_post($product->get_price_html())?></span><?php if($product->is_purchasable()&&$product->is_in_stock()):?><button class="catalog-card__add ajax_add_to_cart" type="button" data-product_id="<?=$product->get_id()?>" aria-label="Додати <?=esc_attr($product->get_name())?> до кошика">+</button><?php endif;?></div></div>
</li>
