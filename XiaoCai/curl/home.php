<?php

require('base.php');

$page=$_POST['page'];
$limit=$_POST['limit'];
$url="http://114.215.189.210/api.php/Api/Recipe/home";
$post_data=array();
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
