<?php

$config = [
	'DB' => [
		'host' => 'localhost',
		'user' => 'royal_usr',
		'password' => '7naOcwUqxBEnK7ts',
		'database' => 'royal',
	],
	// Указываем для url контроллёры.
	'routes' => [
		'GET' => [
			'/admin/'=>'/admin/index',
			'/admin/settings'=>'/admin/settings',
			'/admin/login'=>'/admin/login',
			'/admin/users'=>'/admin/users',
			'/admin/user_del' => '/admin/user_del',
			'/admin/user_add' => '/admin/user_add',
			'/admin/user_edit' => '/admin/user_edit',
			'/admin/realEstate' => '/admin/realEstate',
			'/admin/estate_add' => '/admin/estate_add',
			'/admin/estate_edit' => '/admin/estate_edit',
			'/admin/estate_del' => '/admin/estate_del',
			'/admin/news' => '/admin/news',
			'/admin/news_add' => '/admin/news_add',
			'/admin/news_del' => '/admin/news_del',
			'/admin/news_edit' => '/admin/news_edit',
			'/admin/pro' => '/admin/pro',
			'/admin/contacts' => '/admin/contacts',

		],
		'POST' => [
			'/admin/login' => '/admin/login_check',
			'/admin/settings' => '/admin/settings_edit',
			'/admin/estate_add' => '/admin/estate_add_post',
			'/admin/estate_edit' => '/admin/estate_edit_post',
			'/admin/upload' => '/admin/upload',
			'/admin/add_picture' => '/admin/add_picture',
			'/admin/del_pictures' => '/admin/del_pictures',
			'/admin/order_pictures' => '/admin/order_pictures',
			'/admin/news_add' => '/admin/news_add_post',
			'/admin/add_picture_news' => '/admin/add_picture_news',
			'/admin/news_edit' => '/admin/news_edit_post',
			'/admin/pro' => '/admin/pro_edit_post',
			'/admin/contacts' => '/admin/contacts_edit_post',
		]
	],
	//Назначаем для контролёров шаблоны. Если шаблона нет то запустится чистый контролёр
	'templates' => [
		'/admin/index' => 'admin',
		'/admin/users' => 'admin',
		'/admin/user_add' => 'admin',
		'/admin/user_edit' => 'admin',
		'/admin/login' => 'login',
		'/admin/login_check' => 'login',
		'/admin/settings' => 'admin',
		'/admin/settings_edit' => 'admin',
		'/admin/realEstate' => 'admin',
		'/admin/estate_add' => 'admin',
		'/admin/estate_edit' => 'admin',
		'/admin/news' => 'admin',
		'/admin/news_add' => 'admin',
		'/admin/news_edit' => 'admin',
		'/admin/pro' => 'admin',
		'/admin/contacts' => 'admin',
	],
	//Указываем доступ групп пользователей к контролёрам
	'access'=>[
		'admin'=>[
			'/admin/index' => true,
			'/admin/users' => true,
			'/admin/user_del' => true,
			'/admin/user_edit' => true,
			'/admin/user_add' => true,
			'/admin/settings' => true,
			'/admin/settings_edit' => true,
			'/admin/realEstate' => true,
			'/admin/estate_add' => true,
			'/admin/estate_add_post' => true,
			'/admin/estate_edit' => true,
			'/admin/estate_edit_post' => true,
			'/admin/estate_del' => true,
			'/admin/del_pictures' =>true,
			'/admin/order_pictures' => true,
			'/admin/news' => true,
			'/admin/news_add' => true,
			'/admin/news_add_post' => true,
			'/admin/news_del' => true,
			'/admin/news_edit' => true,
			'/admin/news_edit_post' => true,
			'/admin/pro' => true,
			'/admin/contacts' => true,
		],
		'manager'=>[
			'/admin/index' => true,	
		]
	],
	'estateType' => [
		1 => 'квартири',
		2 => 'будинки',
		3 => 'земельні ділянки',
		4 => 'комерційна нерухомість',
	],
	'estateMarket' => [
		1 => 'Вторинне житло',
		2 => 'Первинне житло',
	],
	'estateWalls' => [
		1 => 'цегла',
		2 => 'каркасний',
		3 => 'силікатна цегла',
		4 => 'панель',
		5 => 'піноблок',
		6 => 'моноліт',
		7 => 'ракушняк',
		8 => 'блочно-цегляний',
		9 => 'монолітно-цегляний',
		10 => 'монолітний залізобетон',
		11 => 'каркасно-кам`яна',
		12 => 'облицювальна цегла',
		13 => 'залізобетон',
		14 => 'керамічна цегла',
		15 => 'збірно-монолітна',
		16 => 'СІП',
		17 => 'безкаркасна',
		18 => 'монолітно-блоковий',
		19 => 'армований залізобетон',
		20 => 'збірний залізобетон',
		21 => 'армована 3D панель',
		22 => 'газоблок',
		23 => 'монолітно-каркасний',
		24 => 'дерево та цегла',
		25 => 'інкерманський камінь',
		26 => 'бутовий камінь',
		27 => 'газобетон',
		28 => 'керамічний блок',
		29 => 'керамзітобетон',
		30 => 'полістиролбетон',
	],
	'estateHeating' => [
		1 => 'централізоване',
		2 => 'індивідуальне',
		3 => 'без опалення',
		4 => 'комбіноване',
	],
	'yearOfConstruction' => [
		1 => 'не вказано',
		2 => 'Здача в 2026',
		3 => 'Здача в 2025',
		4 => 'Здача в 2024',
		5 => 'Здача в 2023',
		6 => 'Здача в 2022',
		7 => '2021',
		8 => '2020',
		9 => '2019',
		10 => '2018',
		11 => '2017',
		12 => '2016',
		13 => '2011-2015',
		14 => '2001-2010',
		15 => '1990-2000',
		16 => '1980-1989',
		17 => '1970-1979',
		18 => '1917-1969',
		19 => 'до 1917',
	],
	'imageSize' => [
		1 => [185,140],
		2 => [565,424],
		3 => [720,540],
	],
	'estates_front_length' => 6,
	'estates_admin_length' => 10,
	'news_front_length' => 6,
	'news_admin_length' => 10,
];