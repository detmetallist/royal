<?php

namespace DB;

function connect($host,$user,$password,$database) {
	global $DB;
	
	$DB = new \mysqli($host, $user, $password, $database);
	if ($DB->connect_errno) {
    	echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
    	die();
	}
}

function parse($sql,...$data) {
	global $DB;

	$result = '';
	$elem = explode('?', $sql);
	$len = count($data);

	for ($i=0;$i<$len;$i++) {
		$result.=$elem[$i].'\''.$DB->real_escape_string($data[$i]).'\'';
	}

	if (count($elem)>$len) $result.=$elem[$i];

	return $result;
}