<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('HELPERS', __DIR__.'/app/helpers');
define('ADMIN_VIEWS', __DIR__.'/app/views/admin');
session_start();

include __DIR__.'/app/config.php';
include __DIR__.'/app/vars.php';
include HELPERS.'/db.php';
include HELPERS.'/users.php';

DB\connect($config['DB']['host'],$config['DB']['user'],$config['DB']['password'],$config['DB']['database']);
$DB->query('SET NAMES utf8');

include __DIR__.'/app/router.php';