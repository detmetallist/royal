<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_FILES['userImage'])) {
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	  	$sourcePath = $_FILES['userImage']['tmp_name'];
	  	$targetPath = "uploads/".$_FILES['userImage']['name'];
	  	//exec('convert '.$targetPath.' -resize 300x300 uploads/output.jpg');
	  	if(move_uploaded_file($sourcePath,$targetPath)) {
	  		echo $targetPath;
	  		echo '<br>';
	  		$im = new Imagick($targetPath);
			$im->adaptiveResizeImage(0,300);
			$im->writeImage($targetPath.'_300.jpg');
	  		//$webp=create_webp($targetPath);
	  		//echo $webp;
	  	}
	}
}

function create_webp(string $src, int $quality=70):string {
	$dir=pathinfo($src, PATHINFO_DIRNAME);
	$name=pathinfo($src, PATHINFO_FILENAME);
	$ext=pathinfo($src, PATHINFO_EXTENSION);
	$dest=$dir.'/'.$name.'_'.$ext.'.webp';
	$is_alpha=false;
	if(mime_content_type($src)=='image/png'){
		$is_alpha=true;
		$img=imagecreatefrompng($src);
	} else if(mime_content_type($src)=='image/jpeg'){
		$img=imagecreatefromjpeg($src);
	} else {
		return $src;
	}
	if($is_alpha){
		imagepalettetotruecolor($img);
		imagealphablending($img, true);
		imagesavealpha($img, true);
	}
	imagewebp($img, $dest, $quality);
	return $dest;
}
?>