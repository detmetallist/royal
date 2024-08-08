<?php
	if($_POST['news_id']){
		$DB->query(\DB\parse('UPDATE news SET img0=?,img1=?,img2=?,img3=? WHERE id=?',$_POST['img0'],$_POST['img1'],$_POST['img2'],$_POST['img3'],$_POST['news_id']));
	} else {
		$DB->query(\DB\parse('INSERT INTO news (`img0`,`img1`,`img2`,`img3`) VALUES (?,?,?,?)',$_POST['img0'],$_POST['img1'],$_POST['img2'],$_POST['img3']));
	}
?>