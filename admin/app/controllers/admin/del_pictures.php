<?php
	if($_POST['action']=='delete'){
		$DB->query(\DB\parse('DELETE FROM pictures WHERE `parent_id`=0'));
		$DB->query(\DB\parse("DELETE FROM news WHERE `name`=''"));
	}
?>