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
	<!--<script type="text/javascript" src="js/recipes.js"></script>-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--<link rel="stylesheet" type="text/css" href="css/recipes.style.css">-->
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

		/*******************************全局变量区域*******************************/
		
		var isSlided=false;//侧边栏是否被滑出
		var footerIsDisplayed=false;//底部是否被显示

		//使用localSorage存储当前页面
		localStorage.pageVistiedCount=0;//记录用户浏览了多少页面
		localStorage.previousPage="index.php";

		localStorage.currentPage="";//栈
		
		/*******************************全局变量区域*******************************/

	</script>
</head>

<body>

<div class="login-page">
	<div class="logo-area">
		<img width="180" height="80" src="images/logo.png" />
		吃大餐·做晓菜
	</div>

	<div class="lo-re-area">
		<a class="button button-caution button-pill">登录</a>
		<div class="fast-register">快速注册</div>
	</div>

	<div class="column-menu">
		<ul>
			<li class="menu-reading-list"><span class="glyphicon glyphicon-list-alt"></span>阅读列表</li>
			<li class="menu-food-list"><span class="glyphicon glyphicon-align-justify"></span>食材采购清单</li>
			<li class="menu-response"><span class="glyphicon glyphicon-envelope"></span>收到的回复<span id="response-flag">·</span></li>
			<li class="menu-setting"><span class="glyphicon glyphicon-cog"></span>设置</li>
		</ul>
	</div>
</div>
