<?php

require('base.php');

$token_id=$_POST['token_id'];
$nickname=$_POST['nickname'];
$headimgurl=$_POST['headimgurl'];

$url="http://114.215.189.210/api.php/Api/Public/changeData";
$post_data=array(
	"token_id"=>$token_id,
	"nickname"=>$nickname,
	"headimgurl"=>$headimgurl);

$oupput=curlPost($url,$post_data);

print_r($oupput);

?>
