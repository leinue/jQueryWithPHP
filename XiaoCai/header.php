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
			$('.loading').fadeIn();
			var pageLoaded=localStorage.previousPage;
			$('body').load(pageLoaded,function(){
				$('.loading').fadeOut();
				localStorage.pageVistiedCount-=1;
				localStorage.previousPage=currentPage;
				localStorage.currentPage=pageLoaded;
			});	
		}

		//加载新页面,pageName为要加载的页面名,elem为存放元素
		function loadPagesA(pageName,elem){
			$('.loading').fadeIn();
			$(elem).load(pageName,function(){
				$('.loading').fadeOut();
				localStorage.pageVistiedCount+=1;
				localStorage.previousPage=localStorage.currentPage;
				localStorage.currentPage=pageName;
			});
		}

		/**********************************函数库**********************************/
	</script>
</head>

<body>