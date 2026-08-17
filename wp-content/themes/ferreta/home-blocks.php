<?php
/** Gutenberg building blocks for the editable Ferreta homepage. */

function ferreta_home_block_defaults(): array {
	return [
		'hero' => ['kicker'=>'FERRETA DECOR / OBJECTS FOR LIVING','title'=>'Декор, що надає<br>простору <em>характер.</em>','copy'=>'Виразні предмети для дому, тераси та бізнесу: світло, меблі, лофт-об’єкти й малі деталі, які хочеться розглядати.','primaryLabel'=>'Переглянути каталог','primaryUrl'=>'/shop/','secondaryLabel'=>'Підібрати декор для проєкту','secondaryUrl'=>'/project-request/','note'=>'Простір запам’ятовується деталями.'],
		'tiles' => ['tile1Kicker'=>'01 / КОЛЕКЦІЯ','tile1Title'=>'Світлові<br>об’єкти','tile1Cta'=>'Дивитися предмети →','tile1Url'=>'/product-category/decorative-lighting/','tile2Kicker'=>'02 / НАПРЯМИ','tile2Title'=>'Меблі, лофт<br>і малий декор','tile2Cta'=>'Обрати категорію →','tile2Url'=>'/spaces/','tile3Kicker'=>'03 / ПРОЄКТ','tile3Title'=>'Декор для<br>вашого простору','tile3Cta'=>'Підібрати рішення →','tile3Url'=>'/project-request/'],
		'categories' => ['kicker'=>'ОБИРАЙТЕ ЗА КАТЕГОРІЄЮ','title'=>'Один простір.<br>Багато <em>виразних деталей.</em>','cta'=>'Усі категорії декору →','url'=>'/spaces/'],
		'products' => ['kicker'=>'РЕАЛЬНІ ПРЕДМЕТИ В КАТАЛОЗІ','title'=>'Почніть із<br><em>однієї деталі.</em>','cta'=>'Увесь каталог →','url'=>'/shop/'],
		'sets' => ['kicker'=>'ДЛЯ БУДИНКУ Й БІЗНЕСУ','title'=>'Предмети<br>краще звучать <em>разом.</em>','set1Kicker'=>'ПРИВАТНИЙ ПРОСТІР','set1Title'=>'Дім, сад або тераса','set1Cta'=>'Створити добірку →','set1Url'=>'/project-request/','set2Kicker'=>'ПРОФЕСІЙНИЙ ПРОЄКТ','set2Title'=>'Ресторан, готель чи шоурум','set2Cta'=>'Обговорити декор →','set2Url'=>'/project-request/','set3Kicker'=>'СПІВПРАЦЯ','set3Title'=>'Для дизайнерів і архітекторів','set3Cta'=>'Умови B2B →','set3Url'=>'/b2b/'],
		'b2b' => ['kicker'=>'FERRETA PROFESSIONAL','title'=>'Декор для тих,<br>хто створює <em>враження.</em>','copy'=>'Працюємо з дизайнерами, архітекторами, HoReCa, девелоперами й дилерами: допомагаємо підібрати предмети під сценарій, бюджет і характер об’єкта.','cta'=>'Для дизайнерів і бізнесу','url'=>'/b2b/'],
		'journal' => ['brandKicker'=>'ПРО БРЕНД','brandTitle'=>'Декор не займає<br>простір. Він його <em>збирає.</em>','brandCta'=>'Історія Ferreta →','brandUrl'=>'/about/','journalKicker'=>'ЖУРНАЛ','article1Title'=>'Як поєднувати світло, меблі й малий декор без візуального шуму','article1Cta'=>'Читати →','article1Url'=>'/journal/','article2Title'=>'Предмети, з яких починається характер тераси чи інтер’єру','article2Cta'=>'Читати →','article2Url'=>'/journal/'],
	];
}

