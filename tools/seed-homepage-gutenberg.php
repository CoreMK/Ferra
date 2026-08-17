<?php
/** Creates an editable Gutenberg home page and assigns it as the site front page. */
require '/var/www/html/wp-load.php';

$content = <<<'BLOCKS'
<!-- wp:group {"tagName":"section","className":"ferreta-home-hero"} -->
<section class="wp-block-group ferreta-home-hero"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">FERRETA DECOR / OBJECTS FOR LIVING</p><!-- /wp:paragraph --><!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Декор, що надає<br>простору <em>характер.</em></h1><!-- /wp:heading --><!-- wp:paragraph --><p>Виразні предмети для дому, тераси та бізнесу: світло, меблі, лофт-об’єкти й малі деталі, які хочеться розглядати.</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"url":"/shop/"} --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/shop/">Переглянути каталог</a></div><!-- /wp:button --><!-- wp:button {"url":"/project-request/","className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/project-request/">Підібрати декор для проєкту</a></div><!-- /wp:button --></div><!-- /wp:buttons --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ferreta-home-tiles"} -->
<section class="wp-block-group ferreta-home-tiles"><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">01 / КОЛЕКЦІЯ</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Світлові<br>об’єкти</h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/product-category/decorative-lighting/">Дивитися предмети →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">02 / НАПРЯМИ</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Меблі, лофт<br>і малий декор</h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/spaces/">Обрати категорію →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">03 / ПРОЄКТ</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Декор для<br>вашого простору</h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/project-request/">Підібрати рішення →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ferreta-home-categories"} -->
<section class="wp-block-group ferreta-home-categories"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">ОБИРАЙТЕ ЗА КАТЕГОРІЄЮ</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Один простір.<br>Багато <em>виразних деталей.</em></h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/spaces/">Усі категорії декору →</a></p><!-- /wp:paragraph --><!-- wp:shortcode -->[ferreta_home_categories]<!-- /wp:shortcode --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ferreta-home-products"} -->
<section class="wp-block-group ferreta-home-products"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">РЕАЛЬНІ ПРЕДМЕТИ В КАТАЛОЗІ</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Почніть із<br><em>однієї деталі.</em></h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/shop/">Увесь каталог →</a></p><!-- /wp:paragraph --><!-- wp:shortcode -->[ferreta_featured_products]<!-- /wp:shortcode --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ferreta-home-b2b"} -->
<section class="wp-block-group ferreta-home-b2b"><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">FERRETA PROFESSIONAL</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Декор для тих,<br>хто створює <em>враження.</em></h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p>Працюємо з дизайнерами, архітекторами, HoReCa, девелоперами й дилерами: допомагаємо підібрати предмети під сценарій, бюджет і характер об’єкта.</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"url":"/b2b/"} --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/b2b/">Для дизайнерів і бізнесу</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:column --></div><!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ferreta-home-journal"} -->
<section class="wp-block-group ferreta-home-journal"><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">ПРО БРЕНД</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Декор не займає<br>простір. Він його <em>збирає.</em></h2><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/about/">Історія Ferreta →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"className":"kicker"} --><p class="kicker">ЖУРНАЛ</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Як поєднувати світло, меблі й малий декор без візуального шуму</h3><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/journal/">Читати →</a></p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Предмети, з яких починається характер тераси чи інтер’єру</h3><!-- /wp:heading --><!-- wp:paragraph --><p><a href="/journal/">Читати →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></section>
<!-- /wp:group -->
BLOCKS;

$page = get_page_by_path('home');
$id = wp_insert_post(['ID' => $page?->ID ?? 0, 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => 'Головна', 'post_name' => 'home', 'post_content' => $content], true);
if (is_wp_error($id)) {
    throw new RuntimeException($id->get_error_message());
}
update_option('show_on_front', 'page');
update_option('page_on_front', $id);
echo "Homepage {$id} is ready for Gutenberg editing.\n";
