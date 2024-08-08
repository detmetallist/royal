<?php 
	$kol_hat=0;
	if($_POST['search']&&ctype_digit($_POST['search'])){
		$zapros="SELECT * FROM estate WHERE id=".$_POST['search'];
		$res = $DB->query($zapros,MYSQLI_USE_RESULT);
		while ($row = $res->fetch_assoc()) {
			$name=$row['name'];
			$price=$row['price'];
			$adress=$row['adress'];
			$remont=$row['remont'];
			$mebel=$row['mebel'];
			$posle_stroiteley=$row['posle_stroiteley'];
			$parking=$row['parking'];
			$terasa=$row['terasa'];
			$penthouse=$row['penthouse'];
			$rooms=$row['rooms'];
			$kol_hat++;
		}
		$res->free();
		$zapros2="SELECT * FROM pictures WHERE parent_id=".$_POST['search']." AND `order`='0'";
		$res = $DB->query($zapros2,MYSQLI_USE_RESULT);
		if($res!=false){
			while ($row = $res->fetch_assoc()) {
				$img=$row['img2'];
			}
		}
	}
	?>
	<?php if($_POST['search']&&$kol_hat>0&&ctype_digit($_POST['search'])): ?>
	<div class="products">
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="/product?id=<?php echo $_POST['search']; ?>">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="<?php echo $img; ?>">
				</a>
				<a href="/product?id=<?php echo $_POST['search']; ?>" class="product_name_a"><?php echo $name; ?></a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна - <?php echo $price; ?>$</p>
					<?php 
						$adres_obrez=mb_substr($adress, 0, 22);
						if($adres_obrez!=$adress){
							$adres_obrez.='...';
						}
					?>
					<p><?php echo $adres_obrez; ?></p>
				</div>
				<div class="right">
				<p>id <?php echo $_POST['search']; ?></p>
					<p><a href="/product?id=<?php echo $_POST['search']; ?>">детальніше<span>></span></a></p>
				</div>
			</div>
			<?php 
				$num_feature=0;
			?>
			<div class="product_features">
				<?php 
					if($num_feature<3&&$remont=='1'){
						?>
							<div class="item">
								<img src="img/product_item_remont.png">
								<p>з ремонтом</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$mebel=='1'){
						?>
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$posle_stroiteley=='1'){
						?>
							<div class="item">
								<img src="img/product_item_posle_stroiteley.png">
								<p>після будівельників</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$parking=='1'){
						?>
							<div class="item">
								<img src="img/product_item_parking.png">
								<p>паркінг</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$terasa=='1'){
						?>
							<div class="item">
								<img src="img/product_item_terasa.png">
								<p>тераса</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$penthouse=='1'){
						?>
							<div class="item">
								<img src="img/product_item_penthouse.png">
								<p>пентхаус</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3){
						if($rooms=='1'){
							$komnat='кімната';
						} else if($rooms=='2'||$rooms=='3'||$rooms=='4'){
							$komnat='кімнати';
						} else {
							$komnat='кімнат';
						}
						?>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p><?php echo $rooms." ".$komnat; ?></p>
							</div>
						<?
					}
				?>
			</div>
		</div>
	</div>
	<?php else: ?>
		<p class="content_info">Не знайдено об'ектів с таким id</p>
	<?php endif; ?>