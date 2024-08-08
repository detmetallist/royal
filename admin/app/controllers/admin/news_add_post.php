<?php 
	if (!Users\checkAccess()) header("Location: /admin/login");
	include HELPERS.'/notices.php';
	$date=date("Y-m-d");
	if($DB->query(\DB\parse("UPDATE news SET name=?,`text`=?,`public_date`=? WHERE name=''",$_POST['name'],$_POST['description'],$date)) === TRUE ){
		Notices\generateSuccess('Новость создана');
	} else {
		Notices\generateError('Возникла проблема при создании новости. ');
	}
	header("Location: /admin/news");
?>