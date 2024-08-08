<?php
	$res = $DB->query(\DB\parse('SELECT * FROM pictures WHERE parent_id=? AND `order`=?',$_POST['estate_id'],$_POST['order1']),MYSQLI_USE_RESULT);
  	while ($row = $res->fetch_assoc()) {
  		$id1=$row['id'];
  	}
  	$res = $DB->query(\DB\parse('SELECT * FROM pictures WHERE parent_id=? AND `order`=?',$_POST['estate_id'],$_POST['order2']),MYSQLI_USE_RESULT);
  	while ($row = $res->fetch_assoc()) {
  		$id2=$row['id'];
  	}
	$DB->query(\DB\parse('UPDATE pictures SET `order`=? WHERE `id`=?',$_POST['order1'],$id2));
	$DB->query(\DB\parse('UPDATE pictures SET `order`=? WHERE `id`=?',$_POST['order2'],$id1));
?>