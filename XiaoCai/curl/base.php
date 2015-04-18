<?php

function curlPost($url,$argList){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $argList);

	$oupput=curl_exec($ch);
	curl_close($ch);

	return $oupput;
}

?>
