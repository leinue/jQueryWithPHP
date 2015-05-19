
<div class="login-page">
	<div class="logo-area">
		<img width="180" height="80" src="images/xiaocai_logo.svg" />
	</div>

	<div class="lo-re-area">
		<a class="button button-caution button-pill">登录</a>
		<div class="fast-register">快速注册</div>
	</div>
	<div class="column-menu">
		<ul>
			<li class="left-menu-reading"><span class="glyphicon glyphicon-list-alt"></span>阅读列表</li>
			<li class="left-menu-foodlist"><span class="glyphicon glyphicon-align-justify"></span>食材采购清单</li>
			<li class="left-menu-reversion">
				<span class="glyphicon glyphicon-envelope"></span>
				收到的回复
			</li>
			<li class="left-menu-setting"><span class="glyphicon glyphicon-cog"></span>设置<div style="opacity:0;" id="response-flag"><span>·</span></div></li>
		</ul>
	</div>
	<div class="stem-shadow">
	</div>
</div>

<div class="login-page-navigate"></div>

	<script type="text/javascript">

		var replyTotalCount;
		var replyDefaultCount=10;
		var replyHasReadCount=0;
		var jsonReplyList;

		function getReplyListData(){
			getReply(localStorage.tokenID,function(data){
				if(data!=''){
					var jsonData=JSON.parse(data);
					var replyList=jsonData['data'];
					jsonReplyList=replyList;
					loadReversionList(replyList);
				}else{
					displayALertForm('获取新消息失败,请重试');
				}
			});
		}

		function loadReversionList(replyList){
			var replyListHTMLDom='';
			replyTotalCount=replyList.length;
			var count;
			if(replyList!=null || replyList!='' || replyList!='null'){
				var reversionStatus;
				var reversionTips;
				if(replyTotalCount-replyHasReadCount<10){
					count=replyTotalCount;
				}else{
					count=replyDefaultCount+replyHasReadCount;
				}
				for (var i = replyHasReadCount; i < count; i++) {
					if(replyList[i]['status']==='1'){
						$('#response-flag').css('opacity','1');
					}else{
						$('#response-flag').css('opacity','0');	
					}
					replyHasReadCount++;
				};	
			}
		}

		getReplyListData();

		$('.login-page-navigate').click(function(){
			$('.nav-menu').click();
		});

	</script>
