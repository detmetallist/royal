<?php
	if (!Users\checkAccess()) header("Location: /admin/login");
	include HELPERS.'/notices.php';
	if (isset($_POST['news_id'])) {
		$date=date("Y-m-d");
		if($DB->query(\DB\parse('UPDATE news SET name=?,`text`=?,public_date=? WHERE id=?',$_POST['name'],$_POST['description'],$date,$_POST['news_id'])) === TRUE ){
			Notices\generateSuccess('Новость обновлена');
		} else {
			Notices\generateError('Возникла проблема при обновлении новости');
		}
	} else {
		Notices\generateError('Отсутствует id новости');
	}
	header("Location: /admin/news");
?>