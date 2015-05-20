<?php

require('base.php');

$token_id=$_POST['token_id'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$oldpassword=$_POST["oldpassword"];

$url="http://114.215.189.210/api.php/Api/Public/ChangePassword";
$post_data=array(
	"token_id"=>$token_id,
	"password"=>$password,
	"repassword"=>$repassword,
	"oldpassword"=>$oldpassword);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>
