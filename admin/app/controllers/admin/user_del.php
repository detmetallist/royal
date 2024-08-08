<?php

if (!Users\checkAccess()) header("Location: /admin/login");
include HELPERS.'/notices.php';

$id = $_GET['id'] ?? null;
if (isset($id)) {
	if ($DB->query(\DB\parse('DELETE FROM users WHERE id=?',$id)) === TRUE) {
		Notices\generateSuccess('Пользователь успешно удалён');
	} else {
		Notices\generateError('Возникла проблема при удалении пользователя');
	}
} else {
	Notices\generateError('Отсутствует id пользователя');
}

header("Location: /admin/users");

