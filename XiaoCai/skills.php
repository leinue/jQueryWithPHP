<?php include('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title">玩转厨房</li>
			</ul>
		</div>
	</nav>
</header>


<section>
	
	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

<footer>
	
</footer>

</div>

<script type="text/javascript">
	
	getSkillsList(function(data){
		var jsonData=JSON.parse(data);
		var homeList=jsonData['data'];
		var homeListHtmlDOM='';
		for (var i = 0; i < homeList.length; i++) {
			var charCount=homeList[i]['paper'].length;
				var changeFontSizeCSS='';
				if(charCount>=20){
					changeFontSizeCSS="readling-list-title-small";
				}else{
					changeFontSizeCSS='';
			}
			homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p><a href="monograph.php?#'+homeList[i]['id']+'">'+homeList[i]['title']+'</a></p></div><div class="reading-list-all-summary"><p>'+homeList[i]['paper']+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
		};

		$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
	});

	getSkillsInfo(5,0,function(data){
		var jsonData=JSON.parse(data);
		//console.log(jsonData['data']['info']);
	});

	$('section .reading-list-a').click(function(){
		localStorage.skillsArticleID=$(this).find('.reading-list-a').attr('idata');
		console.log(localStorage.skillsArticleID);
		console.log('dssd');
	});

</script>

<?php require('footer.php'); ?>