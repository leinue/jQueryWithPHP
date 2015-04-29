<?php require('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title">晓菜</li>
				<li class="search-form"><input type="search" placeholder="食谱 食材 工具 话题" /></li>
			</ul>
		</div>
	</nav>
</header>


<section>
	<div class="banner">
		<ul>
			<li id="slide-1" style="background-image: url('images/first.jpg');"></li>

			<li id="slide-2" style="background-image: url('images/second.jpg');"></li>

			<li id="slide-3" style="background-image: url('images/third.jpg');"></li>

			<li id="slide-4" style="background-image: url('images/forth.jpg');"></li>
		</ul>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

</div>

<script type="text/javascript">
	$(document).ready(function(){

		displayALertForm('正在加载...');
		getHome(1,10,function(data){
			var jsonData=JSON.parse(data);
			if(jsonData['msg']=='成功'){
				var homeList=jsonData['data']['list'];
				var homeListHtmlDOM="";
				for (var i = 0; i < homeList.length; i++) {
					if(homeList[i]['is_vip']!=null){
						//带视频
						var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
						homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-video"><img class="vip-video-img" src="'+homeList[i]['image']+'" alt="'+homeList[i]['title']+'"></img></div><div class="vip-content"><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-title">'+homeList[i]["title"]+'</a></div><div ref="introduction.php#'+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-post">'+homeList[i]["paper"]+'</a></div><div class="vip-menu"><ul><li><span class="glyphicon glyphicon-eye-open"></span> '+homeList[i]["browse_num"]+'</li><li type="'+homeList[i]['type']+'" articleid="'+homeList[i]['id']+'" onclick="addToReadingList(this);"><span class="glyphicon glyphicon-heart-empty"></span></li><li onclick="displayShareForm();"><span class="glyphicon glyphicon-link"></span></li></ul></div><div class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
					}else{
						//不带视频
						var charCount=homeList[i]['paper'].length;
						var changeFontSizeCSS='';
						if(charCount>=20){
							changeFontSizeCSS="readling-list-title-small";
						}else{
							changeFontSizeCSS='';
						}
						var homeArticleType=homeList[i]['type'];
						homeListHtmlDOM+='<div ref="monograph.php#'+homeList[i]['id']+'#type'+homeArticleType+'" onclick="locateToIntroduction(this)" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+homeList[i]['title']+'</p></div><div class="reading-list-all-summary"><p>'+homeList[i]['paper']+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> '+postType[parseInt(homeList[i]['type'])-1]+'</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
					}
					//
				};
				$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
			}else{
				displayALertForm(jsonData['msg']);
			}
		});

		$('.banner ul li').click(function(){
			var typeID=$(this).attr('id');
			typeID=typeID.split('-')[1];
			window.location.href = 'monograph.php#'+typeID;
		});

		$('.search-form').keyup(function(event){
			if(event.which == 13){
				var searchContent=$('.search-form input').val();
				if(searchContent!=''){
					localStorage.searchKeywords=searchContent;
					window.location.href = 'search.php';
				}
			}
		});

	});
	
</script>

<?php require('footer.php'); ?>