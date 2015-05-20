
<div class="login-page">
	
	<div class="profile-display">
		<div class="profile-phtot-uploaded">
            <img width="46" id="user-comment-photo" height="46" src="images/default_photo.png" />   
        </div>
        <div class="profile-display-name">
        	<span>Carl Wong</span>
        </div>
	</div>

	<div class="logo-area">
		<img width="100%" height="16.666667%" src="images/xiaocai_logo.svg" />
	</div>

	<div class="lo-re-area">
		<a class="button button-caution button-pill">登录</a>
		<div class="fast-register">快速注册</div>
	</div>
	<div class="column-menu">
		<ul>
			<li class="left-menu-reading"><span><img width="15" height="15" src="images/reading_red.png"></span>阅读列表</li>
			<li class="left-menu-foodlist"><span><img width="15" height="15" src="images/foodlist_red.png"></span>食材采购清单</li>
			<li class="left-menu-reversion">
				<span><img width="15" height="15" src="images/response_red.png"></span>
				收到的回复
			</li>
			<li class="left-menu-setting"><span><img width="15" height="15" src="images/setting_red.png"></span>设置<div style="opacity:0;" id="response-flag"><span>·</span></div></li>
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

		$('.profile-display-name').css({
			'left':$('.profile-phtot-uploaded').width()+30,
			'top':'24px'
		});

	</script>
