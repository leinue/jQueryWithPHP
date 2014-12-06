<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
	echo 'request susccessful.';
}else{
	echo 'this is an AJAX request.';
}

?>