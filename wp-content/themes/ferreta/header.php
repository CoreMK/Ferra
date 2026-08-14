<?php
if(!defined('ABSPATH'))exit;
$shop=wc_get_page_permalink('shop');
$cartCount=function_exists('WC')&&WC()->cart?WC()->cart->get_cart_contents_count():0;
?>
<!doctype html><html <?php language_attributes();?>><head><meta charset="<?php bloginfo('charset');?>"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#172019"><?php wp_head();?></head>
<body <?php body_class('ferreta');?>><?php wp_body_open(); ?>
<header class="site-header">
  <div class="utility"><span>FERRETA DECOR — предмети для дому, тераси та бізнесу</span><a href="<?=esc_url(home_url('/b2b/'))?>">B2B / Дизайнерам</a><a href="<?=esc_url(home_url('/project-request/'))?>">Запит на підбір</a></div>
  <div class="nav-shell">
    <a class="brand" href="<?=esc_url(home_url('/'))?>"><span>FERRETA</span><small>DECOR OBJECTS</small></a>
    <button class="nav-toggle" aria-label="Відкрити меню" data-nav-toggle>Меню</button>
    <nav class="primary-nav" data-nav><a class="nav-catalog" href="<?=esc_url($shop)?>">Каталог <i>+</i></a><a href="<?=esc_url(home_url('/spaces/'))?>">Категорії</a><a href="<?=esc_url(home_url('/projects/'))?>">Проєкти</a><a href="<?=esc_url(home_url('/b2b/'))?>">Для бізнесу</a><a href="<?=esc_url(home_url('/about/'))?>">Про бренд</a></nav>
    <div class="nav-actions"><button aria-label="Пошук" data-search-toggle>⌕</button><a href="<?=esc_url(home_url('/favorites/'))?>" aria-label="Обране">♡</a><a href="<?=esc_url(home_url('/compare/'))?>" aria-label="Порівняння">⇄</a><a href="<?=esc_url(wc_get_cart_url())?>" class="cart-link">Кошик <b><?=$cartCount?></b></a></div>
  </div>
  <div class="mega-menu" data-mega><div><b>КАТЕГОРІЇ</b><a href="<?=esc_url(get_term_link('decorative-lighting','product_cat'))?>">Декоративне освітлення</a><a href="<?=esc_url(get_term_link('loft-furniture','product_cat'))?>">Меблі лофт</a><a href="<?=esc_url(get_term_link('wall-decor','product_cat'))?>">Настінний декор</a></div><div><b>БІЛЬШЕ ДЕКОРУ</b><a href="<?=esc_url(get_term_link('small-decor','product_cat'))?>">Малий декор</a><a href="<?=esc_url(get_term_link('terrace-decor','product_cat'))?>">Для тераси</a><a href="<?=esc_url(home_url('/spaces/'))?>">Усі категорії</a></div><div class="mega-note"><span>FERRETA / PROJECT</span><strong>Підберемо предмети, що зберуть простір в одну історію.</strong><a href="<?=esc_url(home_url('/project-request/'))?>">Обговорити проєкт →</a></div></div>
  <form class="search-panel" data-search action="<?=esc_url(home_url('/'))?>"><label>Пошук за назвою або SKU<input name="s" type="search" autocomplete="off" placeholder="Наприклад, ST-75-1"></label><input type="hidden" name="post_type" value="product"><button>Шукати</button></form>
</header>
