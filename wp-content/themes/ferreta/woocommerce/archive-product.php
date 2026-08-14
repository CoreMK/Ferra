<?php get_header();
$current=get_queried_object();
$title=is_product_category()?$current->name:'Каталог декору';
$description=is_product_category()?$current->description:'Світло, меблі, лофт-об’єкти й малі деталі для дому, тераси та бізнесу.';
$categories=get_terms(['taxonomy'=>'product_cat','hide_empty'=>false,'exclude'=>get_option('default_product_cat')]);
?>
<main class="shop-page">
  <header class="shop-hero"><div><p class="kicker">FERRETA DECOR / КАТАЛОГ</p><h1><?=esc_html($title)?></h1><p><?=esc_html($description)?></p></div><a class="shop-project-link" href="<?=esc_url(home_url('/project-request/'))?>">Потрібна добірка для простору? <b>→</b></a></header>
  <nav class="shop-categories" aria-label="Категорії каталогу"><a class="<?=is_shop()?'is-active':''?>" href="<?=esc_url(wc_get_page_permalink('shop'))?>">Усе</a><?php foreach($categories as $category):$link=get_term_link($category);if(is_wp_error($link))continue;?><a class="<?=is_product_category($category->term_id)?'is-active':''?>" href="<?=esc_url($link)?>"><?=esc_html($category->name)?><small><?=$category->count?></small></a><?php endforeach;?></nav>
  <div class="shop-toolbar"><div><?php woocommerce_result_count(); ?></div><div><?php woocommerce_catalog_ordering(); ?></div></div>
  <?php if(woocommerce_product_loop()): ?><ul class="products columns-4 shop-products"><?php while(have_posts()):the_post();wc_get_template_part('content','product');endwhile;?></ul><div class="shop-pagination"><?php woocommerce_pagination(); ?></div><?php else: ?><section class="shop-empty"><p class="kicker">КАТЕГОРІЯ НАПОВНЮЄТЬСЯ</p><h2>Ця добірка скоро з’явиться у каталозі.</h2><p>Опишіть ваш простір — менеджер підкаже доступні предмети або прийме проєктний запит.</p><a class="button" href="<?=esc_url(home_url('/project-request/'))?>">Надіслати запит</a></section><?php endif; ?>
</main>
<?php get_footer(); ?>
