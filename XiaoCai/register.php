<?php require('header.php'); ?>

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
				<input id="reg-mobile" type="tel" max="11" placeholder="手机号" />
				<a style="color:#FFF" class="button button-caution button-pill button-small send-ver-code">发送验证码</a>
			</li>
			<li id="setting-list-password-o-input"><input type="password" placeholder="登录密码" /></li>
			<li id="setting-list-password-new-input" class="setting-list-second"><input type="password" placeholder="确认密码" /></li>
			<li id="setting-list-password-confrom-input"><input placeholder="手机验证码" /></li>
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
			history.back(-1);
		});

		$('.send-ver-code').click(function(){
			var sMobile=$('.change-password-input ul li #reg-mobile').val();
			if(checkMobile(sMobile)){
				displayALertForm('请求传送中,请稍等...');
				sendSms(sMobile,1,function(data){
					var jsonData=JSON.parse(data);
					displayALertForm(jsonData['msg']);
					if(jsonData['msg']=='注册成功'){
						displayALertForm('注册成功,2秒后将自动跳转...',2000);
						setTimeout(function(){
							window.location.href="login.php";
						},3000);
					}
				});
			}else{
				displayALertForm("手机号非法");
			}
		});

		$('#btn-confirm-register').click(function(){
			if(inputInfoIsNull('.change-password-input ul li')){
				var smobile=$('.change-password-input ul li #reg-mobile').val();
				var password=$('.change-password-input ul #setting-list-password-o-input input').val();
				var repassword=$('.change-password-input ul #setting-list-password-new-input input').val();
				var code=$('.change-password-input ul #setting-list-password-confrom-input input').val();
				regByMobile(smobile,password,repassword,code,function(data){
					var jsonData=JSON.parse(data);
					displayALertForm(jsonData['msg']);
				});
			}else{
				displayALertForm('请完整填写信息');
			}
		});

		$('section').css('marginTop',$('header').height()+50);

		$('.wechat-logo').click(function(){
			displayALertForm('正在为您跳转到微信登录...');
			wechat_redirectDIRECT_URI=window.location.href;
			var WECHAT_GET_CODE="https://open.weixin.qq.com/connect/qrconnect?appid="+WECHAT_APPID+"&redirect_uri="+WECHAT_REDIRECT_URI+"&response_type=code&scope="+WECHAT_SCOPE+"&state="+WECHAT_STATE+"#wechat_redirect";
			window.location.href=WECHAT_GET_CODE;
		});

	});

</script>

<? require('footer.php'); ?>

<script>
$('footer').hide();
</script>