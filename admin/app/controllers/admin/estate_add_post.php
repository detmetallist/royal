<?php 
	if (!Users\checkAccess()) header("Location: /admin/login");
	include HELPERS.'/notices.php';
	if(!empty($_POST['arenda_prodazha'])){
		$arenda_prodazha=1;
	} else {
		$arenda_prodazha=0;
	}
	if(!empty($_POST['remont'])){
		$remont=1;
	} else {
		$remont=0;
	}
	if(!empty($_POST['mebel'])){
		$mebel=1;
	} else {
		$mebel=0;
	} 
	if(!empty($_POST['posle_stroiteley'])){
		$posle_stroiteley=1;
	} else {
		$posle_stroiteley=0;
	}
	if(!empty($_POST['parking'])){
		$parking=1;
	} else {
		$parking=0;
	} 
	if(!empty($_POST['terasa'])){
		$terasa=1;
	} else {
		$terasa=0;
	}
	if(!empty($_POST['penthouse'])){
		$penthouse=1;
	} else {
		$penthouse=0;
	}
	//echo \DB\parse('INSERT INTO estate (name,country,oblast,city,type,market,rooms,walls,totalSq,residentialSq,kitchenSq,floor,superficiality,heating,yearOfConstruction,utilitiesWinter,utilitiesSummer,registrationNumber,price,adress,description,arenda_prodazha,remont,mebel,posle_stroiteley,parking,terasa,penthouse) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',$_POST['name'],$_POST['country'],$_POST['oblast'],$_POST['city'],$_POST['type'],$_POST['market'],$_POST['rooms'],$_POST['walls'],$_POST['totalSq'],$_POST['residentialSq'],$_POST['kitchenSq'],$_POST['floor'],$_POST['superficiality'],$_POST['heating'],$_POST['yearOfConstruction'],$_POST['utilitiesWinter'],$_POST['utilitiesSummer'],$_POST['registrationNumber'],$_POST['price'],$_POST['adress'],$_POST['description'],$_POST['arenda_prodazha'],$_POST['remont'],$_POST['mebel'],$_POST['posle_stroiteley'],$_POST['parking'],$_POST['terasa'],$_POST['penthouse']);
	if($DB->query(\DB\parse('INSERT INTO estate (name,country,oblast,city,type,market,rooms,walls,totalSq,residentialSq,kitchenSq,floor,superficiality,heating,yearOfConstruction,utilitiesWinter,utilitiesSummer,registrationNumber,price,adress,description,arenda_prodazha,remont,mebel,posle_stroiteley,parking,terasa,penthouse,coord_x,coord_y) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',$_POST['name'],$_POST['country'],$_POST['oblast'],$_POST['city'],$_POST['type'],$_POST['market'],$_POST['rooms'],$_POST['walls'],$_POST['totalSq'],$_POST['residentialSq'],$_POST['kitchenSq'],$_POST['floor'],$_POST['superficiality'],$_POST['heating'],$_POST['yearOfConstruction'],$_POST['utilitiesWinter'],$_POST['utilitiesSummer'],$_POST['registrationNumber'],$_POST['price'],$_POST['adress'],$_POST['description'],$arenda_prodazha,$remont,$mebel,$posle_stroiteley,$parking,$terasa,$penthouse,$_POST['coord_x'],$_POST['coord_y'])) === TRUE ){
		$res=$DB->query(\DB\parse('SELECT LAST_INSERT_ID()'),MYSQLI_USE_RESULT);
		while ($row = $res->fetch_assoc()) {
			$id=$row['LAST_INSERT_ID()'];
		}
		$DB->query(\DB\parse('UPDATE pictures SET parent_id=? WHERE parent_id=0',$id));
		Notices\generateSuccess('Хата создана');
	} else {
		Notices\generateError('Возникла проблема при создании хаты');
	}
	header("Location: /admin/realEstate");
?>