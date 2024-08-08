<?php

$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
  
$data = [];

while ($row = $res->fetch_assoc()) {
  $data[$row['name']] = $row['value'];
}

$res->free();

extract($data);

include ADMIN_VIEWS.'/settings.php';