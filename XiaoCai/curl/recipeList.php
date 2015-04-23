<?php

require('base.php');

$id=$_POST['id'];
$page=$_POST['page'];
$limit=$_POST['limit'];
$url="http://114.215.189.210/api.php/Api/Recipe/recipeList";
$post_data=array("id"=>$id,"page"=>$page,"limit"=>$limit);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
