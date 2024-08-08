<?php

//очищаем таблицу с настройками сайта

$DB->query('DELETE FROM settings');

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','footer_text_1',$_POST['footer_text_1']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','footer_text_2',$_POST['footer_text_2']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','viber_social',$_POST['viber_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','whatsapp_social',$_POST['whatsapp_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','telegram_social',$_POST['telegram_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','facebook_social',$_POST['facebook_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','instagram_social',$_POST['instagram_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','youtube_social',$_POST['youtube_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','twitter_social',$_POST['twitter_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','tiktok_social',$_POST['tiktok_social']));

$DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','google_api',$_POST['google_api']));

$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
  
$data = [];

while ($row = $res->fetch_assoc()) {
	$data[$row['name']] = $row['value'];
}

$res->free();

extract($data);

include ADMIN_VIEWS.'/settings.php';