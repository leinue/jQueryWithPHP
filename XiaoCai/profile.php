<?php require('header.php'); ?>

<div class="login-main-page">
	
<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">填写资料</div>
		</div>
	</nav>
</header>

<section>
	<div class="logo-area register-area profile-upload-photo">
		<div class="profile-phtot-uploaded" id="localImag">
			<img width="95" id="user-profile-photo" height="95" src="images/default_photo.png" />		
		</div>
		<span>上传头像</span>
	</div>
	
	<div class="setting-list change-password-input">
		<ul>
			<li id="wechat-nickname"><input placeholder="微信昵称" /></li>
		</ul>
	</div>

	<div class="change-password-submit-button">
		<a id="profile-confirm" class="button button-caution button-pill">确定</a>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
	
	<!-- <input type="file" accept="image/*" onchange="printImg(this)" style="display: none" id="fileInput" /> -->
</section>

</div>

		<iframe name="uploadfrm" id="uploadfrm" style="display: none;"></iframe>  
        <form name="formHead" method="post" action="" id="formHead" enctype="multipart/form-data" target="uploadfrm">  
      
            <div>  
                <div>  
                    <input type="file" name="file_head" id="file_head" style="display: none;" onchange="javascript:setImagePreview();" />  
                </div>  
                <div>  
                    <div id="DivUp" style="display: none">  
                        <input type="submit" data-inline="true" id="BtnUp" value="确认上传" data-mini="true" />
                    </div>  
                </div>  
            </div>
        </form>
                
        <script type="text/javascript">  
            function setImagePreview() {  
                var preview, img_txt, localImag, file_head = document.getElementById("file_head"),  
                picture = file_head.value;  
                if (!picture.match(/.jpg|.gif|.png|.bmp/i)) return alert("您上传的图片格式不正确，请重新选择！"),  
                !1;  
                if (preview = document.getElementById("user-profile-photo"), file_head.files && file_head.files[0]) preview.style.display = "block",  
                    preview.style.width = "95px",  
                    preview.style.height = "95px",  
                    preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);  
                else {  
                    file_head.select(),  
                    file_head.blur(),  
                    img_txt = document.selection.createRange().text,  
                    localImag = document.getElementById("localImag"),  
                    localImag.style.width = "95px",  
                    localImag.style.height = "95px";  
                    try {  
                        localImag.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)",  
                        localImag.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = img_txt  
                    } catch(f) {  
                        return alert("您上传的图片格式不正确，请重新选择！"),  
                        !1  
                    }  
                    preview.style.display = "none",  
                    document.selection.empty()  
                }  
                return document.getElementById("DivUp").style.display = "none",  
                !0  
            }  
        </script>  

<script type="text/javascript">

	$(document).ready(function(){

		var fileInput=document.getElementById("file_head");

		$('.header-back').click(function(){
			history.go(-1);
		});

		$('.profile-phtot-uploaded img').attr('src',localStorage.headimgurl);
		$('.change-password-input #wechat-nickname input').attr('value',localStorage.nickname);

		$('#profile-confirm').click(function(){
			if(inputInfoIsNull('.change-password-input ul li') && fileInput.value!=''){
				displayALertForm('正在为您处理,请稍候...');
				var tokenID=localStorage.tokenID;
				var headimgURL=$('#user-profile-photo').attr('src');
				var nickname=$('.change-password-input ul #wechat-nickname input').val();
				changeUserData(tokenID,nickname,headimgURL,function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['msg']);
					}else{
						displayALertForm('获取失败,请重试');
					}
				});
			}else{
				displayALertForm('请完整填写信息');
			}
		});

		$('.profile-upload-photo').click(function(){
			fileInput.click();
		});

		$('section').css('marginTop',$('header').height()+50);

		$('footer').hide();

	});

	function getFileUrl(sourceId) {
		var url;
		if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
			url = document.getElementById(sourceId).value;
		} else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox
			url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
		} else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome
			url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
		}
		return url;
	}

	function preImg(sourceId, targetId) {document.getElementById(targetId).src=getFileUrl(sourceId);}

	function printImg(obj){preImg('fileInput','user-profile-photo');}

</script>

<?php require('footer.php'); ?>