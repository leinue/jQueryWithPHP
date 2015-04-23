<?php

require('base.php');

$recipe_id=$_POST['recipe_id'];
$token_id=$_POST['token_id'];
$formula_id=$_POST['formula_id'];
$url="http://114.215.189.210/api.php/Api/Recipe/addFoodList";
$post_data=array("type"=>$type,"token_id"=>$token_id);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
