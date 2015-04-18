<?php

require('base.php');

$id=$_POST['id'];
$comments_id=$_POST['comments_id'];
$url="http://114.215.189.210/api.php/Api/Recipe/skillsInfo";
$post_data=array("id"=>$id,"comments_id"=>$comments_id);
$oupput=curlPost($url,$post_data);
print_r($oupput);

?>
