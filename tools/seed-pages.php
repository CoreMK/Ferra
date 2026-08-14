<?php
require '/var/www/html/wp-load.php';
$pages=[
 ['Простори','spaces',''],['Комплекти','sets',''],['Проєкти','projects',''],['Про бренд','about',''],['Матеріали та догляд','materials',''],['Журнал','journal',''],['B2B','b2b',''],['Запит на проєкт','project-request',''],['Доставка й оплата','delivery',''],['Гарантія','warranty',''],['Поширені запитання','faq',''],['Контакти','contacts',''],
 ['Обране','favorites','Збережені товари доступні на цьому пристрої. Додайте моделі у каталозі, щоб швидко повернутися до них.'],['Порівняння','compare','Додайте товари до порівняння у каталозі. Список зберігається у вашому браузері.'],
 ['Політика конфіденційності','privacy','Політика конфіденційності має бути затверджена власником бізнесу перед публікацією.'],['Умови користування','terms','Умови користування має бути затверджено власником бізнесу перед публікацією.'],['Публічна оферта','offer','Публічна оферта має бути затверджена власником бізнесу перед прийманням оплат.'],['Повернення та обмін','returns','Порядок повернення та обміну має бути затверджено власником бізнесу перед публікацією.'],['Cookies','cookies','Сайт використовує лише технічні cookies до підключення погоджених аналітичних сервісів.']
];
foreach($pages as [$title,$slug,$content]){
  $existing=get_page_by_path($slug);
  $id=wp_insert_post(['ID'=>$existing?->ID??0,'post_type'=>'page','post_status'=>'publish','post_title'=>$title,'post_name'=>$slug,'post_content'=>$content],true);
  if(is_wp_error($id)){fwrite(STDERR,$slug.': '.$id->get_error_message()."\n");continue;}
  update_post_meta($id,'_wp_page_template',$slug==='spaces'?'template-decor-categories.php':'template-ferreta-hub.php');
  echo "$slug:$id\n";
}
$privacy=get_page_by_path('privacy');
if($privacy) update_option('wp_page_for_privacy_policy',$privacy->ID);
