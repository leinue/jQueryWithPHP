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
	
	displayALertForm('正在加载..');
	getSkillsList(1,10,function(data){
		var jsonData=JSON.parse(data);
		if(jsonData['msg']=='成功'){
			var homeList=jsonData['data'];
			var homeListHtmlDOM='';
			for (var i = 0; i < homeList.length; i++) {
				var papaerContent=homeList[i]['paper'];
				var paperTitle=homeList[i]['title'];
				var charCount=papaerContent.length;
				var titleCount=paperTitle.length;
					var changeFontSizeCSS='';
					if(charCount>=20){
						changeFontSizeCSS="readling-list-title-small";
						papaerContent=papaerContent.substring(0,20)+'……';
					}else{changeFontSizeCSS='';}
					if(titleCount>=20){
						paperTitle=paperTitle.substring(0,20)+'……';
					}
				homeListHtmlDOM+='<div ref="monograph.php#'+homeList[i]['id']+'#type2" onclick="locateToIntroduction(this)" id="skills-'+homeList[i]['id']+'" class="reading-list-a"><div class="reading-list-img"><img src="'+homeList[i]['image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+paperTitle+'</p></div><div class="reading-list-all-summary"><p>'+papaerContent+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+homeList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
			};
			$('section').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
		}else{
			displayALertForm(jsonData['msg']);
		}
	});

</script>

<?php require('footer.php'); ?>