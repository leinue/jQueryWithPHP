<!DOCTYPE html>
<html>
<head>
	<title>晓菜</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="extension/bootstrap.min.css" />
	<script type="text/javascript" src="extension/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="extension/bootstrap.min.js"></script>
	<script type="text/javascript" src="extension/unslider.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="extension/buttons.css">
	<script type="text/javascript">
		/**********************************函数库**********************************/
		
		//返回上一个页面
		function backPreviosPage(currentPage){
			var pageLoaded=localStorage.previousPage;
			$('body').load(pageLoaded,function(){
				localStorage.pageVistiedCount-=1;
				localStorage.previousPage=currentPage;
				localStorage.currentPage=pageLoaded;
			});	
		}
		
		/**********************************函数库**********************************/
	</script>
</head>

<body>