<?php
require '/var/www/html/wp-load.php';
$categories=[
  ['Декоративне освітлення','decorative-lighting','Реальні світлові об’єкти Ferreta.'],
  ['Меблі лофт','loft-furniture','Меблі та акцентні предмети для інтер’єру й тераси.'],
  ['Настінний декор','wall-decor','Картини, панно й виразні акценти для стін.'],
  ['Малий декор','small-decor','Деталі для сервірування та повсякденного простору.'],
  ['Декор для тераси','terrace-decor','Предмети для відкритого простору.'],
  ['Подарунки','gifts','Добірки предметів для особливих випадків.'],
  ['Для бізнесу','business-decor','Декор для HoReCa, офісів і комерційних просторів.'],
  ['Новинки','new','Нові надходження.'],
  ['Комплекти','sets','Готові композиції та поєднання.']
];
foreach($categories as[$name,$slug,$description]){
  $term=term_exists($slug,'product_cat');
  $id=$term?(is_array($term)?$term['term_id']:$term):wp_insert_term($name,'product_cat',['slug'=>$slug,'description'=>$description]);
  if(is_wp_error($id))fwrite(STDERR,"$slug: {$id->get_error_message()}\n"); else echo "$slug\n";
}
$lighting=get_term_by('slug','decorative-lighting','product_cat');
if($lighting){foreach(wc_get_products(['status'=>'publish','limit'=>-1,'return'=>'ids']) as $productId)wp_set_object_terms($productId,[(int)$lighting->term_id],'product_cat',true);}
