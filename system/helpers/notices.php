<?php

namespace Notices;

// Делаем инициализацию переменных с которыми будем работать
if (!isset($_SESSION['notices'])) {
	$_SESSION['notices'] = ['error'=>[],'notice'=>[],'success'=>[]];
}

function generateError($msg) {
	$_SESSION['notices']['error'][] = $msg;
}

function getErrors() {
	$errors = $_SESSION['notices']['error'];
	$_SESSION['notices']['error'] = [];
	return $errors;
}

function generateSuccess($msg) {
	$_SESSION['notices']['success'][] = $msg;
}

function getSuccesses() {
	$success = $_SESSION['notices']['success'];
	$_SESSION['notices']['success'] = [];
	return $success;
}