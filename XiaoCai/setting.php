<div class="reversion-page">
	
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
			<li id="setting-list-logout" class="setting-list-third">注销</li>
			<li id="setting-list-setting">关于<span class="glyphicon glyphicon-menu-right"></span></li>
		</ul>
	</div>
</section>

</div>

<script type="text/javascript">
	//退回按钮事件
	$('.header-back').click(function(){
		backPreviosPage('setting.php');
	});
</script>
