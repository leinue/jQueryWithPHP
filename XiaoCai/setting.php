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
			<li id="setting-list-password">修改密码<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-fpassword" class="setting-list-second">找回密码<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-profile" class="setting-list-second">填写资料<span class="glyphicon glyphicon-menu-right"></span></li>
			<li id="setting-list-logout" class="setting-list-third">注销</li>
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
				break;
			case 'setting':
				break;
			default:
				break;
		}
	});
</script>
