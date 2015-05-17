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
	<div id="slide-banner" class="banner">
		<ul>
			<?php	
				require('curl/base.php');
				$url="http://114.215.189.210/api.php/Api/Recipe/home";
				$post_data=array();
				$oupput=curlPost($url,$post_data);
				$op_json=json_decode($oupput);
				$slideData=$op_json->data->slide;
				if($slideData!=null){
					foreach ($slideData as $key => $value) {
						print_r("<li id=\"slide-".$value->id."\" title=".$value->title." style=\"background-image: url(".$value->image.");\"></li>");
					}
				}else{
					echo "<li id=\"slide-1\" style=\"background-image: url('images/first.jpg');\"></li>
					<li id=\"slide-2\" style=\"background-image: url('images/second.jpg');\"></li>
					<li id=\"slide-4\" style=\"background-image: url('images/forth.jpg');\"></li>
					<li id=\"slide-5\" style=\"background-image: url(http://7xid1a.com2.z0.glb.qiniucdn.com/Project/85dda3251a58dc48fd82ab9697e293df.png?imageView2/2/w/750);\"></li>";
				}
			?>
			<li id="slide-1" style="background-image: url('images/first.jpg');"></li>
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
							var paperLength=homeList[i]['paper'].length;
							if(paperLength<44){
								teacherBrandCSS='margin-top:-140px!important;'
							}
							if(paperLength>=44){
								teacherBrandCSS='margin-top:-165px!important;'
							}else if(paperLength>=34){
								teacherBrandCSS='margin-top:-150px!important;';
							}
							if(paperLength>=48 && paperLength<65){
								teacherBrandCSS='margin-top:-170px!important;';
							}else if(paperLength>=45){
								teacherBrandCSS='margin-top:-190px!important;';
							}
							var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
							homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="vip-video"></div><div class="vip-content"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-title">'+homeList[i]["title"]+'</a></div><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-post">'+homeList[i]["paper"]+'</a></div><div class="vip-menu"><ul><li><span class="glyphicon glyphicon-eye-open"></span> '+homeList[i]["browse_num"]+'</li><li type="'+homeList[i]['type']+'" articleid="'+homeList[i]['id']+'" onclick="addToReadingList(this);"><span class="glyphicon glyphicon-heart-empty"></span></li><li onclick="displayShareForm();"><span class="glyphicon glyphicon-link"></span></li></ul></div><div style="'+teacherBrandCSS+'" class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
						}else{
							//不带视频
							var papaerContent=homeList[i]['paper'];
							var paperTitle=homeList[i]['title'];
							var changeFontSizeCSS;
							paperTitle=cutReadingListTitle(paperTitle);
							changeFontSizeCSS=changeReadingListSize(papaerContent);
							papaerContent=cutReadingListPaper(papaerContent);
							homeListHtmlDOM+='<div style="height:'+0.27083333*$(document).height()+'px!important;" ref="monograph.php?id='+homeList[i]['id']+'&type='+homeList[i]['type']+'" onclick="locateToIntroduction(this)" id="skills-'+homeList[i]['id']+'" class="reading-list-a"><div style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="reading-list-img"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+paperTitle+'</p></div><div class="reading-list-all-summary"><p>'+papaerContent+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+formatDate(homeList[i]['created_time'].split(' ')[0])+'</li></ul></div></div>';
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

		displayALertForm('正在加载...');

		function loadHomeList(page,limit,slide){
			getHome(page,limit,function(data){
				if(data!=''){
					var jsonData=JSON.parse(data);
					if(jsonData['msg']=='成功'){
						if(slide){}
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
			window.location.href = 'monograph.php?id='+typeID+"&type=4";
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

		var startX, startY, endX, endY;
		var slidey = $('.banner').unslider(),
    	slideyData = slidey.data('unslider');
    	
        document.getElementById("slide-banner").addEventListener("touchstart", touchStart, false);
        document.getElementById("slide-banner").addEventListener("touchmove", touchMove, false);
        document.getElementById("slide-banner").addEventListener("touchend", touchEnd, false);
        
        function touchStart(event) {
        	setNoTouchMove();
            var touch = event.touches[0];
            startY = touch.pageY;
            startX = touch.pageX;
        }
        
        function touchMove(event) {
            var touch = event.touches[0];
            endX = touch.pageX;
            if(!isSlided){
            	if ((startX - endX) > 100) {
	               	slideyData.prev();
	            }else{
	            	slideyData.next();
	            }
            }
        }

        function touchEnd(event) {
        	setTouchMove();
        }

		$(window).scroll(handleHomePagination);
	});
	
</script>

<?php require('footer.php'); ?>