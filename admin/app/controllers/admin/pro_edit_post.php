<?php
	if (!Users\checkAccess()) header("Location: /admin/login");
	include HELPERS.'/notices.php';
	$pro_title=false;
    $pro_text=false;
    $res = $DB->query(\DB\parse('SELECT * FROM settings WHERE name=? OR name=?','pro_title','pro_text'),MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        if($row['name']=='pro_title'){
            $pro_title=true;
        }
        if($row['name']=='pro_text'){
            $pro_text=true;
        }
    }
    if($pro_title){
    	if($DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$_POST['name'],'pro_title')) === TRUE ){
			Notices\generateSuccess('Заголовок обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении заголовка');
		}
    } else {
    	if($DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','pro_title',$_POST['name'])) === TRUE ){
			Notices\generateSuccess('Заголовок обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении заголовка');
		}
    }
    if($pro_text){
    	if($DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$_POST['description'],'pro_text')) === TRUE ){
			Notices\generateSuccess('Текст обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении текста');
		}
    } else {
    	if($DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','pro_text',$_POST['description'])) === TRUE ){
			Notices\generateSuccess('Текст обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении текста');
		}
    }
	header("Location: /admin/pro");
?>