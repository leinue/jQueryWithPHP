<?php

error_reporting(E_ALL & ~E_NOTICE);

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

$picname='../uploadimg/'.$_FILES['image']['name'];
move_uploaded_file($headimgurl,$picname);

$url="http://114.215.189.210/api.php/Api/Public/changeData1";
$post_data=array(
	"token_id"=>$token_id,
	"nickname"=>$nickname,
	"image"=>'@'.realpath($picname));

$oupput=curlPost($url,$post_data);

$resultObj=json_decode($oupput);
if($resultObj->error=='0'){
	header("location:../profile.php?error=$status");
}else{
	$status=$resultObj->error;
	$nickname=$resultObj->data->nickname;
	$img=$resultObj->data->headimgurl;
	$msg=$resultObj->msg;
	header("location:../profile.php?headimgurl=$img&error=$status");
}

?>