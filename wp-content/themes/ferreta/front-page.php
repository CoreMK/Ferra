<?php
get_header();
$featured=wc_get_products(['status'=>'publish','limit'=>4,'orderby'=>'date','order'=>'DESC']);
$hero=$featured[0]??null;
$heroImage=$hero?wp_get_attachment_image_url($hero->get_image_id(),'large'):'';
$categoryLinks=[
 ['Декоративне освітлення','decorative-lighting','Світлові об’єкти з реального стартового каталогу.'],
 ['Меблі лофт','loft-furniture','Акцентні предмети для інтер’єру та тераси.'],
 ['Настінний декор','wall-decor','Панно, картини й об’єкти для стін.'],
 ['Малий декор','small-decor','Деталі, що завершують повсякденний простір.'],
 ['Декор для тераси','terrace-decor','Предмети для відкритого повітря.'],
 ['Для бізнесу','business-decor','HoReCa, офіси, шоуруми та проєкти.']
];
?>
<main>
<section class="hero-editorial"<?= $heroImage?' style="--hero:url('.esc_url($heroImage).')"':''?>>
  <div class="hero-copy"><p class="kicker">FERRETA DECOR / OBJECTS FOR LIVING</p><h1>Декор, що надає<br>простору <em>характер.</em></h1><p>Виразні предмети для дому, тераси та бізнесу: світло, меблі, лофт-об’єкти й малі деталі, які хочеться розглядати.</p><div><a class="button" href="<?=esc_url(wc_get_page_permalink('shop'))?>">Переглянути каталог</a><a class="button button-quiet" href="<?=esc_url(home_url('/project-request/'))?>">Підібрати декор для проєкту</a></div></div>
  <aside><span>FERRETA / 01</span><strong>Простір запам’ятовується деталями.</strong></aside>
</section>

<section class="collection-tiles"><a href="<?=esc_url(get_term_link('decorative-lighting','product_cat'))?>"><small>01 / КОЛЕКЦІЯ</small><h2>Світлові<br>об’єкти</h2><span>Дивитися предмети →</span></a><a href="<?=esc_url(home_url('/spaces/'))?>"><small>02 / НАПРЯМИ</small><h2>Меблі, лофт<br>і малий декор</h2><span>Обрати категорію →</span></a><a href="<?=esc_url(home_url('/project-request/'))?>"><small>03 / ПРОЄКТ</small><h2>Декор для<br>вашого простору</h2><span>Підібрати рішення →</span></a></section>

<section class="space-section" id="spaces"><header><p class="kicker">ОБИРАЙТЕ ЗА КАТЕГОРІЄЮ</p><h2>Один простір.<br>Багато <em>виразних деталей.</em></h2><a href="<?=esc_url(home_url('/spaces/'))?>">Усі категорії декору →</a></header><div class="space-grid"><?php foreach($categoryLinks as $i=>[$name,$slug,$description]):$term=get_term_by('slug',$slug,'product_cat');$link=$term?get_term_link($term):home_url('/spaces/');?> <a href="<?=esc_url($link)?>"><span>0<?=$i+1?></span><strong><?=$name?></strong><i>→</i></a><?php endforeach;?></div></section>

<section class="product-showcase"><div class="section-head"><p class="kicker">РЕАЛЬНІ ПРЕДМЕТИ В КАТАЛОЗІ</p><h2>Почніть із<br><em>однієї деталі.</em></h2><a href="<?=esc_url(wc_get_page_permalink('shop'))?>">Увесь каталог →</a></div><div class="editorial-products"><?php foreach($featured as $product):?><article><a href="<?=esc_url(get_permalink($product->get_id()))?>"><?=wp_get_attachment_image($product->get_image_id(),'medium',false,['loading'=>'lazy'])?></a><div><small><?=esc_html($product->get_sku())?></small><h3><?=esc_html($product->get_name())?></h3><p><?=wp_kses_post($product->get_price_html())?></p><button type="button" class="buy-link ajax_add_to_cart" data-product_id="<?=$product->get_id()?>">До кошика <span>+</span></button></div></article><?php endforeach;?></div></section>

<section class="sets"><div class="section-head"><p class="kicker">ДЛЯ БУДИНКУ Й БІЗНЕСУ</p><h2>Предмети<br>краще звучать <em>разом.</em></h2></div><div class="set-list"><a href="<?=esc_url(home_url('/project-request/'))?>"><small>ПРИВАТНИЙ ПРОСТІР</small><h3>Дім, сад або тераса</h3><span>Створити добірку →</span></a><a href="<?=esc_url(home_url('/project-request/'))?>"><small>ПРОФЕСІЙНИЙ ПРОЄКТ</small><h3>Ресторан, готель чи шоурум</h3><span>Обговорити декор →</span></a><a href="<?=esc_url(home_url('/b2b/'))?>"><small>СПІВПРАЦЯ</small><h3>Для дизайнерів і архітекторів</h3><span>Умови B2B →</span></a></div></section>

<section class="b2b-band"><div><p class="kicker">FERRETA PROFESSIONAL</p><h2>Декор для тих,<br>хто створює <em>враження.</em></h2></div><div><p>Працюємо з дизайнерами, архітекторами, HoReCa, девелоперами й дилерами: допомагаємо підібрати предмети під сценарій, бюджет і характер об’єкта.</p><a class="button" href="<?=esc_url(home_url('/b2b/'))?>">Для дизайнерів і бізнесу</a></div></section>

<section class="brand-journal"><div><p class="kicker">ПРО БРЕНД</p><h2>Декор не займає<br>простір. Він його <em>збирає.</em></h2><a href="<?=esc_url(home_url('/about/'))?>">Історія Ferreta →</a></div><div><p class="kicker">ЖУРНАЛ</p><a href="<?=esc_url(home_url('/journal/'))?>"><small>ІДЕЇ ДЛЯ ПРОСТОРУ</small><h3>Як поєднувати світло, меблі й малий декор без візуального шуму</h3><span>Читати →</span></a><a href="<?=esc_url(home_url('/journal/'))?>"><small>ДЕТАЛІ</small><h3>Предмети, з яких починається характер тераси чи інтер’єру</h3><span>Читати →</span></a></div></section>
</main>
<?php get_footer(); ?>
