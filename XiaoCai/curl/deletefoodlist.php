<?php

require('base.php');

$recipe_id=$_POST['recipe_id'];
$token_id=$_POST['token_id'];
$formula_id=$_POST['formula_id'];
$recipe_id=($recipe_id===0)?'':$recipe_id;
$formula_id=($formula_id===0)?'':$formula_id;
$url="http://114.215.189.210/api.php/Api/Recipe/deleteFoodList";
$post_data=array("recipe_id"=>$recipe_id,"token_id"=>$token_id,"formula_id"=>$formula_id);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
