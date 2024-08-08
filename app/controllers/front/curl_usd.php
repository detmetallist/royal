<?php
	$currencies=json_decode(file_get_contents("https://api.monobank.ua/bank/currency"));
	$usd_buy=$currencies[0]->rateBuy;
	$usd_sell=$currencies[0]->rateSell;
	$eur_buy=$currencies[1]->rateBuy;
	$eur_sell=$currencies[1]->rateSell;
	$usd=round(($usd_buy+$usd_sell)/2,2);
	$eur=round(($eur_buy+$eur_sell)/2,2);
	$usd_base=false;
	$eur_base=false;
	$res = $DB->query(("SELECT * FROM settings WHERE name='usd' OR name='eur'"),MYSQLI_USE_RESULT);
	if($res!=false){
		while ($row = $res->fetch_assoc()) {
			if($row['name']=='eur'){
				$eur_base=true;
			}
			if($row['name']=='usd'){
				$usd_base=true;
			}
		}
	}
	if($usd!=0){
		if($usd_base==false){
			$DB->query(\DB\parse('INSERT INTO settings (`name`,`value`) VALUES (?,?)','usd',$usd));
		} else {
			$DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$usd,'usd'));
		}
		if($eur_base==false){
			$DB->query(\DB\parse('INSERT INTO settings (`name`,`value`) VALUES (?,?)','eur',$eur));
		} else {
			$DB->query(\DB\parse('UPDATE settings SET value=? WHERE name=?',$eur,'eur'));
		}
	}
	