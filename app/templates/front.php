<?php

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
						<form id="input_search">
							<input name="search" placeholder="Пошук по сайту...">
							<button class="search_button"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="price_order">
						<p>ціна</p>
						<a href="#price_high"><i class="fa fa-angle-down"></i></a>
						<a href="#price_low"><i class="fa fa-angle-up"></i></a>
					</div>
				</div>
				<div class="products_content"></div>
			</div>
<?php require_once "footer.php"; ?>