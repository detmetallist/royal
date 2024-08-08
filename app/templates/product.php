<?php

$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
  
$settings = [];

while ($row = $res->fetch_assoc()) {
  $settings[$row['name']] = $row['value'];
}

$res->free();
$valut='usd';
if(!empty($_COOKIE['valut'])){
	$valut=$_COOKIE['valut'];
}
if($valut=='eur'||$valut=='uah'){
	$res = $DB->query("SELECT * FROM settings WHERE name='eur' OR name='usd'",MYSQLI_USE_RESULT);
	while ($row = $res->fetch_assoc()) {
		if($row['name']=='eur'){
			$curs_eur=$row['value'];
		} else {
			$curs_usd=$row['value'];
		}
	}
	$res->free();
}

$res = $DB->query(\DB\parse('SELECT * FROM estate WHERE id=?',$_GET['id']),MYSQLI_USE_RESULT);
while ($row = $res->fetch_assoc()) {
    $type=$row['type'];
    $market=$row['market'];
    $totalSq=$row['totalSq'];
    $rooms=$row['rooms'];
    $walls=$row['walls'];
    $residentialSq=$row['residentialSq'];
    $kitchenSq=$row['kitchenSq'];
    $floor=$row['floor'];
    $superficiality=$row['superficiality'];
    $heating=$row['heating'];
    $yearOfConstruction=$row['yearOfConstruction'];
    $utilitiesWinter=$row['utilitiesWinter'];
    $utilitiesSummer=$row['utilitiesSummer'];
    $registrationNumber=$row['registrationNumber'];
    if($valut=='usd'){
    	$price=$row['price'];
    	$price_znak='$';
    } else if($valut=='uah'){
    	$price=round($row['price']*$curs_usd);
    	$price_znak='грн';
    } else {
    	$price=round($row['price']*$curs_usd/$curs_eur);
    	$price_znak='€';
    }
    $adress=$row['adress'];
    $description=$row['description'];
    $name=$row['name'];
    $country=$row['country'];
    $oblast=$row['oblast'];
    $city=$row['city'];
    $arenda_prodazha=$row['arenda_prodazha'];
    $remont=$row['remont'];
    $mebel=$row['mebel'];
    $posle_stroiteley=$row['posle_stroiteley'];
    $parking=$row['parking'];
    $terasa=$row['terasa'];
    $penthouse=$row['penthouse'];
    $coord_x=$row['coord_x'];
    $coord_y=$row['coord_y'];
}
$res->free();
?>

