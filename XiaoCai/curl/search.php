<?php

require('base.php');

$keyword=$_POST['keyword'];
$url="http://114.215.189.210/api.php/Api/Recipe/search";
$post_data=array("keyword"=>$keyword);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
