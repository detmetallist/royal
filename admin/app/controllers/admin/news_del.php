<?php

if (!Users\checkAccess()) header("Location: /admin/login");
include HELPERS.'/notices.php';

$id = $_GET['id'] ?? null;
if (isset($id)) {
	if ($DB->query(\DB\parse('DELETE FROM news WHERE id=?',$id)) === TRUE) {
		Notices\generateSuccess('Новость успешно удалена');
	} else {
		Notices\generateError('Возникла проблема при удалении новости');
	}
} else {
	Notices\generateError('Отсутствует id новости');
}

header("Location: /admin/news");