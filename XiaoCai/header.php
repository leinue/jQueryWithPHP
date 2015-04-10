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
	<link rel="stylesheet" type="text/css" href="css/recipes-introduction.css">
	<link rel="stylesheet" type="text/css" href="css/formula.css">
	<link rel="stylesheet" type="text/css" href="css/step.css">
	<link rel="stylesheet" type="text/css" href="extension/buttons.css">
	<script type="text/javascript">
		/******************************页面访问记录栈******************************/
		//构造函数
		function StorageStack(current,prev){
			this.currentPage=current;
			this.pageVisitedCount=0;
			this.prevPage=new Array();
			this.prevPage[this.pageVisitedCount]=prev;
		}
			//进栈
			StorageStack.prototype.push=function(val){
				this.pageVisitedCount+=1;
				this.prevPage[this.pageVisitedCount]=val;
			}
			//出栈
			StorageStack.prototype.pop=function(){
				if(this.pageVisitedCount!=0){
					return this.prevPage[this.pageVisitedCount--];
				}else{
					return null;
				}
			
			}
			//取栈顶
			StorageStack.prototype.top=function(i){
				return this.prevPage[i];
			}
			//是否空
			StorageStack.prototype.isEmpty=function(){
				return this.pageVisitedCount==0 ? true:false;
			}
			//更改当前页面
			StorageStack.prototype.changeCurrentPage=function(current){
				this.currentPage=current;
			}

			StorageStack.prototype.forEach=function(f){
				for(var i=0;i<=this.pageVisitedCount;i++){
					f(this.prevPage[i]);
				}
			}

			StorageStack.prototype.toString=function(){
				return JSON.stringify(this);
			}

		//将JSON数据转换为栈
		function JSON2Stack(o){
			var stackObj=JSON.parse(o);
			var lsObj=new StorageStack(stackObj.currentPage,stackObj.prevPage[0]);
			lsObj.pageVisitedCount=stackObj.pageVisitedCount;
			for(var i=1;i<=stackObj.pageVisitedCount;i++){
				lsObj.push(stackObj.prevPage[i]);
			}
			return lsObj;
		}
		/******************************页面访问记录栈******************************/

		/**********************************函数库**********************************/
		
		//当前页面可否滚动,在加载页面和弹出右侧工具栏的时候禁止滚动,默认可滚动
		var docIsMoved=0;
		//控制页面是否可滚动
		function setNoTouchMove(){docIsMoved=0;}
		function setTocuhMove(){docIsMoved=1;}

		//返回上一个页面
		function backPreviosPage(currentPage){
			$('.loading').fadeIn();
			setNoTouchMove();
			var stackifyJSONStack=JSON2Stack(localStorage.pageStack);
			var pageLoaded=stackifyJSONStack.pop();
			$('body').load(pageLoaded,function(){
				$('.loading').fadeOut();
				setTocuhMove();
				stackifyJSONStack.pageVisitedCount-=1;
				stackifyJSONStack.currentPage=pageLoaded;
				localStorage.pageStack=stackifyJSONStack;//更新localStorage
			});	
		}

		//加载新页面,pageName为要加载的页面名,elem为存放元素
		function loadPagesA(pageName,elem){
			$('.loading').fadeIn();
			setNoTouchMove();
			$(elem).load(pageName,function(){
				$('.loading').fadeOut();
				setTocuhMove();
				var stackifyJSONStack=JSON2Stack(localStorage.pageStack);
				stackifyJSONStack.pageVisitedCount+=1;
				stackifyJSONStack.push(stackifyJSONStack.currentPage);
				stackifyJSONStack.currentPage=pageName;
				localStorage.pageStack=stackifyJSONStack;
			});
		}

		/**********************************函数库**********************************/

		/*******************************全局变量区域*******************************/
		
		var isSlided=false;//侧边栏是否被滑出
		var footerIsDisplayed=false;//底部是否被显示

		//使用localSorage存储当前页面
		var pages=new StorageStack('index.php','index.php');
		localStorage.pageStack=pages;
		
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
