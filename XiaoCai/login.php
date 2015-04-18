
<div class="login-main-page">
	

<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">登录</div>
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
			<li id="login-phone-num-input">
				<input type="tel" max="11" placeholder="手机号" />
			<li id="login-password-o-input"><input type="password" placeholder="密码" /></li>
		</ul>
	</div>

	<div class="change-password-submit-button">
		<a id="btn-confirm-login" class="button button-caution button-pill">登录</a>
		<div class="fast-register true-register">
			<span id="login-fast-register">快速注册</span>
			<span id="login-find-pw">找回密码</span>
		</div>
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

		function signInfoIsNull(){
			var flag=0;
			$('.change-password-input ul li').each(function(){
				if($(this).find('input').val()==null){
					flag+=1;
				}
			});
			return flag===0;
		}

		$('#btn-confirm-login').click(function(){
			if(signInfoIsNull()){
				var smobile=$('.change-password-input ul #login-phone-num-input input').val();
				var password=$('.change-password-input ul #login-password-o-input input').val();
				signInByMobile(smobile,password);
			}
		});

	});

</script>