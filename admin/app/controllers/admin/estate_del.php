<?php

if (!Users\checkAccess()) header("Location: /admin/login");
include HELPERS.'/notices.php';

$id = $_GET['id'] ?? null;
if (isset($id)) {
	if ($DB->query(\DB\parse('DELETE FROM estate WHERE id=?',$id)) === TRUE) {
		$DB->query(\DB\parse('DELETE FROM pictures WHERE parent_id=?',$id));
		Notices\generateSuccess('Хата успешно удалена');
	} else {
		Notices\generateError('Возникла проблема при удалении хаты');
	}
} else {
	Notices\generateError('Отсутствует id хаты');
}

header("Location: /admin/realEstate");