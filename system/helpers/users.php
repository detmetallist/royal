<?php

namespace Users;

function makeLogin($email,$password) {
	global $DB;
	
	$res = $DB->query(\DB\parse('SELECT * FROM users WHERE email=? LIMIT 1',$email));
	
	if ($row = $res->fetch_assoc()) {
		if (md5($password) === $row['password']) {
			unset($row['password']);
			$_SESSION['user'] = $row;
			return true;
		}
	}
	
	return false;
}

function checkAccess() {
	global $config;
	global $controllerName;

	if (!isset($_SESSION['user'])) return false;
	if (!isset($config['access'][$_SESSION['user']['role']][$controllerName])) return false;
	return true;
}