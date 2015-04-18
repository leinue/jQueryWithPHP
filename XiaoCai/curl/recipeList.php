<?php

require('base.php');

$id=$_POST['id'];
$url="http://114.215.189.210/api.php/Api/Recipe/recipeList";
$post_data=array("id"=>$id);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
