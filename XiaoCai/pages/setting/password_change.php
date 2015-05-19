<div class="passwordc-page">
	
<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">修改密码</div>
		</div>
	</nav>
</header>

<section>
	<div class="setting-list change-password-input password-change-page">
		<ul>
			<li  style="" id="setting-list-password-o-input"><input type="password" placeholder="原密码" /></li>
			<li id="setting-list-password-new-input" class="setting-list-second"><input type="password" placeholder="新密码" /></li>
			<li id="setting-list-password-confrom-input"><input placeholder="确认新密码" type="password" /></li>
		</ul>
	</div>
	<div class="change-password-submit-button">
		<a class="button button-caution button-pill" id="confirm-to-change-pw">确认修改</a>
		<div class="fast-register">微信登录用户无法在此修改密码</div>
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

		$('#confirm-to-change-pw').click(function(){
			if(!inputInfoIsNull('.change-password-input ul li')){
				displayALertForm('请完整填写信息');
			}else{
				displayALertForm('正在为您处理,请稍候...');
				var originPW=$('.change-password-input ul #setting-list-password-o-input input').val();
				var newPW=$('.change-password-input ul #setting-list-password-new-input input').val();
				var confirmPW=$('.change-password-input ul #setting-list-password-confrom-input input').val();
				changePassword(localStorage.tokenID,newPW,confirmPW,originPW,function(data){
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