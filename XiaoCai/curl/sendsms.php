<?php

require('base.php');

$mobile=$_POST['mobile'];
$type=$_POST['type'];

$url="http://114.215.189.210/api.php/Api/Public/sendSms";
$post_data=array(
	"mobile"=>$mobile,
	"type"=>$type);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>