function ferreta_home_render_block(array $attributes): string {
	$variant = $attributes['variant'] ?? 'hero';
	$defaults = ferreta_home_block_defaults();
	$d = $defaults[$variant] ?? $defaults['hero'];
	$a = array_merge($d, $attributes);
	$text = static fn(string $key): string => esc_html((string)($a[$key] ?? ''));
	$html = static fn(string $key): string => wp_kses_post((string)($a[$key] ?? ''));
	$url = static fn(string $key): string => esc_url((string)($a[$key] ?? ''));
	if ($variant === 'hero') { $items=wc_get_products(['status'=>'publish','limit'=>1,'orderby'=>'date','order'=>'DESC']); $image=!empty($items)?wp_get_attachment_image_url($items[0]->get_image_id(),'large'):''; ob_start(); ?>
		<section class="hero-editorial"<?= $image ? ' style="--hero:url('.esc_url($image).')"' : '' ?>><div class="hero-copy"><p class="kicker"><?= $text('kicker') ?></p><h1><?= $html('title') ?></h1><p><?= $text('copy') ?></p><div><a class="button" href="<?= $url('primaryUrl') ?>"><?= $text('primaryLabel') ?></a><a class="button button-quiet" href="<?= $url('secondaryUrl') ?>"><?= $text('secondaryLabel') ?></a></div></div><aside><span>FERRETA / 01</span><strong><?= $text('note') ?></strong></aside></section><?php return (string)ob_get_clean(); }
	if ($variant === 'tiles') { ob_start(); ?><section class="collection-tiles"><?php for($i=1;$i<=3;$i++): ?><a href="<?= $url('tile'.$i.'Url') ?>"><small><?= $text('tile'.$i.'Kicker') ?></small><h2><?= $html('tile'.$i.'Title') ?></h2><span><?= $text('tile'.$i.'Cta') ?></span></a><?php endfor; ?></section><?php return (string)ob_get_clean(); }
	if ($variant === 'categories') { $cats=[['Декоративне освітлення','decorative-lighting'],['Меблі лофт','loft-furniture'],['Настінний декор','wall-decor'],['Малий декор','small-decor'],['Декор для тераси','terrace-decor'],['Для бізнесу','business-decor']]; ob_start(); ?><section class="space-section"><header><p class="kicker"><?= $text('kicker') ?></p><h2><?= $html('title') ?></h2><a href="<?= $url('url') ?>"><?= $text('cta') ?></a></header><div class="space-grid"><?php foreach($cats as $i=>[$name,$slug]):$term=get_term_by('slug',$slug,'product_cat');?><a href="<?= esc_url($term?get_term_link($term):home_url('/spaces/')) ?>"><span>0<?= $i+1 ?></span><strong><?= esc_html($name) ?></strong><i>→</i></a><?php endforeach; ?></div></section><?php return (string)ob_get_clean(); }
	if ($variant === 'products') { $items=wc_get_products(['status'=>'publish','limit'=>4,'orderby'=>'date','order'=>'DESC']); ob_start(); ?><section class="product-showcase"><div class="section-head"><p class="kicker"><?= $text('kicker') ?></p><h2><?= $html('title') ?></h2><a href="<?= $url('url') ?>"><?= $text('cta') ?></a></div><div class="editorial-products"><?php foreach($items as $product): ?><article><a href="<?= esc_url(get_permalink($product->get_id())) ?>"><?= wp_get_attachment_image($product->get_image_id(),'medium',false,['loading'=>'lazy']) ?></a><div><small><?= esc_html($product->get_sku()) ?></small><h3><?= esc_html($product->get_name()) ?></h3><p><?= wp_kses_post($product->get_price_html()) ?></p><button type="button" class="buy-link ajax_add_to_cart" data-product_id="<?= esc_attr($product->get_id()) ?>">До кошика <span>+</span></button></div></article><?php endforeach; ?></div></section><?php return (string)ob_get_clean(); }
	if ($variant === 'sets') { ob_start(); ?><section class="sets"><div class="section-head"><p class="kicker"><?= $text('kicker') ?></p><h2><?= $html('title') ?></h2></div><div class="set-list"><?php for($i=1;$i<=3;$i++): ?><a href="<?= $url('set'.$i.'Url') ?>"><small><?= $text('set'.$i.'Kicker') ?></small><h3><?= $text('set'.$i.'Title') ?></h3><span><?= $text('set'.$i.'Cta') ?></span></a><?php endfor; ?></div></section><?php return (string)ob_get_clean(); }
	if ($variant === 'b2b') { return '<section class="b2b-band"><div><p class="kicker">'.$text('kicker').'</p><h2>'.$html('title').'</h2></div><div><p>'.$text('copy').'</p><a class="button" href="'.$url('url').'">'.$text('cta').'</a></div></section>'; }
	return '<section class="brand-journal"><div><p class="kicker">'.$text('brandKicker').'</p><h2>'.$html('brandTitle').'</h2><a href="'.$url('brandUrl').'">'.$text('brandCta').'</a></div><div><p class="kicker">'.$text('journalKicker').'</p><a href="'.$url('article1Url').'"><small>ІДЕЇ ДЛЯ ПРОСТОРУ</small><h3>'.$text('article1Title').'</h3><span>'.$text('article1Cta').'</span></a><a href="'.$url('article2Url').'"><small>ДЕТАЛІ</small><h3>'.$text('article2Title').'</h3><span>'.$text('article2Cta').'</span></a></div></section>';
}

add_action('init', function(){
	wp_register_script('ferreta-home-blocks', get_template_directory_uri().'/home-blocks.js', ['wp-blocks','wp-element','wp-components','wp-block-editor','wp-i18n'], filemtime(get_template_directory().'/home-blocks.js'), true);
	wp_localize_script('ferreta-home-blocks', 'FerretaHomeBlocks', ['defaults'=>ferreta_home_block_defaults()]);
	wp_register_style('ferreta-home-blocks', false, [], '1.0');
	register_block_type('ferreta/home-section', ['editor_script'=>'ferreta-home-blocks','render_callback'=>'ferreta_home_render_block','attributes'=>['variant'=>['type'=>'string','default'=>'hero']]]);
});

function ferreta_create_editable_homepage(): int {
	$current=(int)get_option('page_on_front'); if($current){return $current;}
	$content='<!-- wp:ferreta/home-section {"variant":"hero"} /-->\n<!-- wp:ferreta/home-section {"variant":"tiles"} /-->\n<!-- wp:ferreta/home-section {"variant":"categories"} /-->\n<!-- wp:ferreta/home-section {"variant":"products"} /-->\n<!-- wp:ferreta/home-section {"variant":"sets"} /-->\n<!-- wp:ferreta/home-section {"variant":"b2b"} /-->\n<!-- wp:ferreta/home-section {"variant":"journal"} /-->';
	$id=wp_insert_post(['post_title'=>'Головна','post_name'=>'home','post_status'=>'publish','post_type'=>'page','post_content'=>$content]);
	if(!is_wp_error($id)){update_option('show_on_front','page');update_option('page_on_front',(int)$id);return (int)$id;} return 0;
}
add_action('after_switch_theme','ferreta_create_editable_homepage');
