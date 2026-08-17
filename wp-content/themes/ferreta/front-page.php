<?php
get_header();

$featured = wc_get_products([
	'status'  => 'publish',
	'limit'   => 4,
	'orderby' => 'date',
	'order'   => 'DESC',
]);
$hero      = $featured[0] ?? null;
$heroImage = $hero ? wp_get_attachment_image_url($hero->get_image_id(), 'large') : '';
$text      = static fn (string $key): string => ferreta_home_text($key);
$html      = static fn (string $key): string => ferreta_home_html($key);
$url       = static fn (string $key): string => ferreta_home_url($key);
$categoryLinks = [
	['Декоративне освітлення', 'decorative-lighting'],
	['Меблі лофт', 'loft-furniture'],
	['Настінний декор', 'wall-decor'],
	['Малий декор', 'small-decor'],
	['Декор для тераси', 'terrace-decor'],
	['Для бізнесу', 'business-decor'],
];
?>
<main>
	<section class="hero-editorial"<?= $heroImage ? ' style="--hero:url(' . esc_url($heroImage) . ')"' : '' ?>>
		<div class="hero-copy">
			<p class="kicker"><?= $text('hero_kicker') ?></p>
			<h1><?= $html('hero_title') ?></h1>
			<p><?= $text('hero_copy') ?></p>
			<div>
				<a class="button" href="<?= $url('hero_primary_url') ?>"><?= $text('hero_primary_label') ?></a>
				<a class="button button-quiet" href="<?= $url('hero_secondary_url') ?>"><?= $text('hero_secondary_label') ?></a>
			</div>
		</div>
		<aside><span>FERRETA / 01</span><strong><?= $text('hero_note') ?></strong></aside>
	</section>

	<section class="collection-tiles">
		<?php for ($tile = 1; $tile <= 3; $tile++) : ?>
			<a href="<?= $url('tile_' . $tile . '_url') ?>">
				<small><?= $text('tile_' . $tile . '_kicker') ?></small>
				<h2><?= $html('tile_' . $tile . '_title') ?></h2>
				<span><?= $text('tile_' . $tile . '_cta') ?></span>
			</a>
		<?php endfor; ?>
	</section>

	<section class="space-section" id="spaces">
		<header>
			<p class="kicker"><?= $text('catalog_kicker') ?></p>
			<h2><?= $html('catalog_title') ?></h2>
			<a href="<?= $url('catalog_url') ?>"><?= $text('catalog_cta') ?></a>
		</header>
		<div class="space-grid">
			<?php foreach ($categoryLinks as $i => [$name, $slug]) :
				$term = get_term_by('slug', $slug, 'product_cat');
				$link = $term ? get_term_link($term) : home_url('/spaces/');
			?>
				<a href="<?= esc_url($link) ?>"><span>0<?= $i + 1 ?></span><strong><?= esc_html($name) ?></strong><i>→</i></a>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="product-showcase">
		<div class="section-head">
			<p class="kicker"><?= $text('products_kicker') ?></p>
			<h2><?= $html('products_title') ?></h2>
			<a href="<?= $url('products_url') ?>"><?= $text('products_cta') ?></a>
		</div>
		<div class="editorial-products">
			<?php foreach ($featured as $product) : ?>
				<article>
					<a href="<?= esc_url(get_permalink($product->get_id())) ?>"><?= wp_get_attachment_image($product->get_image_id(), 'medium', false, ['loading' => 'lazy']) ?></a>
					<div>
						<small><?= esc_html($product->get_sku()) ?></small>
						<h3><?= esc_html($product->get_name()) ?></h3>
						<p><?= wp_kses_post($product->get_price_html()) ?></p>
						<button type="button" class="buy-link ajax_add_to_cart" data-product_id="<?= esc_attr($product->get_id()) ?>">До кошика <span>+</span></button>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="sets">
		<div class="section-head"><p class="kicker"><?= $text('sets_kicker') ?></p><h2><?= $html('sets_title') ?></h2></div>
		<div class="set-list">
			<?php for ($set = 1; $set <= 3; $set++) : ?>
				<a href="<?= $url('set_' . $set . '_url') ?>"><small><?= $text('set_' . $set . '_kicker') ?></small><h3><?= $text('set_' . $set . '_title') ?></h3><span><?= $text('set_' . $set . '_cta') ?></span></a>
			<?php endfor; ?>
		</div>
	</section>

	<section class="b2b-band">
		<div><p class="kicker"><?= $text('b2b_kicker') ?></p><h2><?= $html('b2b_title') ?></h2></div>
		<div><p><?= $text('b2b_copy') ?></p><a class="button" href="<?= $url('b2b_url') ?>"><?= $text('b2b_cta') ?></a></div>
	</section>

	<section class="brand-journal">
		<div><p class="kicker"><?= $text('brand_kicker') ?></p><h2><?= $html('brand_title') ?></h2><a href="<?= $url('brand_url') ?>"><?= $text('brand_cta') ?></a></div>
		<div>
			<p class="kicker"><?= $text('journal_kicker') ?></p>
			<a href="<?= $url('journal_1_url') ?>"><small>ІДЕЇ ДЛЯ ПРОСТОРУ</small><h3><?= $text('journal_1_title') ?></h3><span><?= $text('journal_1_cta') ?></span></a>
			<a href="<?= $url('journal_2_url') ?>"><small>ДЕТАЛІ</small><h3><?= $text('journal_2_title') ?></h3><span><?= $text('journal_2_cta') ?></span></a>
		</div>
	</section>
</main>
<?php get_footer(); ?>
