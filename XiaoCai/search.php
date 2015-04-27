<?php include('header.php');?>

<div class="reading-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title search-form search-page"><input type="search" placeholder="食谱 食材 工具 话题" /></div>
		</div>
		<div class="header-reading-menu">
			<ul id="search-menu">
				<li id="reading-list-All"><span class="header-reading-menu-active">全部</span></li>
				<li id="reading-list-Home"><span>首页</span></li>
				<li id="reading-list-Recipe"><span>一手好菜</span></li>
				<li id="reading-list-Skills"><span>玩转厨房</span></li>
				<li id="reading-list-Project"><span>专题</span></li>
			</ul>
		</div>
	</nav>
</header>

<section>
	
	<div class="reading-all-list">
		
	</div>
	
</section>

<div class="loading"><div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div></div>

</div>

<script type="text/javascript">

	var oData;
	var currentType='All';
	var hasSearched;

	if(localStorage.searchKeywords!='' || $('.search-form input').val()!=''){
		hasSearched=true;
		$('.search-form input').val(localStorage.searchKeywords);
		search_(localStorage.searchKeywords,function(data){
			displayALertForm('数据查询中,请稍候',4000);
			oData=data;
			laodSearchResult(currentType);
		});
		localStorage.searchKeywords='';
	}else{
		hasSearched=false;
	}
	
	function toggleMenu(obj){
		//获得当前活跃菜单项的index
		var liIndex=$('.header-reading-menu-active').index();
		//取消当前活跃菜单项的活跃
		$('.header-reading-menu-active').removeClass('header-reading-menu-active');	
	}
	
	var searchPostType={'1':'introduction.php','2':'monograph.php','3':'首页','4':'专题'};

	//type有5种类型:All,Recipe,Skills,Home,Project
	function laodSearchResult(fucktype,ooData){
		ooData=(typeof oData!='undefined' ? ooData : oData);
		var jsonData=JSON.parse(oData);
		displayALertForm(jsonData['msg']);
		if(jsonData['msg']=='成功'){
			var listNum=jsonData['data'][fucktype]['count'];
			if(listNum!==0){
				var homeList=jsonData['data'][fucktype]['list'];
				var homeListHtmlDOM='';
				$('.reading-all-list').html('');
				for (var i = 0; i < homeList.length; i++) {
					var charCount=homeList[i]['paper'].length;
					var changeFontSizeCSS='';
					if(charCount>=20){
						changeFontSizeCSS="readling-list-title-small";
					}else{
						changeFontSizeCSS='';
					}
					homeListHtmlDOM+='<div id="skills-'+homeList[i]['id']+'" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p><a href="'+searchPostType[homeList[i]['type']]+'#'+homeList[i]['id']+'#type1">'+homeList[i]['title']+'</a></p></div><div class="reading-list-all-summary"><p><a href="'+searchPostType[homeList[i]['type']]+'#'+homeList[i]['id']+'#type1">'+homeList[i]['paper']+'</a></p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
				};
				$('.reading-all-list').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
			}else{
				displayNoData('再怎么找都没有啦');
			}
		}
	}

	function startSearching(otype){
		displayNoData();
		$('reading-all-list').html('');
		var searchContent=$('.search-form input').val();
		if(searchContent!=''){
			displayALertForm('数据查询中,请稍候',4000);
			if(!hasSearched){
				search_(searchContent,function(data){
					if(data!=''){
						//默认加载全部
						oData=data;
						laodSearchResult(otype);
					}else{
						displayALertForm('搜索失败,请重试');
					}
				});
			}else{
				laodSearchResult(otype);
			}
		}else{
			displayALertForm('搜索内容不能为空,请重新输入');
		}
	}

	$('.search-form').keyup(function(event){
		if(event.which == 13){
			$('.reading-all-list').html('');
			startSearching(currentType);
			hasSearched=true;
		}else{
			hasSearched=false;
		}
	});

	//头部菜单点击事件
	$('.header-reading-menu ul li span').click(function(){
		var typeClicked=$(this).parent().attr("id").split('-');
		var _this=$(this);
		//显示正在加载
		$('.loading').fadeIn();
		//loadReadingList(readingType[typeClicked[2]],function(){});
		var searchType=typeClicked[2];
		$('.reading-all-list').html('');
		startSearching(searchType);
		hasSearched=true;
		currentType=searchType;
		//去掉正在加载
		$('.loading').fadeOut();
		//修改现行活动菜单
		toggleMenu(this);
		_this.addClass('header-reading-menu-active');
	});

</script>

<?php include('footer.php');?>

<script>
	$('.main-footer').hide();
</script>