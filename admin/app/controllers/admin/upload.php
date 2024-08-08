<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_FILES['userImage'])) {
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	  	$sourcePath = $_FILES['userImage']['tmp_name'];
	  	$targetPath = $_SERVER['DOCUMENT_ROOT']."/uploads/".$_FILES['userImage']['name'];
	  	$resize[]=$_FILES['userImage']['name'];
	  	if(move_uploaded_file($sourcePath,$targetPath)) {
	  		foreach ($config['imageSize'] as $size) {
               	$resize[]=resize_picture($targetPath, $size[0], $size[1]);
            }
            echo json_encode($resize);
	  	}
	}
}

function resize_picture(string $src, int $result_width, int $result_height):string {
	$size = getimagesize($src);
	$src_width=$size[0];
	$src_height=$size[1];
	$dir=pathinfo($src, PATHINFO_DIRNAME);
	$name=pathinfo($src, PATHINFO_FILENAME);
	$ext=pathinfo($src, PATHINFO_EXTENSION);
	$result_proportion=$result_width/$result_height;
	$src_proportion=$src_width/$src_height;
	$im = new Imagick($src);
	if($src_proportion<$result_proportion){
		$im->adaptiveResizeImage($result_width,0);
	} else {
		$im->adaptiveResizeImage(0,$result_height);
	}
	$im->writeImage($dir.'/'.$name.'_'.$result_width.'_'.$result_height.'.'.$ext);
	$dest=$name.'_'.$result_width.'_'.$result_height.'.'.$ext;
	return $dest;
}

?>