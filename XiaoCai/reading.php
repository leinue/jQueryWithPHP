<?php require('header.php'); ?>

<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">阅读列表</div>
		</div>
		<div class="header-reading-menu">
			<ul>
				<li id="reading-list-all"><span class="header-reading-menu-active">全部</span></li>
				<li id="reading-list-receip"><span>食谱</span></li>
				<li id="reading-list-skills"><span>技巧</span></li>
				<li id="reading-list-review"><span>测评</span></li>
			</ul>
		</div>
	</nav>
</header>

<section>
	
</section>

<script type="text/javascript">
	$(document).ready(function(){

		$('section').load('pages/reading/reading_all.php',function(){
			$('.loading').fadeOut();
		});

		//
		function toggleMenu(obj){
			//获得当前活跃菜单项的index
			var liIndex=$('.header-reading-menu-active').index();
			//取消当前活跃菜单项的活跃
			$('.header-reading-menu-active').removeClass('header-reading-menu-active');	
		}

		//头部菜单点击事件
		$('.header-reading-menu ul li span').click(function(){
			var typeClicked=$(this).parent().attr('id').split('-');
			var _this=$(this);
			//显示正在加载
			$('.loading').fadeIn();
			$('section').load('pages/reading/reading_'+typeClicked[2]+'.php',function(){
				//去掉正在加载
				$('.loading').fadeOut();
				//修改现行活动菜单
				toggleMenu(this);
				_this.addClass('header-reading-menu-active');
			});
		});
	});
</script>

<?php require('footer.php'); ?>