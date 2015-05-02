<?php require('header.php'); ?>

<div class="main-page">
	
<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title recipe-title">一手好菜</li>
				<li class="search-form">
					<input type="search" placeholder="食谱 食材 工具 话题" />
					<div style="top:15px;" class="search-input-icon"><span class="glyphicon glyphicon-search"></span></div>
				</li>
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

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

</div>

<script type="text/javascript">
		
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

		$('.recipe-menu-container').css('top',$('header').height());

		var recipeMenuIsSlided=false;
		var recipeLeftMenuIsSlided=false;
		var recipeRightMenuIsSlided=false;

		function toggleSlideMenu(obj){
			var typeClicked=$(obj).attr('id').split('-');
			if(!recipeMenuIsSlided){
				if(recipeLeftMenuIsSlided){
					toggleBtnArrow('.nav-recipe-menu ul #recipe-material-index span','up');
					$('#recipe-menu-index').slideUp();
					recipeLeftMenuIsSlided=false;
					recipeMenuIsSlided=false;
					if(typeClicked[2]=='index'){
						$(obj).find('span').removeClass('glyphicon glyphicon-triangle-bottom');
						$(obj).find('span').addClass('glyphicon glyphicon-triangle-right');
						return;
					}
				}

				if(recipeRightMenuIsSlided){
					toggleBtnArrow('.nav-recipe-menu ul #recipe-material-style span','up');
					$('#recipe-menu-style').slideUp();
					recipeRightMenuIsSlided=false;
					recipeMenuIsSlided=false;
					if(typeClicked[2]=='style'){
						$(obj).find('span').removeClass('glyphicon glyphicon-triangle-bottom');
						$(obj).find('span').addClass('glyphicon glyphicon-triangle-right');
						return;
					}
				}

				$(obj).find('span').removeClass('glyphicon glyphicon-triangle-right');
				$(obj).find('span').addClass('glyphicon glyphicon-triangle-bottom');
				
				$('#recipe-menu-'+typeClicked[2]).slideDown();
				if(typeClicked[2]=='index'){
					recipeLeftMenuIsSlided=true;
				}else if(typeClicked[2]=='style'){
					recipeRightMenuIsSlided=true;
				}
			}
		}

		$('.nav-recipe-menu ul li').click(function(){
			toggleSlideMenu(this);
		});
		
		displayALertForm('正在加载...');
		getRecipeClassify(function(data){
			if(data!=''){
				var jsonData=JSON.parse(data);
				if(jsonData['msg']=='成功'){
					$('.nav-recipe-menu ul li #recipe-menu-name-first').html(jsonData['data'][0]['title']);
					$('.nav-recipe-menu ul li #recipe-menu-name-second').html(jsonData['data'][1]['title']);
					var menuChild=jsonData['data'][0]['children'];
					var leftRow1='';
					var leftRow2='';
					var rightRow1='';
					var rightRow2='';
					var count=Math.ceil(parseInt(menuChild.length)/2);
					for (var j = 0; j < count; j++) {
						leftRow1+="<li onclick='handleSlidedownMenuEvent(this,\"left\")' idata=\""+menuChild[j]['id']+"\"><img src=\""+menuChild[j]['icon']+"\">"+menuChild[j]['title']+"</li>";
					};
					leftRow1="<ul>"+leftRow1+"</ul>";
					for (var j = 3; j < menuChild.length; j++) {
						leftRow2+="<li onclick='handleSlidedownMenuEvent(this,\"left\")' idata=\""+menuChild[j]['id']+"\"><img src=\""+menuChild[j]['icon']+"\">"+menuChild[j]['title']+"</li>";
					};
					leftRow2="<ul>"+leftRow2+"</ul>";

					var menuChild=jsonData['data'][1]['children'];
					var count=Math.ceil(parseInt(menuChild.length)/2);
					for (var j = 0; j < count; j++) {
						rightRow1+="<li onclick='handleSlidedownMenuEvent(this,\"right\")'  idata=\""+menuChild[j]['id']+"\">"+menuChild[j]['title']+"</li>";
					};
					rightRow1="<ul>"+rightRow1+"</ul>";
					for (var j = 3; j < menuChild.length; j++) {
						rightRow2+="<li onclick='handleSlidedownMenuEvent(this,\"right\")'  idata=\""+menuChild[j]['id']+"\">"+menuChild[j]['title']+"</li>";
					};
					rightRow2="<ul>"+rightRow2+"</ul>";
					$('#recipe-menu-index .recipe-menu-slidedown').append(leftRow1+leftRow2);
					$('#recipe-menu-style .recipe-menu-slidedown').append(rightRow1+rightRow2);
				}else{
					displayALertForm(jsonData['msg']);
				}
			}else{
				displayALertForm('获取失败,请重试');
			}
			
		});

		var currentRecipesType=10;

		function dsiplayRecipePost(data){
			var jsonData=JSON.parse(data);
			displayNoData();
			var homeList=jsonData['data'];
			if(homeList!=null){
				var homeListHtmlDOM='';
				for (var i = 0; i < homeList.length; i++) {
					var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
					homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" style="background:url('+homeList[i]['image']+') repeat scroll center center transparent;" class="vip-video"></div><div class="vip-content"><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-title">'+homeList[i]["title"]+'</a></div><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-post">'+homeList[i]["paper"]+'</a></div><div class="vip-menu"><ul><li><span class="glyphicon glyphicon-eye-open"></span> '+homeList[i]["browse_num"]+'</li><li type="'+homeList[i]['type']+'" articleid="'+homeList[i]['id']+'" onclick="addToReadingList(this);"><span class="glyphicon glyphicon-heart-empty"></span></li><li onclick="displayShareForm();"><span class="glyphicon glyphicon-link"></span></li></ul></div><div class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
				};
				$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
			}else{
				displayNoData('再怎么找也没有啦');
			}
		}
		
		function loadRecipesList(type,page,limit,other){
			$('.loading').fadeIn();
			getRecipeList(type,page,limit,function(data){
				if(data!=''){
					if(other){
						$('section').html('');
					}
					$('.padding-div-row').remove();
					dsiplayRecipePost(data);
					$('.loading').fadeOut();
				}else{
					displayALertForm('获取失败,请重试');
				}
			});
		}

		loadRecipesList(currentRecipesType,defaultPage,defaultLimit,false);
	
		function handleSlidedownMenuEvent(obj,which){
			if(which=='left'){
				$(obj).parent().parent().parent().slideToggle();
				toggleBtnArrow('.nav-recipe-menu ul #recipe-material-index span','up');
				recipeLeftMenuIsSlided=false;
			}else if(which=='right'){
				$(obj).parent().parent().parent().slideToggle();
				toggleBtnArrow('.nav-recipe-menu ul #recipe-material-style span','up');
				recipeRightMenuIsSlided=false;
			}
			$('.loading').fadeIn();
			currentRecipesType=$(obj).attr('idata');
			recipesDefaultPage=1;
			recipeDefaultLimit=10;
			loadRecipesList(currentRecipesType,defaultPage,defaultLimit,true);
		}

		function handleRecipesPagination(){
			if(isUserAtBottom()){
				displayALertForm('加载中...');
				loadRecipesList(currentRecipesType,++defaultPage,defaultLimit,false);
			}
		}

		$(window).scroll(handleRecipesPagination);

</script>

<?php include('footer.php'); ?>