<?php require_once "header.php"; ?>
<div class="content">
	<div class="breadcrumps">
		<a href="/">Головна</a> <span>></span> <?php echo $name; ?>
	</div>
	<div class="product_content">
		<h2 class="mobile_zagol"><?php echo $name; ?></h2>
		<div class="left">
			<h1><?php echo $name; ?></h1>
			<div class="price_switch">
				<h3>Ціна</h3>
				<a href="#price_usd">USD</a>
				<a href="#price_eur">EUR</a>
				<a href="#price_uah">UAH</a>
				<input type="hidden" name="price_switch">
			</div>
			<p><?php echo $price.$price_znak; ?></p>
			<p><span>id:</span><span id="product_id"><?php echo $_GET['id'] ?></span></p>
			<p><span>площа, м:</span><span class="span_stepen">2</span><?php echo $totalSq; ?></p>
			<p><span>адреса:</span><?php echo $country; ?></p>
			<p><?php echo $oblast; ?></p>
			<p><?php echo $city; ?></p>
			<p><?php echo $adress; ?></p>
		</div>
		<div class="right">
			<?php 
				$res = $DB->query(\DB\parse('SELECT * FROM pictures WHERE parent_id=? ORDER BY `order`',$_GET['id']),MYSQLI_USE_RESULT);
				$i_max=0;
  				while ($row = $res->fetch_assoc()) {
  					$i_max++;
  					$img_small[$i_max]=$row['img1'];
  					$img[$i_max]=$row['img3'];
  				}
  				$res->free();
			?>
			<div class="slider_big_img">
				<div class="color_bg"></div>
				<img src="<?php echo $img[1]; ?>">
			</div>
			<div class="slider_container">
				<div class="owl-carousel owl-theme" id="slider">
					<?php for($i=1; $i<=$i_max; $i++): ?>
						<div class="slide">
						    <a href="<?php echo $img[$i]; ?>">
						    	<img src="<?php echo $img_small[$i]; ?>">
						    	<div class="slide_bg"></div>
						    </a>				    
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="product_features">
		<?php 
			if($rooms=='1'){
				$komnat='кімната';
			} else if($rooms=='2'||$rooms=='3'||$rooms=='4'){
				$komnat='кімнати';
			} else {
				$komnat='кімнат';
			}
		?>
		<div class="item">
			<img src="/img/product_item_komnata.png">
			<p><?php echo $rooms." ".$komnat; ?></p>
		</div>
		<?php if($remont=='1'): ?>
			<div class="item">
				<img src="/img/product_item_remont.png">
				<p>з ремонтом</p>
			</div>
		<?php endif; ?>
		<?php if($mebel=='1'): ?>
			<div class="item">
				<img src="/img/product_item_mebel.png">
				<p>з мебелью</p>
			</div>
		<?php endif; ?>
		<?php if($posle_stroiteley=='1'): ?>
			<div class="item">
				<img src="/img/product_item_posle_stroiteley.png">
				<p>після будівельників</p>
			</div>
		<?php endif; ?>
		<?php if($parking=='1'): ?>
			<div class="item">
				<img src="/img/product_item_parking.png">
				<p>паркінг</p>
			</div>
		<?php endif; ?>
		<?php if($terasa=='1'): ?>
			<div class="item">
				<img src="/img/product_item_terasa.png">
				<p>тераса</p>
			</div>
		<?php endif; ?>
		<?php if($penthouse=='1'): ?>
			<div class="item">
				<img src="/img/product_item_penthouse.png">
				<p>пентхаус</p>
			</div>
		<?php endif; ?>
	</div>
	<div class="product_characteristics">
		<p><span>Реєстраційний №:</span> <?php echo $registrationNumber; ?></p>
		<p><span>Тип нерухомості:</span> <?php echo $config['estateType'][$type]; ?>, <?php echo $config['estateMarket'][$market]; ?></p>
		<?php 
			if($arenda_prodazha=='0'){
				$text='Аренда';
			} else {
				$text='Продаж';
			}
		?>
		<p><span>Аренда чи продаж:</span> <?php echo $text; ?></p>
		<p><span>Тип стін:</span> <?php echo $config['estateWalls'][$walls]; ?></p>
		<p><span>Площа житлова (кв. м):</span> <?php echo $residentialSq; ?></p>
		<p><span>Кухня (кв. м):</span> <?php echo $kitchenSq; ?></p>
		<p><span>Поверх:</span> <?php echo $floor; ?></p>
		<p><span>Поверховість:</span> <?php echo $superficiality; ?></p>
		<p><span>Опалення:</span> <?php echo $config['estateHeating'][$heating]; ?></p>
		<p><span>Рік побудови:</span> <?php echo $config['yearOfConstruction'][$yearOfConstruction]; ?></p>
		<p><span>Розмір комунальних, грн (зима):</span> <?php echo $utilitiesWinter; ?></p>
		<p><span>Розмір комунальних, грн (літо):</span> <?php echo $utilitiesSummer; ?></p>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
	<div id="map"></div>
	<form class="form_zapis">
		<h2>Записатися на огляд</h2>
		<div class="form_inputs">
			<div class="form_input">
				<label for="name">Ім'я</label>
				<input type="text" name="name" id="name">
			</div>
			<div class="form_input">
				<label for="phone">Телефон</label>
				<input type="text" name="phone" id="phone">
			</div>
		</div>
		<label for="vopros">Ваші запитання, побажання</label>
		<textarea name="vopros" id="vopros" rows="3"></textarea>
		<button type="submit">Записатися</button>
	</form>
	<h2>Вас також може зацікавити</h2>
	<div class="tri_producta">
		<?php
			$res = $DB->query(\DB\parse("SELECT * FROM estate ORDER BY RAND() LIMIT 3"),MYSQLI_USE_RESULT);
			$i=1;
			$zapros2='';
			while ($row = $res->fetch_assoc()) {
				$id2[$i]=$row['id'];
				$name2[$i]=$row['name'];
				$price2[$i]=$row['price'];
				$adress2[$i]=$row['adress'];
				$remont2[$i]=$row['remont'];
				$mebel2[$i]=$row['mebel'];
				$posle_stroiteley2[$i]=$row['posle_stroiteley'];
				$parking2[$i]=$row['parking'];
				$terasa2[$i]=$row['terasa'];
				$penthouse2[$i]=$row['penthouse'];
				$rooms2[$i]=$row['rooms'];
				if($i!=1){
					$zapros2.=' OR';
				}
				$i_product[$id2[$i]]=$i;
				$zapros2.=" parent_id='".$id2[$i]."'";
				$i_max=$i;
				$i++;
			}
			$zapros2="SELECT * FROM pictures WHERE (".$zapros2.") AND `order`='0'";
			$res->free();
			$res = $DB->query(($zapros2),MYSQLI_USE_RESULT);
			if($res!=false){
				while ($row = $res->fetch_assoc()) {
					$i=$i_product[$row['parent_id']];
					$img2[$i]=$row['img2'];
				}
			}
			for($i=1; $i<=$i_max; $i++){ ?>
				<div class="product">
					<div class="product_name_img">
						<a class="product_img_a" href="/product?id=<?php echo $id2[$i]; ?>">
							<div class="color_bg"></div>
							<div class="gradient_bg"></div>
							<img src="<?php echo $img2[$i]; ?>">
						</a>
						<a href="/product?id=<?php echo $id2[$i]; ?>" class="product_name_a"><?php echo $name2[$i]; ?></a>
					</div>
					<div class="product_info">
						<div class="left">
							<p><?php echo $price2[$i]; ?></p>
						</div>
						<div class="right">
							<p>id <?php echo $id2[$i]; ?></p>
						</div>
					</div>
					<?php 
						$num_feature=0;
					?>
					<div class="product_features">
						<?php 
							if($num_feature<3&&$remont2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_remont.png">
										<p>з ремонтом</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3&&$mebel2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_mebel.png">
										<p>з мебелью</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3&&$posle_stroiteley2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_posle_stroiteley.png">
										<p>після будівельників</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3&&$parking2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_parking.png">
										<p>паркінг</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3&&$terasa2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_terasa.png">
										<p>тераса</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3&&$penthouse2[$i]=='1'){
								?>
									<div class="item">
										<img src="/img/product_item_penthouse.png">
										<p>пентхаус</p>
									</div>
								<?php
								$num_feature++;
							}
							if($num_feature<3){
								if($rooms2[$i]=='1'){
									$komnat='кімната';
								} else if($rooms2[$i]=='2'||$rooms2[$i]=='3'||$rooms2[$i]=='4'){
									$komnat='кімнати';
								} else {
									$komnat='кімнат';
								}
								?>
									<div class="item">
										<img src="/img/product_item_komnata.png">
										<p><?php echo $rooms2[$i]." ".$komnat; ?></p>
									</div>
								<?
							}
						?>
					</div>
					<a href="/product?id=<?php echo $id2[$i]; ?>">детальніше</a>
				</div>
			<?php }
		?>	
	</div>
	<?php if(!empty($_COOKIE['history_ids'])){
			$ids_arr=explode('_', $_COOKIE['history_ids']); 
			for($i=0; $i<=2; $i++){
				if(!empty($ids_arr[$i+1])){
					if($i==0){
						$zapros=" id='".$ids_arr[$i]."'";
					} else {
						$zapros.=" OR id='".$ids_arr[$i]."'";
					}
				}
			}
			if(!empty($zapros)){ ?>
				<h2>Ви дивилися</h2>
				<div class="tri_producta">
					<?php
						$res = $DB->query(\DB\parse("SELECT * FROM estate WHERE ".$zapros),MYSQLI_USE_RESULT);
						$i=1;
						$zapros2='';
						while ($row = $res->fetch_assoc()) {
							$id2[$i]=$row['id'];
							$name2[$i]=$row['name'];
							$price2[$i]=$row['price'];
							$adress2[$i]=$row['adress'];
							$remont2[$i]=$row['remont'];
							$mebel2[$i]=$row['mebel'];
							$posle_stroiteley2[$i]=$row['posle_stroiteley'];
							$parking2[$i]=$row['parking'];
							$terasa2[$i]=$row['terasa'];
							$penthouse2[$i]=$row['penthouse'];
							$rooms2[$i]=$row['rooms'];
							if($i!=1){
								$zapros2.=' OR';
							}
							$i_product[$id2[$i]]=$i;
							$zapros2.=" parent_id='".$id2[$i]."'";
							$i_max=$i;
							$i++;
						}
						$zapros2="SELECT * FROM pictures WHERE (".$zapros2.") AND `order`='0'";
						$res->free();
						$res = $DB->query(($zapros2),MYSQLI_USE_RESULT);
						if($res!=false){
							while ($row = $res->fetch_assoc()) {
								$i=$i_product[$row['parent_id']];
								$img2[$i]=$row['img2'];
							}
						}
						for($i=1; $i<=$i_max; $i++){ ?>
							<div class="product">
								<div class="product_name_img">
									<a class="product_img_a" href="/product?id=<?php echo $id2[$i]; ?>">
										<div class="color_bg"></div>
										<div class="gradient_bg"></div>
										<img src="<?php echo $img2[$i]; ?>">
									</a>
									<a href="/product?id=<?php echo $id2[$i]; ?>" class="product_name_a"><?php echo $name2[$i]; ?></a>
								</div>
								<div class="product_info">
									<div class="left">
										<p><?php echo $price2[$i]; ?></p>
									</div>
									<div class="right">
										<p>id <?php echo $id2[$i]; ?></p>
									</div>
								</div>
								<?php 
									$num_feature=0;
								?>
								<div class="product_features">
									<?php 
										if($num_feature<3&&$remont2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_remont.png">
													<p>з ремонтом</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3&&$mebel2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_mebel.png">
													<p>з мебелью</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3&&$posle_stroiteley2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_posle_stroiteley.png">
													<p>після будівельників</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3&&$parking2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_parking.png">
													<p>паркінг</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3&&$terasa2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_terasa.png">
													<p>тераса</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3&&$penthouse2[$i]=='1'){
											?>
												<div class="item">
													<img src="/img/product_item_penthouse.png">
													<p>пентхаус</p>
												</div>
											<?php
											$num_feature++;
										}
										if($num_feature<3){
											if($rooms2[$i]=='1'){
												$komnat='кімната';
											} else if($rooms2[$i]=='2'||$rooms2[$i]=='3'||$rooms2[$i]=='4'){
												$komnat='кімнати';
											} else {
												$komnat='кімнат';
											}
											?>
												<div class="item">
													<img src="/img/product_item_komnata.png">
													<p><?php echo $rooms2[$i]." ".$komnat; ?></p>
												</div>
											<?
										}
									?>
								</div>
								<a href="/product?id=<?php echo $id2[$i]; ?>">детальніше</a>
							</div>
						<?php }
					?>
							
				</div>
	<?php 
			} 
	}
	?>
</div>
<?php 
   	$res = $DB->query("SELECT * FROM settings WHERE name='google_api'",MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        $google_api = $row['value'];
    }
    $res->free();
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=$google_api?>&callback=initMap&v=weekly" defer></script>
<script>
   	let map;

    function initMap() {
        if(<?php echo $coord_x ?>!='0'){
          	map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: <?php echo $coord_x ?>, lng: <?php echo $coord_y ?> },
                zoom: 17,
            });
            var marker = new google.maps.Marker({
                position: {lat: <?php echo $coord_x ?>, lng: <?php echo $coord_y ?>},
               	map: map,
           	});
        } else {
        	$("#map").fadeOut(0);
        }
    }

    window.initMap = initMap;
</script>
<?php require_once "footer.php"; ?>