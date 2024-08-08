<?php 
	$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
	  
	$settings = [];

	while ($row = $res->fetch_assoc()) {
	  $settings[$row['name']] = $row['value'];
	}

	$res->free();
	$res = $DB->query(\DB\parse('SELECT * FROM news WHERE id=?',$_GET['id']),MYSQLI_USE_RESULT);
	while ($row = $res->fetch_assoc()) {
		$name=$row['name'];
		$text=$row['text'];
		$img3=$row['img3'];
		$date=$row['public_date'];
	}
	$res->free();
?>
<?php require_once "header.php"; ?>
<div class="content">
	<div class="breadcrumps">
		<a href="/">Головна</a> <span>></span> <a href="/news">Новини</a> <span>></span><?php echo $name; ?>
	</div>
	<div class="post_content">
		<div class="title_data news_post_title">
			<h2><?php echo $name; ?></h2>
			<div class="data"><?php echo $date; ?></div>
		</div>
		<div class="post_img news_post_img">
			<div class="color_bg"></div>
			<img src="<?php echo $img3; ?>">
		</div>
		<div class="news_description">
			<?php echo $text; ?>
		</div>
		<a href="/news" class="back_a">Назад</a>
	</div>
</div>
<?php require_once "footer.php"; ?>