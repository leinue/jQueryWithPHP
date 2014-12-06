<?php

if($_GET['what']=='good'){
	$names=array('a','b','c','d');
	echo printHTML($names);
}else if($_GET['what']=='bad'){
	$names=array('e','f','g','h');
	echo printHTML($names);
}

function printHTML($data){
	$strRusult='<ul>';
	for($i=0;$i<count($data);$i++){
		$strRusult.='<li>'.$data[$i].'</li>';
	}
	$strRusult.='</ul>';
	return $strRusult;
}

?>