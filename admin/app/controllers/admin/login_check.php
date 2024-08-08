<?php

if (Users\makeLogin($_POST['email'],$_POST['password'])) {
	header("Location: /admin");
}

Notices\generateError('Вы ввели неправильную почту или пароль');