<?php
get_header();
while(have_posts()):the_post();
$product=wc_get_product(get_the_ID());
if(!$product)continue;
$images=array_values(array_filter(array_merge([$product->get_image_id()],$product->get_gallery_image_ids())));
$mainImage=$images[0]??0;
$categories=wc_get_product_category_list($product->get_id(),', ');
$relatedIds=wc_get_related_products($product->get_id(),4);
?>
<main class="product-page">
  <nav class="product-breadcrumb"><a href="<?=esc_url(wc_get_page_permalink('shop'))?>">Каталог</a><span>/</span><span><?=wp_kses_post($categories ?: 'Декор')?></span><span>/</span><b><?=esc_html($product->get_name())?></b></nav>
  <article class="product-layout">
    <section class="product-gallery-custom">
      <div class="product-image-main"><?=wp_get_attachment_image($mainImage,'large',false,['class'=>'product-main-image','loading'=>'eager'])?></div>
      <?php if(count($images)>1):?><div class="product-thumbnails"><?php foreach($images as $imageId):?><button type="button" data-product-image="<?=esc_url(wp_get_attachment_image_url($imageId,'large'))?>" aria-label="Показати фото товару"><?=wp_get_attachment_image($imageId,'thumbnail')?></button><?php endforeach;?></div><?php endif;?>
    </section>
    <section class="product-summary-custom">
      <p class="kicker">FERRETA DECOR / <?=esc_html($product->get_sku())?></p>
      <h1><?=esc_html($product->get_name())?></h1>
      <div class="product-price-custom"><?=wp_kses_post($product->get_price_html())?></div>
      <p class="product-stock <?=$product->is_in_stock()?'in-stock':'out-of-stock'?>"><?=$product->is_in_stock()?'В наявності':'Немає в наявності'?></p>
      <?php if($product->get_short_description()):?><div class="product-description-custom"><?=wp_kses_post(wpautop($product->get_short_description()))?></div><?php endif;?>
      <div class="product-purchase"><?php woocommerce_template_single_add_to_cart(); ?></div>
      <div class="product-actions"><button type="button" data-save="<?=$product->get_id()?>">♡ Зберегти</button><button type="button" data-compare="<?=$product->get_id()?>">⇄ Порівняти</button></div>
      <dl class="product-details"><div><dt>SKU</dt><dd><?=esc_html($product->get_sku())?></dd></div><div><dt>Категорія</dt><dd><?=wp_kses_post($categories ?: 'Декор')?> </dd></div><?php foreach($product->get_attributes() as $attribute):?><div><dt><?=esc_html(wc_attribute_label($attribute->get_name()))?></dt><dd><?=esc_html(implode(', ',$attribute->get_options()))?></dd></div><?php endforeach;?></dl>
      <a class="product-project-link" href="<?=esc_url(home_url('/project-request/'))?>">Потрібна добірка для простору? <b>→</b></a>
    </section>
  </article>
  <?php if($relatedIds):?><section class="related-custom"><div class="section-head"><p class="kicker">ДОПОВНІТЬ КОМПОЗИЦІЮ</p><h2>Схожі <em>предмети.</em></h2><a href="<?=esc_url(wc_get_page_permalink('shop'))?>">Увесь каталог →</a></div><div class="related-grid"><?php foreach($relatedIds as $relatedId):$related=wc_get_product($relatedId);if(!$related)continue;?><article><a href="<?=esc_url(get_permalink($relatedId))?>"><?=wp_get_attachment_image($related->get_image_id(),'medium',false,['loading'=>'lazy'])?></a><div><small><?=esc_html($related->get_sku())?></small><h3><a href="<?=esc_url(get_permalink($relatedId))?>"><?=esc_html($related->get_name())?></a></h3><p><?=wp_kses_post($related->get_price_html())?></p><button class="related-add ajax_add_to_cart" type="button" data-product_id="<?=$related->get_id()?>">До кошика <span>+</span></button></div></article><?php endforeach;?></div></section><?php endif;?>
</main>
<?php endwhile; get_footer(); ?>
