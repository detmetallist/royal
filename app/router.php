<?php

//output $controllerName, $templateName

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//var_dump($path);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($config['routes']['GET'][$path])) {
	$controllerName = $config['routes']['GET'][$path];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($config['routes']['POST'][$path])) {
	$controllerName = $config['routes']['POST'][$path];
}

if (!isset($controllerName)) {
	$controllerName = '/404';
}

if (isset($config['templates'][$controllerName])) {
	$templateName = $config['templates'][$controllerName];
}

unset ($config['routes'],$config['templates']);

//var_dump($templateName);die();

if (isset($templateName)) {
	include __DIR__.'/templates/'.$templateName.'.php';
} else {
	include __DIR__.'/controllers'.$controllerName.'.php';
}