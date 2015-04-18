<?php

require('base.php');

$mobile=$_POST['mobile'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$code=$_POST["code"];

$url="http://114.215.189.210/api.php/Api/Public/ForgotPassword";
$post_data=array(
	"mobile"=>$mobile,
	"password"=>$password,
	"repassword"=>$repassword,
	"code"=>$code);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>
