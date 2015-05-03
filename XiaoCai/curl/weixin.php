<?php

require('base.php');

$openid=$_POST['openid'];
$nickname=$_POST['nickname'];
$headimgurl=$_POST['headimgurl'];

$url="http://114.215.189.210/api.php/Api/Public/login";
$post_data=array(
	"openid"=>$openid,
	"nickname"=>$nickname,
	"headimgurl"=>$headimgurl);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>