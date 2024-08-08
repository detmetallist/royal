<?php require_once "header.php"; ?>
<div class="content">
	<div class="breadcrumps">
		<a href="/">Головна</a><span>></span>Про компанiю
	</div>
	<?php 
		$pro_title='';
    	$pro_text='';
		$res = $DB->query(\DB\parse('SELECT * FROM settings'),MYSQLI_USE_RESULT);
	    while ($row = $res->fetch_assoc()) {
	        if($row['name']=='pro_title'){
	            $pro_title=$row['value'];
	        }
	        if($row['name']=='pro_text'){
	            $pro_text=$row['value'];
	        }
	        $settings[$row['name']] = $row['value'];
	    }
	?>
	<div class="post_content">
		<div class="title_data">
			<h2><?php echo $pro_title; ?></h2>
		</div>
		<?php echo $pro_text; ?>
	</div>
</div>
<?php require_once "footer.php"; ?>