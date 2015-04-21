<div class="setting-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">设置</div>
		</div>
	</nav>
</header>

<section>
	<div class="setting-list">
		<ul>
			<li id="setting-list-password" class="login-show">修改密码<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-fpassword" class="setting-list-second login-show">找回密码<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-profile" class="setting-list-second login-show">填写资料<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-logout" class="setting-list-third login-show">注销</li>
			<li id="setting-list-setting">关于<span class="glyphicon glyphicon-menu-right"></span></li>
		</ul>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

</div>

<script type="text/javascript">
	//退回按钮事件
	$('.header-back').click(function(){
		backPreviosPage('setting.php');
	});

	if(localStorage.isLogin=='true'){
		$('.setting-list ul .login-show').show();
	}else{
		$('.setting-list ul .login-show').hide();
	}

	$('.setting-list ul li').click(function(){
		var elemID=$(this).attr('id').split('-');
		switch(elemID[2]){
			case 'password':
				loadPagesA('pages/setting/password_change.php','body');
				break;
			case 'fpassword':
				loadPagesA('pages/setting/password_find.php','body');
				break;
			case 'profile':
				loadPagesA('profile.php','body');
				break;
			case 'logout':
				var tokenID=localStorage.tokenID;
				logOut(tokenID,function(data){
					var jsonData=JSON.parse(data);
					console.log(tokenID);
					displayALertForm(jsonData['msg']);
					if(jsonData['msg']=='注销成功'){
						localStorage.uid='';
						localStorage.nickname='';
						localStorage.tokenID='';
						localStorage.headimgurl='';
						localStorage.isReply='';
						localStorage.isLogin=false;
						displayALertForm('注销成功,3秒后将自动跳转...');
						setTimeout(function(){
							location.reload();
						},3000);
					}
				});
				break;
			case 'setting':
				getAbout(function(data){
					var jsonData=JSON.parse(data);
					displayALertForm(jsonData['data']);
				});
				break;
			default:
				break;
		}
	});
</script>
