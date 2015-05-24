<?php

error_reporting(E_ALL & ~E_NOTICE);

define('ROOT',dirname(__FILE__).'/');

/** 
* desription 压缩图片 
* @param sting $imgsrc 图片路径 
* @param string $imgdst 压缩后保存路径 
*/
function image_png_size_add($imgsrc,$imgdst){ 
  list($width,$height,$type)=getimagesize($imgsrc); 
  $new_width = ($width>600?600:$width)*0.9; 
  $new_height =($height>600?600:$height)*0.9; 
  switch($type){ 
    case 1: 
      $giftype=check_gifcartoon($imgsrc); 
      if($giftype){ 
        header('Content-Type:image/gif'); 
        $image_wp=imagecreatetruecolor($new_width, $new_height); 
        $image = imagecreatefromgif($imgsrc); 
        imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
        imagejpeg($image_wp, $imgdst,75); 
        imagedestroy($image_wp); 
      } 
      break; 
    case 2: 
      header('Content-Type:image/jpeg'); 
      $image_wp=imagecreatetruecolor($new_width, $new_height); 
      $image = imagecreatefromjpeg($imgsrc); 
      imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
      imagejpeg($image_wp, $imgdst,75); 
      imagedestroy($image_wp); 
      break; 
    case 3: 
      header('Content-Type:image/png'); 
      $image_wp=imagecreatetruecolor($new_width, $new_height); 
      $image = imagecreatefrompng($imgsrc); 
      imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
      imagejpeg($image_wp, $imgdst,75); 
      imagedestroy($image_wp); 
      break; 
  } 
} 
/** 
* desription 判断是否gif动画 
* @param sting $image_file图片路径 
* @return boolean t 是 f 否 
*/
function check_gifcartoon($image_file){ 
  $fp = fopen($image_file,'rb'); 
  $image_head = fread($fp,1024); 
  fclose($fp); 
  return preg_match("/".chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0'."/",$image_head)?false:true; 
} 

function curlPost($url,$argList){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $argList);

	$oupput=curl_exec($ch);
	curl_close($ch);

	return $oupput;
}

$token_id=$_POST['token_id'];
$nickname=$_POST['nickname'];
$headimgurl=$_FILES['image']['tmp_name'];

$picname='./uploadimg/'.$_FILES['image']['name'];
if(file_exists($picname)){
	unlink($picname);
}

move_uploaded_file($headimgurl, $picname);
// image_png_size_add($picname,$picname);

$url="http://114.215.189.210/api.php/Api/Public/changeData1";
$post_data=array(
	"token_id"=>$token_id,
	"nickname"=>$nickname,
	"image"=>'@'.realpath($picname));

$oupput=curlPost($url,$post_data);

$resultObj=json_decode($oupput);
if($resultObj->error=='0'){
	header("location:./profile.php?error=$status");
}else{
	$status=$resultObj->error;
	$nickname=$resultObj->data->nickname;
	$img=$resultObj->data->headimgurl;
	$msg=$resultObj->msg;
	header("location:./profile.php?headimgurl=$img&error=$status");
}

?>