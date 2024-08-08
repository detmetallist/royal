<?php
	if (!Users\checkAccess()) header("Location: /admin/login");
	include HELPERS.'/notices.php';
	$contacts_title=false;
    $contacts_text=false;
    $contacts_map=false;
    $res = $DB->query(\DB\parse('SELECT * FROM settings WHERE name=? OR name=? OR name=?','contacts_title','contacts_text','contacts_map'),MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        if($row['name']=='contacts_title'){
            $contacts_title=true;
        }
        if($row['name']=='contacts_text'){
            $contacts_text=true;
        }
        if($row['name']=='contacts_map'){
            $contacts_map=true;
        }
    }
    if($contacts_title){
    	if($DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$_POST['name'],'contacts_title')) === TRUE ){
			Notices\generateSuccess('Заголовок обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении заголовка');
		}
    } else {
    	if($DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','contacts_title',$_POST['name'])) === TRUE ){
			Notices\generateSuccess('Заголовок обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении заголовка');
		}
    }
    if($contacts_text){
    	if($DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$_POST['description'],'contacts_text')) === TRUE ){
			Notices\generateSuccess('Текст обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении текста');
		}
    } else {
    	if($DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','contacts_text',$_POST['description'])) === TRUE ){
			Notices\generateSuccess('Текст обновлен');
		} else {
			Notices\generateError('Возникла проблема при обновлении текста');
		}
    }
    if($contacts_map){
    	if($DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$_POST['map'],'contacts_map')) === TRUE ){
			Notices\generateSuccess('Координаты карты обновлены');
		} else {
			Notices\generateError('Возникла проблема при обновлении координат карты');
		}
    } else {
    	if($DB->query(\DB\parse('INSERT INTO settings (name,value) VALUES (?,?)','contacts_map',$_POST['map'])) === TRUE ){
			Notices\generateSuccess('Координаты карты обновлены');
		} else {
			Notices\generateError('Возникла проблема при обновлении координат карты');
		}
    }
	header("Location: /admin/contacts");
?>