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
			<li id="setting-list-password" class="login-show"><a href="javascript:void(0)">修改密码</a><span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-fpassword" class="setting-list-second login-show"><a href="javascript:void(0)">找回密码</a><span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-profile" class="setting-list-second login-show"><a href="javascript:void(0)">填写资料</a><span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-logout" class="setting-list-third login-show"><a href="javascript:void(0)">注销</a></li>
			<li id="setting-list-setting"><a href="javascript:void(0)">关于</a><span class="glyphicon glyphicon-menu-right"></span></li>
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
		isIndex=false;
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
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['msg']);
						if(jsonData['msg']=='注销成功' || jsonData['msg']=='请重新登陆' || jsonData['msg']=='该账号不存在,请重新登陆'){
							localStorage.uid='';
							localStorage.nickname='';
							localStorage.tokenID='';
							localStorage.headimgurl='';
							localStorage.isReply='';
							localStorage.isLogin=false;
							displayALertForm('注销成功,2秒后将自动跳转...');
							setTimeout(function(){
								location.reload();
							},2000);
						}
					}else{
						displayALertForm('获取失败,请重试');
					}
					
				});
				break;
			case 'setting':
				getAbout(function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['data']);
					}else{
						displayALertForm('获取失败,请重试');
					}
				});
				break;
			default:
				break;
		}

	});

	$('section').css('marginTop',$('header').height()+12);
</script>
