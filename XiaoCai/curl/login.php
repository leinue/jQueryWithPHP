<?php

require('base.php');

$mobile=$_POST['mobile'];
$password=$_POST['password'];

$url="http://114.215.189.210/api.php/Api/Public/login";
$post_data=array(
	"mobile"=>$mobile,
	"password"=>$password);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>