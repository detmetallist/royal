<?php
	if($_POST['valut']=='usd'){
		$price_ot=$_POST['price_ot'];
		$price_do=$_POST['price_do'];
	} else {
		$res = $DB->query("SELECT * FROM settings WHERE name='eur' OR name='usd'",MYSQLI_USE_RESULT);
		while ($row = $res->fetch_assoc()) {
			if($row['name']=='eur'){
				$curs_eur=$row['value'];
			} else {
				$curs_usd=$row['value'];
			}
		}
		if($_POST['valut']=='uah'){
			$price_ot=round($_POST['price_ot']/$curs_usd);
			$price_do=round($_POST['price_do']/$curs_usd);
		} else {
			$price_ot=round($_POST['price_ot']/$curs_usd*$curs_eur);
			$price_do=round($_POST['price_do']/$curs_usd*$curs_eur);
		}	
	}
	$zapros="price>='".$price_ot."' AND price<='".$price_do."' AND totalSq>='".$_POST['ploshad_ot']."' AND totalSq<='".$_POST['ploshad_do']."'";
	if(!empty($_POST['orenda_prodazha'])){
		if($_POST['orenda_prodazha']=='2'){
			$zapros.=" AND arenda_prodazha='0'";
		} else {
			$zapros.=" AND arenda_prodazha='1'";
		}
	}
	if(!empty($_POST['property_type'])){
		$zapros.=" AND type='".$_POST['property_type']."'";
	}
	if(!empty($_POST['s_remontom_bez'])){
		if($_POST['s_remontom_bez']=='2'){
			$zapros.=" AND remont='0'";
		} else {
			$zapros.=" AND remont='1'";
		}
	}
	$zapros_komnat='';
	for($i=1; $i<=10; $i++){
		if(!empty($_POST['komnat_'.$i])){
			if($zapros_komnat==''){
				$zapros_komnat=" AND (rooms='".$i."'";
			} else {
				$zapros_komnat.=" OR rooms='".$i."'";
			}
		}
	}
	if(!empty($_POST['penthouse'])){
		if($zapros_komnat==''){
			$zapros_komnat=" AND (penthouse='1'";
		} else {
			$zapros_komnat.=" OR penthouse='1'";
		}
	}
	if($zapros_komnat!=''){
		$zapros_komnat.=")";
	}
	if($_POST['search_phrase']){
		$zapros.=" AND (name LIKE '%".$_POST['search_phrase']."%' OR country LIKE '%".$_POST['search_phrase']."%' OR oblast LIKE '%".$_POST['search_phrase']."%' OR city LIKE '%".$_POST['search_phrase']."%' OR adress LIKE '%".$_POST['search_phrase']."%' OR description LIKE '%".$_POST['search_phrase']."%')";
	} 
	$zapros=$zapros.$zapros_komnat;
	if($_POST['order']=='price_high'){
		$order='price DESC';
	} else if($_POST['order']=='price_low'){
		$order='price';
	} else {
		$order='id';
	}
	if($_POST['page']=='1'){
		$limit=intval($config['estates_front_length']);
		$limit_query=$limit;
	} else {
		$limit=intval($config['estates_front_length'])*($_POST['page']-1);
		$limit_query=$limit.','.intval($config['estates_front_length']);
	}
	if($zapros==''){
		$zapros_kolich="SELECT count(*) FROM estate";
		$zapros="SELECT * FROM estate ORDER BY ".$order." LIMIT ".$limit_query;
	} else {
		$zapros_kolich="SELECT count(*) FROM estate WHERE ".$zapros;
		$zapros="SELECT * FROM estate WHERE ".$zapros." ORDER BY ".$order." LIMIT ".$limit_query;
	}
	//echo $zapros_kolich;
	$res = $DB->query($zapros_kolich,MYSQLI_USE_RESULT);
	if($res!=false){
		$row = $res->fetch_row();
		$estates_count = $row[0];
		$pages_count=intdiv($estates_count,$config['estates_front_length']);
		$ostatok=$estates_count % $config['estates_front_length'];
		if($ostatok>0){
			$pages_count++;
		}
		$res->free();
		$res = $DB->query($zapros,MYSQLI_USE_RESULT);
		$i=1;
		$zapros2='';
		$i_max=0;
		while ($row = $res->fetch_assoc()) {
			$id[$i]=$row['id'];
			$name[$i]=$row['name'];
			if($_POST['valut']=='usd'){
				$price[$i]=$row['price'];
				$price_znak[$i]='$';
			} else if($_POST['valut']=='uah'){
				$price[$i]=round($row['price']*$curs_usd);
				$price_znak[$i]='грн';
			} else {
				$price[$i]=round($row['price']*$curs_usd/$curs_eur);
				$price_znak[$i]='€';
			}
			$adress[$i]=$row['adress'];
			$remont[$i]=$row['remont'];
			$mebel[$i]=$row['mebel'];
			$posle_stroiteley[$i]=$row['posle_stroiteley'];
			$parking[$i]=$row['parking'];
			$terasa[$i]=$row['terasa'];
			$penthouse[$i]=$row['penthouse'];
			$rooms[$i]=$row['rooms'];
			if($i!=1){
				$zapros2.=' OR';
			}
			$i_product[$id[$i]]=$i;
			$zapros2.=" parent_id='".$id[$i]."'";
			$i_max=$i;
			$i++;
		}
		$zapros2="SELECT * FROM pictures WHERE (".$zapros2.") AND `order`='0'";
		$res->free();
		$res = $DB->query(($zapros2),MYSQLI_USE_RESULT);
		if($res!=false){
			while ($row = $res->fetch_assoc()) {
				$i=$i_product[$row['parent_id']];
				$img[$i]=$row['img2'];
			}
		}
	} else {
		$estates_count=0;
		$i_max=0;
		$pages_count=0;
	}
	?>
	<p class="content_info">знайдено <?php echo $estates_count; ?> об'ектів</p>
	<div class="products">
	<?php
	for($i=1; $i<=$i_max; $i++){ ?>
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="/product?id=<?php echo $id[$i]; ?>">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="<?php echo $img[$i]; ?>">
				</a>
				<a href="/product?id=<?php echo $id[$i]; ?>" class="product_name_a"><?php echo $name[$i]; ?></a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна - <?php echo $price[$i].$price_znak[$i]; ?></p>
					<?php 
						$adres_obrez=mb_substr($adress[$i], 0, 22);
						if($adres_obrez!=$adress[$i]){
							$adres_obrez.='...';
						}
					?>
					<p><?php echo $adres_obrez; ?></p>
				</div>
				<div class="right">
				<p>id <?php echo $id[$i]; ?></p>
					<p><a href="/product?id=<?php echo $id[$i]; ?>">детальніше<span>></span></a></p>
				</div>
			</div>
			<?php 
				$num_feature=0;
			?>
			<div class="product_features">
				<?php 
					if($num_feature<3&&$remont[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_remont.png">
								<p>з ремонтом</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$mebel[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$posle_stroiteley[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_posle_stroiteley.png">
								<p>після будівельників</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$parking[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_parking.png">
								<p>паркінг</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$terasa[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_terasa.png">
								<p>тераса</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3&&$penthouse[$i]=='1'){
						?>
							<div class="item">
								<img src="/img/product_item_penthouse.png">
								<p>пентхаус</p>
							</div>
						<?php
						$num_feature++;
					}
					if($num_feature<3){
						if($rooms[$i]=='1'){
							$komnat='кімната';
						} else if($rooms[$i]=='2'||$rooms[$i]=='3'||$rooms[$i]=='4'){
							$komnat='кімнати';
						} else {
							$komnat='кімнат';
						}
						?>
							<div class="item">
								<img src="/img/product_item_komnata.png">
								<p><?php echo $rooms[$i]." ".$komnat; ?></p>
							</div>
						<?
					}
				?>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php if($pages_count>1): ?>
		<div class="pagination">
			<?php 
				if($_POST['page']>=1&&$_POST['page']<=4){
					for($i=1; $i<=$_POST['page']; $i++){
						if($_POST['page']==$i){
							echo '<span>'.$i.'</span>';
						} else {
							echo '<a href="/?page='.$i.'">'.$i.'</a>';
						}
					}
				} else {
					$page_minus=$_POST['page']-1;
					echo '<a href="/">1</a><a href="/?page=2">2</a><span>..</span><a href="/?page='.$page_minus.'">'.$page_minus.'</a><span>'.$_POST['page'].'</span>';
				}
				if($pages_count>$_POST['page']){
					$page_plus=$_POST['page']+1;
					echo '<a href="/?page='.$page_plus.'">'.$page_plus.'</a>';
				}
				if($pages_count>$_POST['page']+1){
					if($pages_count==$_POST['page']+2){
						echo '<a href="/?page='.$pages_count.'">'.$pages_count.'</a>';
					} else if($pages_count==$_POST['page']+3){
						$pages_count_minus=$pages_count-1;
						echo '<a href="/?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/?page='.$pages_count.'">'.$pages_count.'</a>';
					} else {
						$pages_count_minus=$pages_count-1;
						echo '<span>..</span><a href="/?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/?page='.$pages_count.'">'.$pages_count.'</a>';
					}
				}
			?>
		</div>
	<?php endif; ?>
