<div class="passwordc-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">找回密码</div>
		</div>
	</nav>
</header>

<section>
	<div class="setting-list change-password-input">
		<ul>
			<li id="setting-list-phone-num-input">
				<input placeholder="手机号" />
				<a class="button button-caution button-pill button-small send-ver-code">发送验证码</a></li>
			<li id="setting-list-password-o-input"><input placeholder="原密码" /></li>
			<li id="setting-list-password-new-input" class="setting-list-second"><input placeholder="新密码" /></li>
			<li id="setting-list-password-confrom-input"><input placeholder="确认新密码" /></li>
		</ul>
	</div>
	<div class="change-password-submit-button">
		<a class="button button-caution button-pill">找回密码</a>
		<div class="fast-register">微信登录用户无法在此找回密码</div>
	</div>
	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

</div>


<script type="text/javascript">
	$(document).ready(function(){
		//退回按钮事件
		$('.header-back').click(function(){
			backPreviosPage('setting.php');
		});
	});
</script>