<?php
	$DB->query(\DB\parse('INSERT INTO pictures (`img0`,`img1`,`img2`,`img3`,`parent_id`,`order`) VALUES (?,?,?,?,?,?)',$_POST['img0'],$_POST['img1'],$_POST['img2'],$_POST['img3'],0,$_POST['order']));
?>