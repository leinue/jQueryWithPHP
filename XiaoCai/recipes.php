<?php require('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title recipe-title">一手好菜</li>
				<li class="search-form"><input type="search" placeholder="食谱 食材 工具 话题" /></li>
			</ul>
		</div>

		<div class="nav-recipe-menu">
			<ul>
				<li id="recipe-material-index">食材检索 <span class="glyphicon glyphicon-triangle-right"></span></li>
				<li>|</li>
				<li id="recipe-material-style">料理风格 <span class="glyphicon glyphicon-triangle-right"></span></li>
			</ul>
		</div>
		
		<div id="recipe-menu-index" class="recipe-menu-container">
			<div class="recipe-menu-slidedown">
				<ul>
					<li><img src="">美素</li>
					<li><img src="">汤和饮品</li>
					<li><img src="">肉和家禽</li>
				</ul>
				<ul>
					<li><img src="">鱼和海鲜</li>
					<li><img src="">米和面</li>
					<li><img src="">面包和甜品</li>
				</ul>
			</div>
		</div>
		
		<div id="recipe-menu-style" class="recipe-menu-container">

			<div class="recipe-menu-slidedown">
				<ul>
					<li>一锅菜</li>
					<li>早餐</li>
					<li>美素馆</li>
				</ul>
				<ul>
					<li>简单炖</li>
					<li>热锅快炒</li>
					<li>低脂轻食</li>
				</ul>
			</div>

		</div>

	</nav>
</header>


<section>

	<div class="vip-enjoy">
		<div class="vip-video">
			<video src="movie.ogg" controls="controls">
				您的浏览器不支持 video 标签。
			</video>
			<!--<img src="">-->
		</div>
		<div class="vip-content">
			<div class="vip-title">会员专享标题</div>
			<div class="vip-post">内容标题内容标题内容标题内容标题内容标题内容标题内容标题内容标题</div>
			<div class="vip-menu">
				<ul>
					<li><span class="glyphicon glyphicon-eye-open"></span> 268</li>
					<li><span class="glyphicon glyphicon-heart-empty"></span></li>
					<li><span class="glyphicon glyphicon-link"></span></li>
				</ul>
			</div>
			<div class="teacher-brand">
				ALVIN LEE
			</div>
		</div>
	</div>

	<div class="vip-enjoy">
		<div class="vip-video">
			<video src="movie.ogg" controls="controls">
				您的浏览器不支持 video 标签。
			</video>
			<!--<img src="">-->
		</div>
		<div class="vip-content">
			<div class="vip-title">会员专享标题</div>
			<div class="vip-post">内容标题内容标题内容标题内容标题内容标题内容标题内容标题内容标题</div>
			<div class="vip-menu">
				<ul>
					<li><span class="glyphicon glyphicon-eye-open"></span> 268</li>
					<li><span class="glyphicon glyphicon-heart-empty"></span></li>
					<li><span class="glyphicon glyphicon-link"></span></li>
				</ul>
			</div>
			<div class="teacher-brand">
				ALVIN LEE
			</div>
		</div>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

<footer>
	
</footer>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		//食谱上方按钮被单击
		//method可以为up|down
		function toggleBtnArrow(elem,method){
			switch(method){
				case 'up':
					$(elem).removeClass('glyphicon glyphicon-triangle-bottom');
					$(elem).addClass('glyphicon glyphicon-triangle-right');
					break;
				case 'down':
					$(elem).removeClass('glyphicon glyphicon-triangle-right');
					$(elem).addClass('glyphicon glyphicon-triangle-bottom');
					break;
			}
		}

		var recipeMenuIsSlided=false;
		var recipeLeftMenuIsSlided=false;
		var recipeRightMenuIsSlided=false;

		$('.nav-recipe-menu ul li').click(function(){
			var typeClicked=$(this).attr('id').split('-');
			if(!recipeMenuIsSlided){
				if(recipeLeftMenuIsSlided){
					toggleBtnArrow('.nav-recipe-menu ul #recipe-material-index span','up');
					$('#recipe-menu-index').slideUp();
					recipeLeftMenuIsSlided=false;
					recipeMenuIsSlided=false;
					if(typeClicked[2]=='index'){
						$(this).find('span').removeClass('glyphicon glyphicon-triangle-bottom');
						$(this).find('span').addClass('glyphicon glyphicon-triangle-right');
						return;
					}
				}

				if(recipeRightMenuIsSlided){
					toggleBtnArrow('.nav-recipe-menu ul #recipe-material-style span','up');
					$('#recipe-menu-style').slideUp();
					recipeRightMenuIsSlided=false;
					recipeMenuIsSlided=false;
					if(typeClicked[2]=='style'){
						$(this).find('span').removeClass('glyphicon glyphicon-triangle-bottom');
						$(this).find('span').addClass('glyphicon glyphicon-triangle-right');
						return;
					}
				}

				$(this).find('span').removeClass('glyphicon glyphicon-triangle-right');
				$(this).find('span').addClass('glyphicon glyphicon-triangle-bottom');
				
				$('#recipe-menu-'+typeClicked[2]).slideDown();
				if(typeClicked[2]=='index'){
					recipeLeftMenuIsSlided=true;
				}else if(typeClicked[2]=='style'){
					recipeRightMenuIsSlided=true;
				}
			}
		});

		$('.vip-title,.vip-post').click(function(){
			loadPagesA('introduction.php','body');
		});
	
	});

</script>

<?php require('footer.php'); ?>