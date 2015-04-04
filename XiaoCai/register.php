
<div class="register-page">
	

<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">注册</div>
		</div>
	</nav>
</header>

<section>
	<div class="logo-area register-area">
		<img width="180" height="80" src="images/logo.png" />
		吃大餐·做晓菜
	</div>
	
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
		<a id="btn-confirm-register" class="button button-caution button-pill">确认注册</a>
		<div class="fast-register">————— 或 —————</div>
		<div class="wechat-logo">
			<img src="images/wechat.png">
		</div>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

</div>

<script type="text/javascript">

	$(document).ready(function(){

		$('.header-back').click(function(){
			backPreviosPage('register.php');
		});

	});

</script>