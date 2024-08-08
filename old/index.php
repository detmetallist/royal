<?php

define('HELPERS', __DIR__.'/admin/app/helpers');

//session_start();

include __DIR__.'/admin/app/config.php';
include HELPERS.'/db.php';

DB\connect($config['DB']['host'],$config['DB']['user'],$config['DB']['password'],$config['DB']['database']);
$DB->query('SET NAMES utf8');

//Получаем данные из настроек сайта

$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
  
$settings = [];

while ($row = $res->fetch_assoc()) {
  $settings[$row['name']] = $row['value'];
}

$res = $DB->query('SELECT count(*) FROM estate',MYSQLI_USE_RESULT);
$row = $res->fetch_row();
$estates_count = $row[0];
$pages_count=intdiv($estates_count,$config['estates_front_length']);
$ostatok=$estates_count % $config['estates_front_length'];
if($ostatok>0){
	$pages_count++;
}

$res->free();

?>

<?php require_once "header.php"; ?>
			<div class="content">
				<div class="content_top">
					<div class="input_search">
						<input name="search" placeholder="Пошук по сайту...">
						<button class="search_button"><i class="fa fa-search"></i></button>
					</div>
					<div class="price_order">
						<p>ціна</p>
						<a href="#price_high"><i class="fa fa-angle-down"></i></a>
						<a href="#price_low"><i class="fa fa-angle-up"></i></a>
					</div>
				</div>
				<p class="content_info">знайдено <?php echo $estates_count; ?> об'ектів</p>
				<div class="products">
					<?php 
						$i=1;
						$res = $DB->query(('SELECT * FROM estate ORDER BY id LIMIT '.intval($config['estates_front_length'])),MYSQLI_USE_RESULT);
						while ($row = $res->fetch_assoc()) {
							$id[$i]=$row['id'];
							$price[$i]=$row['price'];
							$adress[$i]=$row['adress'];
							
						}
					?>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product1.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
							<div class="item">
								<img src="img/product_item_remont.png">
								<p>з ремонтом</p>
							</div>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p>1 кімната</p>
							</div>
						</div>
					</div>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product2.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
							<div class="item">
								<img src="img/product_item_posle_stroiteley.png">
								<p>після будівельників</p>
							</div>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p>2 кімнати</p>
							</div>
						</div>
					</div>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product3.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
							<div class="item">
								<img src="img/product_item_parking.png">
								<p>паркінг</p>
							</div>
							<div class="item">
								<img src="img/product_item_lift.png">
								<p>ліфт в паркінг</p>
							</div>
						</div>
					</div>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product4.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_terasa.png">
								<p>тераса</p>
							</div>
							<div class="item">
								<img src="img/product_item_posle_stroiteley.png">
								<p>після будівельників</p>
							</div>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p>5 кімнат</p>
							</div>
						</div>
					</div>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product5.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
							<div class="item">
								<img src="img/product_item_remont.png">
								<p>з ремонтом</p>
							</div>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p>1 кімната</p>
							</div>
						</div>
					</div>
					<div class="product">
						<div class="product_name_img">
							<a class="product_img_a" href="product.php">
								<div class="color_bg"></div>
								<div class="gradient_bg"></div>
								<img src="img/main_product6.jpg">
							</a>
							<a href="product.php" class="product_name_a">Назва товару...</a>
						</div>
						<div class="product_info">
							<div class="left">
								<p>ціна</p>
								<p>адреса</p>
							</div>
							<div class="right">
								<p>id xxxxxxxxx</p>
								<p><a href="product.php">детальніше<span>></span></a></p>
							</div>
						</div>
						<div class="product_features">
							<div class="item">
								<img src="img/product_item_mebel.png">
								<p>з мебелью</p>
							</div>
							<div class="item">
								<img src="img/product_item_penthouse.png">
								<p>пентхаус</p>
							</div>
							<div class="item">
								<img src="img/product_item_komnata.png">
								<p>2 кімнати</p>
							</div>
						</div>
					</div>
				</div>
				<?php 
					
				?>
				<?php if($pages_count>1): ?>
					<div class="pagination">
						<span>1</span>
						<a href="/?page=2">2</a>
						<?php 
							if($pages_count>2){
								for($i=3;$i<=$pages_count;$i++){
									echo '<a href="/?page='.$i.'">'.$i.'</a>';
								}
							}
						?>
					</div>
				<?php endif; ?>
<?php require_once "footer.php"; ?>