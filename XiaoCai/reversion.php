<div class="reversion-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">收到的回复</div>
		</div>
	</nav>
</header>

<section>
	
	<!--<div class="reading-list-a reversion-list-a reversion-new">
		<div class="reading-list-img reversion-list-img">
			<img src="http://www.webmaster5u.com/upfiles/file/201107/20110723234012108.jpg">
		</div>
		<div class="reading-list-all-content">
			<div class="reading-list-all-title">
				<p>菜谱炸鸡配酸奶酱菜谱炸鸡配酸配酸奶</p>
			</div>
		</div>
		<div class="reading-list-all-footer">
			<ul>
				<li><span class="glyphicon glyphicon-bookmark"></span> 食谱</li>
				<li><span class="glyphicon glyphicon-time"></span> 今天</li>
			</ul>
		</div>
	</div>-->

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

</div>

<script type="text/javascript">
	//退回按钮事件
	$('.header-back').click(function(){
		backPreviosPage('reversion.php');
	});

	displayALertForm('正在加载...');
	getReply(localStorage.tokenID,function(data){
		var jsonData=JSON.parse(data);
		var replyList=jsonData['data'];
		var replyListHTMLDom='';
		console.log(replyList);
		if(replyList!=null || replyList!='' || replyList!='null'){
			for (var i = 0; i < replyList.length; i++) {
				if(replyList[i]['status']==='1'){
					//新信息
					replyListHTMLDom+='<div class="reading-list-a reversion-list-a reversion-new"><div class="reading-list-img reversion-list-img"><img src="'+replyList[i]['article_image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title reversion-looked"><p>'+replyList[i]['article_title']+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> '+replyType[parseInt(replyList[i]['type'])-1]+'</li><li><span class="glyphicon glyphicon-time"></span> '+replyList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
				}else{
					//已读信息
					replyListHTMLDom+='<div class="reading-list-a reversion-list-a"><div class="reading-list-img reversion-list-img"><img src="'+replyList[i]['article_image']+'"></div><div class="reading-list-all-content"><div class="reading-list-all-title reversion-looked"><p>'+replyList[i]['article_title']+'</p></div></div><div class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> '+replyType[parseInt(replyList[i]['type'])-1]+'</li><li><span class="glyphicon glyphicon-time"></span> '+replyList[i]['created_time'].split(' ')[0]+'</li></ul></div></div>';
				}
			};			
		}else{
			displayALertForm('暂时没有消息喔');
		}
	});
</script>
