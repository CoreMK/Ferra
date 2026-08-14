<?php
/* Template Name: Decor categories */
get_header();
$categories=get_terms(['taxonomy'=>'product_cat','hide_empty'=>false,'exclude'=>get_option('default_product_cat')]);
?>
<main class="decor-categories">
  <section class="decor-categories__hero">
    <p class="kicker">FERRETA DECOR / КАТЕГОРІЇ</p>
    <h1>Предмети, з яких<br>складається <em>характер</em> простору.</h1>
    <p>Обирайте не за одним типом товару, а за роллю предмета у вашому домі, терасі чи бізнесі.</p>
  </section>
  <section class="decor-categories__grid" aria-label="Категорії декору">
  <?php foreach($categories as $index=>$category):$link=get_term_link($category);if(is_wp_error($link))continue;?>
    <a class="decor-category decor-category--<?=($index%5)+1?>" href="<?=esc_url($link)?>">
      <small><?=str_pad((string)($index+1),2,'0',STR_PAD_LEFT)?></small>
      <h2><?=esc_html($category->name)?></h2>
      <p><?=esc_html($category->description ?: 'Категорія готується до наповнення.')?></p>
      <span><?= $category->count ? sprintf('%d товарів', $category->count) : 'Скоро в каталозі' ?> <b>→</b></span>
    </a>
  <?php endforeach;?>
  </section>
  <section class="decor-categories__request"><p class="kicker">B2B / PRIVATE</p><h2>Не знайшли потрібний предмет?</h2><p>Опишіть простір — підберемо декор із доступних колекцій або підготуємо проєктний запит.</p><a class="button" href="<?=esc_url(home_url('/project-request/'))?>">Обговорити проєкт</a></section>
</main>
<?php get_footer(); ?>
