<?php

$page=$_GET['page'];

switch ($page) {
	case 'php':
		echo 'php 2333';
		break;
	case 'json':
		echo 'json 2333';
		break;
	case 'jquery':
		echo 'jquery 2333';
		break;
	case 'ajax':
		echo 'ajax 2333';
		break;
	default:
		echo 'invalid 2333';
		break;
}

?>