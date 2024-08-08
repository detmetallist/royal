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
	<div class="breadcrumps">
		<a href="#">Крошки</a> <span>></span> <a href="#">Крошки</a> <span>></span>Крошки
	</div>
	<div class="product_content">
		<h2 class="mobile_zagol">Назва товару</h2>
		<div class="left">
			<h2>Назва товару</h2>
			<div class="price_switch">
				<h3>Ціна</h3>
				<a href="#price_usd">USD</a>
				<a href="#price_eur">EUR</a>
				<a href="#price_uah">UAH</a>
				<input type="hidden" name="price_switch">
			</div>
			<p>###########################</p>
			<p><span>id</span>########################</p>
			<p><span>площа, м</span><span class="span_stepen">2</span>###############</p>
			<p><span>адреса</span>##################</p>
			<p>############################</p>
			<p>############################</p>
			<p>############################</p>
		</div>
		<div class="right">
			<div class="slider_big_img">
				<div class="color_bg"></div>
				<img src="img/main_product1.jpg">
			</div>
			<div class="slider_container">
				<div class="owl-carousel owl-theme" id="slider">
					<div class="slide active">
					    <a href="img/main_product1.jpg"><img src="img/main_product1_thumb.jpg"><div class="slide_bg"></div></a>
					    
					</div>
					<div class="slide">
					    <a href="img/main_product2.jpg">
					    	<img src="img/main_product2_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>				    
					</div>
					<div class="slide">
					    <a href="img/main_product3.jpg">
					    	<img src="img/main_product3_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product4.jpg">
					    	<img src="img/main_product4_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product5.jpg">
					    	<img src="img/main_product5_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product6.jpg">
					    	<img src="img/main_product6_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product7.jpg">
					    	<img src="img/main_product7_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product8.jpg">
					    	<img src="img/main_product8_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product9.jpg">
					    	<img src="img/main_product9_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product10.jpg">
					    	<img src="img/main_product10_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product11.jpg">
					    	<img src="img/main_product11_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
					<div class="slide">
					    <a href="img/main_product12.jpg">
					    	<img src="img/main_product12_thumb.jpg">
					    	<div class="slide_bg"></div>
					    </a>
					</div>
				</div>
			</div>
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
		<div class="item">
			<img src="img/product_item_parking.png">
			<p>паркінг</p>
		</div>
		<div class="item">
			<img src="img/product_item_lift.png">
			<p>ліфт в паркінг</p>
		</div>
		<div class="item">
			<img src="img/product_item_terasa.png">
			<p>тераса</p>
		</div>
	</div>
	<p>Опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис  опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис опис </p>
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
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
	</div>
	<h2>Ви дивилися</h2>
	<div class="tri_producta">
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
		<div class="product">
			<div class="product_name_img">
				<a class="product_img_a" href="post.php">
					<div class="color_bg"></div>
					<div class="gradient_bg"></div>
					<img src="img/main_product1.jpg">
				</a>
				<a href="post.php" class="product_name_a">Назва товару...</a>
			</div>
			<div class="product_info">
				<div class="left">
					<p>ціна</p>
				</div>
				<div class="right">
					<p>id xxxxxxxxx</p>
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
			<a href="post.php">детальніше</a>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>