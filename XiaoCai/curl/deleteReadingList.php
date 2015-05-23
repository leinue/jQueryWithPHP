<?php

require('base.php');

$type=$_POST['type'];
$token_id=$_POST['token_id'];
$article_id=$_POST['article_id'];
$url="http://114.215.189.210/api.php/Api/Recipe/deleteReadingList";
$post_data=array("type"=>$type,"token_id"=>$token_id,"article_id"=>$article_id);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
