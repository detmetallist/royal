<?php require_once "header.php"; ?>
<div class="content">
	<div class="breadcrumps">
		<a href="/">Головна</a><span>></span>Контакти
	</div>
	<?php 
		$contacts_title='';
    	$contacts_text='';
    	$contacts_map='';
		$res = $DB->query(\DB\parse('SELECT * FROM settings'),MYSQLI_USE_RESULT);
	    while ($row = $res->fetch_assoc()) {
	        if($row['name']=='contacts_title'){
	            $contacts_title=$row['value'];
	        }
	        if($row['name']=='contacts_text'){
	            $contacts_text=$row['value'];
	        }
	        if($row['name']=='contacts_map'){
	            $contacts_map=$row['value'];
	        }
	        $settings[$row['name']] = $row['value'];
	    }
	?>
	<div class="post_content contacts_content">
		<div class="title_data">
			<h2><?php echo $contacts_title; ?></h2>
		</div>
		<?php echo $contacts_text; ?>
	</div>
	<div class="map">
		<?php echo $contacts_map; ?>
	</div>
</div>
<?php require_once "footer.php"; ?>