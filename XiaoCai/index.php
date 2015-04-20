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
			<li style="background-image: url('images/first.jpg');"></li>

			<li style="background-image: url('images/second.jpg');"></li>

			<li style="background-image: url('images/third.jpg');"></li>

			<li style="background-image: url('images/forth.jpg');"></li>
		</ul>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

</div>

<script type="text/javascript">

	getHome(function(data){
		var jsonData=JSON.parse(data);
		var homeList=jsonData['data']['list'];
		var homeListHtmlDOM="";
		for (var i = 0; i < homeList.length; i++) {
			if(homeList[i]['is_vip']!=null){
				//带视频
				var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
				homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div class="vip-video"><video src="movie.ogg" controls="controls">您的浏览器不支持 video 标签。</video></div><div class="vip-content"><div class="vip-title">'+homeList[i]["title"]+'</div><div class="vip-post">'+homeList[i]["paper"]+'</div><div class="vip-menu"><ul><li><span class="glyphicon glyphicon-eye-open"></span> '+homeList[i]["browse_num"]+'</li><li><span class="glyphicon glyphicon-heart-empty"></span></li><li><span class="glyphicon glyphicon-link"></span></li></ul></div><div class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
			}else{
				//不带视频
				var charCount=homeList[i]['paper'].length;
				var changeFontSizeCSS='';
				if(charCount>=20){
					changeFontSizeCSS="readling-list-title-small";
				}else{
					changeFontSizeCSS='';
				}
				homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p><a href="">'+homeList[i]['title']+'</a></p></div><div class="reading-list-all-summary"><p>'+homeList[i]['paper']+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> '+postType[parseInt(homeList[i]['type'])-1]+'</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
			}
			//
		};
		$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
	});

</script>

<?php require('footer.php'); ?>