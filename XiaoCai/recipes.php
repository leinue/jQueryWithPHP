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
				<li id="recipe-material-index"><a id="recipe-menu-name-first">食材检索</a> <span class="glyphicon glyphicon-triangle-right"></span></li>
				<li>|</li>
				<li id="recipe-material-style"><a id="recipe-menu-name-second">料理风格</a> <span class="glyphicon glyphicon-triangle-right"></span></li>
			</ul>
		</div>
		
		<div id="recipe-menu-index" class="recipe-menu-container">
			<div class="recipe-menu-slidedown"></div>
		</div>
		
		<div id="recipe-menu-style" class="recipe-menu-container">
			<div class="recipe-menu-slidedown"></div>
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
			<div class="vip-title"><a href="introduction.php">会员专享标题</a></div>
			<div class="vip-post"><a href="introduction.php">内容标题内容标题内容标题内容标题内容标题内容标题内容标题内容标题</a></div>
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
			<div class="teacher-brand" id="monograph-member">
        		会员专享
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

		/*$('.vip-title,.vip-post').click(function(){
			loadPagesA('introduction.php','body');
		});*/

		getRecipeClassify(function(data){
			var jsonData=JSON.parse(data);
			$('.nav-recipe-menu ul li #recipe-menu-name-first').html(jsonData['data'][0]['title']);
			$('.nav-recipe-menu ul li #recipe-menu-name-second').html(jsonData['data'][1]['title']);
			var menuChild=jsonData['data'][0]['children'];
			var leftRow1='';
			var leftRow2='';
			var rightRow1='';
			var rightRow2='';
			var count=Math.ceil(parseInt(menuChild.length)/2);
			for (var j = 0; j < count; j++) {
				leftRow1+="<li><img src=\""+menuChild[j]['icon']+"\">"+menuChild[j]['title']+"</li>";
			};
			leftRow1="<ul>"+leftRow1+"</ul>";
			for (var j = 3; j < menuChild.length; j++) {
				leftRow2+="<li><img src=\""+menuChild[j]['icon']+"\">"+menuChild[j]['title']+"</li>";
			};
			leftRow2="<ul>"+leftRow2+"</ul>";

			var menuChild=jsonData['data'][1]['children'];
			var count=Math.ceil(parseInt(menuChild.length)/2);
			for (var j = 0; j < count; j++) {
				rightRow1+="<li>"+menuChild[j]['title']+"</li>";
			};
			rightRow1="<ul>"+rightRow1+"</ul>";
			for (var j = 3; j < menuChild.length; j++) {
				rightRow2+="<li>"+menuChild[j]['title']+"</li>";
			};
			rightRow2="<ul>"+rightRow2+"</ul>";
			$('#recipe-menu-index .recipe-menu-slidedown').append(leftRow1+leftRow2);
			$('#recipe-menu-style .recipe-menu-slidedown').append(rightRow1+rightRow2);
		});
	
	});

</script>

<?php include('footer.php'); ?>