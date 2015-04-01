	<link rel="stylesheet" href="extension/bootstrap.min.css" />
	<script type="text/javascript" src="extension/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="extension/bootstrap.min.js"></script>
	<script type="text/javascript" src="extension/unslider.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
	$(document).ready(function(){
		function handleHeaderEvent(){

		}

		$(document).click(function(){
			//$('header').slideToggle();
			$('footer').slideToggle();
		});

		$(window).scroll(handleHeaderEvent);

		/*幻灯片开始*/

		$(function() {
    		$('.banner').unslider();
		});

		if(window.chrome) {
			$('.banner li').css('background-size', '100% 100%');
		}

		$('.banner').unslider({
			arrows: true,	
			fluid: true,
			dots: true
		});

		/*幻灯片结束*/

		/*菜单按钮被点击*/
		var isSlided=false;
		$('.nav-menu').click(function(){
			var docWidth=$(document).width()-100;
			if(!isSlided){
				$('.main-page').animate({left:docWidth+'px'},400,function(){
					$('.login-page').css('display','block');
				});
				isSlided=true;
			}else{
				$('.main-page').animate({left:'0px'});
				$('.login-page').css('display','none');
				isSlided=false;
			}
		});
	});
	</script>
</body>
</html>
