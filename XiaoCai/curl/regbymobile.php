<?php

$url="http://114.215.189.210/api.php/Api/Public/reg";
$post_data=array(
	"mobile"=>"18115992267",
	"password"=>"123456",
	"repassword"=>"123456",
	"code"=>"5547");

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>
