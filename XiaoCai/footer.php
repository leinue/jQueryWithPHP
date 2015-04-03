	<script type="text/javascript">
	$(document).ready(function(){
		
		/************全局变量区域************/
		
		var isSlided=false;//侧边栏是否被滑出
		var footerIsDisplayed=false;//底部是否被显示

		//使用localSorage存储当前页面
		localStorage.pageVistiedCount=0;//记录用户浏览了多少页面
		localStorage.previousPage="index.php";

		localStorage.currentPage="";//栈
		
		/***********全局变量区域************/

		//添加动画效果
		$('ul li,a,h1,h2,h3,h4,h5,h6,p,span').hover(
			function(){
				$(this).stop().animate({opacity:0.6},'fast');
			},
			function(){
				$(this).stop().animate({opacity:1},'fast');
			}
		);

		function isUserAtBottom(){
			return (($(document).height()-$(window).height())-$(window).scrollTop())<=60 ? true:false;
		}

		//处理底部菜单滑动事件,若用户滑动到底部则自动隐藏
		function handleFooterEvent(){
			console.log($(window).scrollTop());
			if(($(window).height()+$(window).scrollTop())>=$(document).height()){
				if(footerIsDisplayed){
					
				}else{
					$('footer').slideUp();
					footerIsDisplayed=true;
				}
			}else{
				if($(window).scrollTop()==0){
					$('footer').slideDown();
					footerIsDisplayed=false;
				}
			}
		}

		$(document).click(function(){
			//$('header').slideToggle();
			//$('footer').slideToggle();
		});

		//用户滑动页面时处理
		$(window).scroll(handleFooterEvent);

		/*幻灯片开始*/

		$(function() {$('.banner').unslider();});

		if(window.chrome) {$('.banner li').css('background-size', '100% 100%');}

		$('.banner').unslider({
			arrows: true,	
			fluid: true,
			dots: true
		});

		/*幻灯片结束*/

		/*菜单按钮被点击*/
		function toggleLeftMenu(){
			var rate=0.2545;
			if($(document).width()>400){
				rate=0.2745;
			}else{
				rate=0.2945;
			}
			var docWidth=$(document).width()-($(document).width()*rate);
			var mainPageWidth=$(document).width()*rate;
			if(!isSlided){
				$('.main-page').animate({left:docWidth+'px'},400,function(){
					$('.login-page').css('display','block');
					//$('.main-page').css('width',mainPageWidth+'px');
				});
				$('footer').hide();
				isSlided=true;
			}else{
				$('.main-page').animate({left:'0px'});
				$('.login-page').css('display','none');
				$('footer').show();
				//$('.main-page').css('width',oWidth+'px');
				isSlided=false;
			}	
		}
		//var oWidth=$('.main-page').width();//主界面的原宽度
		$('.nav-menu').click(function(){
			toggleLeftMenu();
		});

		function loadPagesInMenu(pageName){
			toggleLeftMenu();
			$('.loading').fadeIn();
			$('body').load(pageName,function(){
				$('.loading').fadeOut();
				localStorage.pageVistiedCount+=1;
				localStorage.previousPage=localStorage.currentPage;
				localStorage.currentPage=pageName;
			});
		}

		//加载阅读列表界面
		$('.menu-reading-list').click(function(){
			loadPagesInMenu('reading.php');
		});

		//加载收到的回复界面
		$('.menu-response').click(function(){
			loadPagesInMenu('reversion.php');
		});

		//加载设置界面
		$('.menu-setting').click(function(){
			loadPagesInMenu('setting.php');
		});

	});
	</script>
</body>
</html>
