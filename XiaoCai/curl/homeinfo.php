<?php

require('base.php');

$id=$_POST['id'];
$page=$_POST['page'];
$limit=$_POST['limit'];
$comments_id=$_POST['comments_id'];
$url="http://114.215.189.210/api.php/Api/Recipe/homeInfo";
$post_data=array("id"=>$id,"comments_id"=>$comments_id,"page"=>$page,"limit"=>$limit);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
