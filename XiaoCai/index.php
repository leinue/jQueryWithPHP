<?php require('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title">晓菜</li>
				<li class="search-form">
					<input type="search" placeholder="食谱 食材 工具 话题" />
					<div class="search-input-icon"><span class="glyphicon glyphicon-search"></span></div>
				</li>
			</ul>
		</div>
	</nav>
</header>


<section>
	<div class="banner">
		<ul>
			<li id="slide-1" style="background-image: url('images/first.jpg');"></li>

			<li id="slide-2" style="background-image: url('images/second.jpg');"></li>

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

		isIndex=true;

		function loadHomeArticle(jsonData){
			if(jsonData!=defaultPage){
				var homeList=jsonData['data']['list'];
				if(homeList!=''){
					var homeListHtmlDOM="";
					for (var i = 0; i < homeList.length; i++) {
						if(homeList[i]['is_vip']!=null){
							//带视频
							var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
							homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="vip-video"></div><div class="vip-content"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-title">'+homeList[i]["title"]+'</a></div><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-post">'+homeList[i]["paper"]+'</a></div><div class="vip-menu"><ul><li><span class="glyphicon glyphicon-eye-open"></span> '+homeList[i]["browse_num"]+'</li><li type="'+homeList[i]['type']+'" articleid="'+homeList[i]['id']+'" onclick="addToReadingList(this);"><span class="glyphicon glyphicon-heart-empty"></span></li><li onclick="displayShareForm();"><span class="glyphicon glyphicon-link"></span></li></ul></div><div class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
						}else{
							//不带视频
							var papaerContent=homeList[i]['paper'];
							var paperTitle=homeList[i]['title'];
							var changeFontSizeCSS;
							paperTitle=cutReadingListTitle(paperTitle);
							changeFontSizeCSS=changeReadingListSize(papaerContent);
							papaerContent=cutReadingListPaper(papaerContent);
							homeListHtmlDOM+='<div ref="monograph.php?id='+homeList[i]['id']+'&type='+homeList[i]['type']+'" onclick="locateToIntroduction(this)" id="skills-'+homeList[i]['id']+'" class="reading-list-a"><div style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="reading-list-img"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+paperTitle+'</p></div><div class="reading-list-all-summary"><p>'+papaerContent+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+formatDate(homeList[i]['created_time'].split(' ')[0])+'</li></ul></div></div>';
						}
					};
					$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
				}else{
					displayALertForm('没有数据了');
				}
			}else{
					displayALertForm('没有数据了');
			}
		}

		function loadHomeSlide(jsonData){
			jsonData.forEach(function(slide){
				var slideHTMLDOM='<li id="slide-'+slide['id']+'" style="background-image: url('+slide['image']+');"></li>';
				$('.banner ul').append(slideHTMLDOM);
			});
		}

		displayALertForm('正在加载...');

		function loadHomeList(page,limit,slide){
			getHome(page,limit,function(data){
				if(data!=''){
					var jsonData=JSON.parse(data);
					if(jsonData['msg']=='成功'){
						if(slide){
							loadHomeSlide(jsonData['data']['slide']);
						}
						$('.padding-div-row').remove();
						loadHomeArticle(jsonData);
					}else{
						displayALertForm(jsonData['msg']);
					}
				}else{
					displayALertForm('获取失败,请重试');
				}
			});
		}

		loadHomeList(defaultPage,defaultLimit,true);
		
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

		function handleHomePagination(){
			if(isUserAtBottom() && isIndex){
				displayALertForm('加载中...');
				loadHomeArticle(++defaultPage,defaultLimit,false);
			}	
		}

		$(window).scroll(handleHomePagination);
	});
	
</script>

<?php require('footer.php'); ?>