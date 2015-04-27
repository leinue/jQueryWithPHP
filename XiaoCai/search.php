<?php include('header.php');?>

<div class="reading-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title search-form search-page"><input type="search" placeholder="食谱 食材 工具 话题" /></div>
		</div>
		<div class="header-reading-menu">
			<ul>
				<li id="reading-list-all"><span class="header-reading-menu-active">全部</span></li>
				<li id="reading-list-home"><span>首页</span></li>
				<li id="reading-list-receip"><span>一手好菜</span></li>
				<li id="reading-list-skills"><span>玩转厨房</span></li>
				<li id="reading-list-review"><span>专题</span></li>
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
	var searchPostType={'1':'introduction.php','2':'monograph.php','3':'首页','4':'专题'};

	//type有5种类型:All,Recipe,Skills,Home,Project
	function laodSearchResult(data,type){
		var jsonData=JSON.parse(data);
		console.log(jsonData['data']);
		var homeList=jsonData['data'][type]['list'];
		var listNum=jsonData['data'][type]['count'];
		var homeListHtmlDOM='';
		$('.reading-all-list').html('');
		for (var i = 0; i < homeList.length; i++) {
			console.log(homeList[i]['type']);
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
	}

	$('.search-form').keyup(function(event){
		if(event.which == 13){
			var searchContent=$('.search-form input').val();
			if(searchContent!=''){
				displayALertForm('数据查询中,请稍候',4000);
				search_(searchContent,function(data){
					if(data!=''){
						//默认加载全部
						laodSearchResult(data,'All');
					}else{
						displayALertForm('搜索失败,请重试');
					}
				});
			}else{
				displayALertForm('搜索内容不能为空,请重新输入');
			}
		}
	});
</script>

<?php include('footer.php');?>

<script>
	$('.main-footer').hide();
</script>