<div class="reading-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">阅读列表</div>
		</div>
		<div class="header-reading-menu">
			<ul>
				<li id="reading-list-all"><span class="header-reading-menu-active">首页文章</span></li>
				<li id="reading-list-receip"><span>一手好菜</span></li>
				<li id="reading-list-skills"><span>玩转厨房</span></li>
				<li id="reading-list-review"><span>专题文章</span></li>
			</ul>
		</div>
	</nav>
</header>

<section>
	
	<div class="reading-all-list">
		
	</div>
	
</section>

<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){

		function toggleMenu(obj){
			//获得当前活跃菜单项的index
			var liIndex=$('.header-reading-menu-active').index();
			//取消当前活跃菜单项的活跃
			$('.header-reading-menu-active').removeClass('header-reading-menu-active');	
		}

		var readingTypeNum={1:'recipe',2:'skills',3:'all',4:'review'};
		var reaingTypeURL={1:'introduction.php',2:'monograph.php'};

		function loadReadingList(type,callback){
			displayNoData();
			getReadingList(type,localStorage.tokenID,function(data){
				if(data!=''){
					var jsonData=JSON.parse(data);
					if(jsonData['msg']=='成功'){
						var homeList=jsonData['data'];
						if(homeList!=null){
							var homeListHtmlDOM='';
							for (var i = 0; i < homeList.length; i++) {
								var papaerContent=homeList[i]['paper'];
								var paperTitle=homeList[i]['title'];
								var changeFontSizeCSS;
								paperTitle=cutReadingListTitle(paperTitle);
								changeFontSizeCSS=changeReadingListSize(papaerContent);
								papaerContent=cutReadingListPaper(papaerContent);
								homeListHtmlDOM+='<div ref="'+reaingTypeURL[homeList[i]['type']]+'#'+homeList[i]['article_id']+'#type2" onclick="locateToIntroduction(this)" type="'+homeList[i]['type']+'" articleid="'+homeList[i]['article_id']+'" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+paperTitle+'</p></div><div class="reading-list-all-summary"><p>'+papaerContent+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
							};
							$('.reading-all-list').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
						}else{
							displayALertForm("暂无数据");
							displayNoData('再怎么找都没有啦');
						}
					}else{
						displayALertForm(jsonData['msg']);
					}
				}else{
					displayALertForm('加载失败');
				}
				callback;
			});
		}

		var readingType={'receip':'1','skills':'2','all':'3','review':'4'};

		$('.loading').fadeIn();
		loadReadingList(readingType['all'],function(){
			$('.loading').fadeOut();
		});

		//头部菜单点击事件
		$('.header-reading-menu ul li span').click(function(){
			var typeClicked=$(this).parent().attr("id").split('-');
			$('.reading-all-list').html('');
			var _this=$(this);
			//显示正在加载
			$('.loading').fadeIn();
			//console.log(typeClicked);
			loadReadingList(readingType[typeClicked[2]],function(){});
			//去掉正在加载
			$('.loading').fadeOut();
			//修改现行活动菜单
			toggleMenu(this);
			_this.addClass('header-reading-menu-active');
		});

		//退回按钮事件
		$('.header-back').click(function(){
			backPreviosPage('reading.php');
		});

		$('section').css('marginTop',$('header').height()+10);
	});
</script>

