<?php require('header.php'); ?>

<div class="passwordc-page">
	
<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
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
				<input style="padding-top: 4px !important;padding-bottom: 4px !important;" id="find-pw-phone" placeholder="手机号" />
				<button id="findpw-send-vercode" class="button button-caution button-pill button-small send-ver-code">发送验证码</button></li>
			<li id="setting-list-password-o-input"><input type="password" placeholder="输入密码" /></li>
			<li id="setting-list-password-new-input" class="setting-list-second"><input type="password" placeholder="确认密码" /></li>
			<li id="setting-list-password-confrom-input"><input placeholder="手机验证码" /></li>
		</ul>
	</div>
	<div class="change-password-submit-button">
		<a id="btn-find-pw" class="button button-caution button-pill">找回密码</a>
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

		$('#findpw-send-vercode').click(function(){
			var sMobile=$('.change-password-input ul li #find-pw-phone').val();
			if(checkMobile(sMobile)){
				displayALertForm('正在为您处理,请稍候...');
				sendSms(sMobile,2,function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['msg']);
					}else{
						displayALertForm('获取失败,请重试');
					}
				});
			}else{
				displayALertForm("手机号非法");
			}
		});

		$('#btn-find-pw').click(function(){
			if(!inputInfoIsNull('.change-password-input ul li')){
				displayALertForm('请完整填写信息');
			}else{
				var originPW=$('.change-password-input ul #setting-list-password-o-input input').val();
				var confirmPW=$('.change-password-input ul #setting-list-password-new-input input').val();
				var verCode=$('.change-password-input ul #setting-list-password-confrom-input input').val();
				changePassword(localStorage.mobileNum,originPW,confirmPW,verCode,function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['msg']);
					}else{
						displayALertForm('获取失败,请重试');
					}
				});
			}
		});
	});
</script>

<?php require('footer.php'); ?>
<script>
    $('.main-footer').hide();
</script>