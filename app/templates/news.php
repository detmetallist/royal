<?php

$res = $DB->query('SELECT * FROM settings',MYSQLI_USE_RESULT);
  
$settings = [];

while ($row = $res->fetch_assoc()) {
  $settings[$row['name']] = $row['value'];
}

$res->free();

?>
<?php require_once "header.php"; ?>
<div class="content">
	<div class="breadcrumps">
		<a href="/">Головна</a><span>></span>Новини
	</div>
	<?php 
		$res = $DB->query("SELECT count(*) FROM news",MYSQLI_USE_RESULT);
		if($res!=false){
			$row = $res->fetch_row();
			$news_count = $row[0];
			$pages_count=intdiv($news_count,$config['news_front_length']);
			$ostatok=$news_count % $config['news_front_length'];
			if($ostatok>0){
				$pages_count++;
			}
			$res->free();
		}
		if(!empty($_GET['page'])){
			if($_GET['page']=='1'){
				$limit=intval($config['news_front_length']);
				$limit_query=$limit;
			}
			else {
				$limit=intval($config['news_front_length'])*($_GET['page']-1);
				$limit_query=$limit.','.intval($config['news_front_length']);
			}
		} else {
			$limit=intval($config['news_front_length']);
			$limit_query=$limit;
		}

		$res = $DB->query(\DB\parse('SELECT * FROM news LIMIT '.$limit_query),MYSQLI_USE_RESULT);
	    while ($row = $res->fetch_assoc()) {
	        $name=$row['name'];
	        $description=$row['text'];
	        $img2=$row['img2'];
	        ?>
	        	<div class="post_content">
					<div class="title_data">
						<?php 
							$name_obrez=mb_substr($row['name'], 0, 70);
							if($name_obrez!=$row['name']){
								$name_obrez.="...";
							}
						?>
						<h2><?php echo $name_obrez; ?></h2>
						<div class="data"><?php echo $row['public_date']; ?></div>
					</div>
					<div class="post_description_img">
						<div class="post_description">
							<?php 
								$text_obrez=mb_substr(strip_tags($row['text']), 0, 450);
								if($text_obrez!=strip_tags($row['text'])){
									$text_obrez.="...";
								}
								echo $text_obrez;
							?>
						</div>
						<div class="post_img">
							<div class="color_bg"></div>
							<img src="<?php echo $row['img2']; ?>">
						</div>
					</div>
					<a href="/post?id=<?php echo $row['id']; ?>" class="post_a">Детальніше</a>
				</div>
	        <?php 
	    }
	?>
	<?php if($pages_count>1): ?>
		<div class="pagination">
			<?php 
				if($page>=1&&$page<=4){
					for($i=1; $i<=$page; $i++){
						if($page==$i){
							echo '<span>'.$i.'</span>';
						} else {
							echo '<a href="/news?page='.$i.'">'.$i.'</a>';
						}
					}
				} else {
					$page_minus=$page-1;
					echo '<a href="/news">1</a><a href="/news?page=2">2</a><span>..</span><a href="/news?page='.$page_minus.'">'.$page_minus.'</a><span>'.$page.'</span>';
				}
				if($pages_count>$page){
					$page_plus=$page+1;
					echo '<a href="/news?page='.$page_plus.'">'.$page_plus.'</a>';
				}
				if($pages_count>$page+1){
					if($pages_count==$page+2){
						echo '<a href="/news?page='.$pages_count.'">'.$pages_count.'</a>';
					} else if($pages_count==$page+3){
						$pages_count_minus=$pages_count-1;
						echo '<a href="/news?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/news?page='.$pages_count.'">'.$pages_count.'</a>';
					} else {
						$pages_count_minus=$pages_count-1;
						echo '<span>..</span><a href="/news?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/news?page='.$pages_count.'">'.$pages_count.'</a>';
					}
				}
			?>
		</div>
	<?php endif; ?>
</div>
<?php require_once "footer.php"; ?>