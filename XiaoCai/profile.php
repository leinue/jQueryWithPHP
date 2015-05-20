<?php require('header.php'); ?>
<?php error_reporting(E_ALL & ~E_NOTICE); ?>

<script type="text/javascript" src="extension/ajaxfileupload.js"></script>

<div class="login-main-page">
	
<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">填写资料</div>
		</div>
	</nav>
</header>

<section style="margin-top: -84px!important;">
	<div style="margin-top: 20.274%;" class="logo-area_ register-area profile-upload-photo">
		<div class="profile-phtot-uploaded" style="padding-top:8px;padding-left:6px;" id="localImag">
		    <?php  
  
			//上传文件类型列表  
			$uptypes=array(  
			    'image/jpg',  
			    'image/jpeg',  
			    'image/png',  
			    'image/pjpeg',  
			    'image/gif',  
			    'image/bmp',  
			    'image/x-png'  
			);  
			  
			$max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
			$destination_folder="uploadimg/"; //上传文件路径  
			$watermark=0;      //是否附加水印(1为加水印,其他为不加水印);  
			$watertype=1;      //水印类型(1为文字,2为图片)  
			$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
			$waterstring="http://www.xiaocai101.com/";  //水印字符串  
			$waterimg="xplore.gif";    //水印图片  
			$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);  
			$imgpreviewsize=1/2;    //缩略图比例  
			?>
			  
			<?php  
			if ($_SERVER['REQUEST_METHOD'] == 'POST')  
			{  
			    if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
			    //是否存在文件  
			    {  
			         echo "<script>displayALertForm('图片不存在')</script>";  
			         exit;  
			    }  
			  
			    $file = $_FILES["upfile"];  
			    if($max_file_size < $file["size"])  
			    //检查文件大小  
			    {  
			        echo "<script>displayALertForm('文件太大')</script>";  
			        exit;  
			    }  
			  
			    if(!in_array($file["type"], $uptypes))  
			    //检查文件类型  
			    {  
			        echo "<script>displayALertForm('文件类型不对".$file["type"]."')</script>";  
			        exit;  
			    }  
			  
			    if(!file_exists($destination_folder))  
			    {  
			        mkdir($destination_folder);  
			    }  
			  
			    $filename=$file["tmp_name"];  
			    $image_size = getimagesize($filename);  
			    $pinfo=pathinfo($file["name"]);  
			    $ftype=$pinfo['extension'];  
			    $destination = $destination_folder.time().".".$ftype;
			  
			    if(!move_uploaded_file ($filename, $destination))  
			    {  
			        echo "<script>displayALertForm('移动文件出错')</script>";  
			        exit;  
			    }  
			  
			    $pinfo=pathinfo($destination);  
			    $fname=$pinfo[basename];

			    echo "<script>displayALertForm('上传成功')</script>";

			    if($watermark==1)  
			    {  
			        $iinfo=getimagesize($destination,$iinfo);  
			        $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
			        $white=imagecolorallocate($nimage,255,255,255);  
			        $black=imagecolorallocate($nimage,0,0,0);  
			        $red=imagecolorallocate($nimage,255,0,0);  
			        imagefill($nimage,0,0,$white);  
			        switch ($iinfo[2])  
			        {  
			            case 1:  
			            $simage =imagecreatefromgif($destination);  
			            break;  
			            case 2:  
			            $simage =imagecreatefromjpeg($destination);  
			            break;  
			            case 3:  
			            $simage =imagecreatefrompng($destination);  
			            break;  
			            case 6:  
			            $simage =imagecreatefromwbmp($destination);  
			            break;  
			            default:  
			            die("不支持的文件类型");  
			            exit;  
			        }  
			  
			        imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
			        imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
			  
			        switch($watertype)  
			        {  
			            case 1:   //加水印字符串  
			            imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
			            break;  
			            case 2:   //加水印图片  
			            $simage1 =imagecreatefromgif("xplore.gif");  
			            imagecopy($nimage,$simage1,0,0,0,0,85,15);  
			            imagedestroy($simage1);  
			            break;  
			        }  
			  
			        switch ($iinfo[2])  
			        {  
			            case 1:  
			            //imagegif($nimage, $destination);  
			            imagejpeg($nimage, $destination);  
			            break;  
			            case 2:  
			            imagejpeg($nimage, $destination);  
			            break;  
			            case 3:  
			            imagepng($nimage, $destination);  
			            break;  
			            case 6:  
			            imagewbmp($nimage, $destination);  
			            //imagejpeg($nimage, $destination);  
			            break;  
			        }  
			  
			        //覆盖原上传文件  
			        imagedestroy($nimage);  
			        imagedestroy($simage);  
			    }  
			  
			    if($imgpreview==1){  
			    	$root=explode('profile.php', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
			    	$root='http://'.$root[0];
				    // echo "<img width=\"95\" id=\"user-profile-photo\" height=\"95\" src=\"".$root."$destination\" \/>";
				    echo "<div style=\"width:95px!important;height:95px!important;background:url(".$root.$destination.") no-repeat scroll 50% 50% transparent;background-size:cover;\"></div>"; 
			    }
			}

			?>		
		</div>
		<span>上传头像</span>
	</div>

	<form style="display:none;" enctype="multipart/form-data" method="post" name="upform">  
		<input name="upfile" id="file_head" style="display:none" onchange="javascript:setImagePreview();" type="file">  
		<input type="submit" id="upload_btn" style="display:none" value="上传"><br> 
	</form>  
	
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
	
</section>

</div>

<script type="text/javascript">

	function setImagePreview(){
		var submitUploadBtn=document.getElementById('upload_btn');
		submitUploadBtn.click();
	}

	$(document).ready(function(){

		var fileInput=document.getElementById("file_head");

		$('.header-back').click(function(){
			history.go(-1);
		});

		//$('.profile-phtot-uploaded img').attr('src',localStorage.headimgurl);
		$('.change-password-input #wechat-nickname input').attr('value',localStorage.nickname);

		$('#profile-confirm').click(function(){
			if(inputInfoIsNull('.change-password-input ul li')){
				displayALertForm('正在为您处理,请稍候...');
				var tokenID=localStorage.tokenID;
				var headimgURL=$('#user-profile-photo').attr('src');
				alert(headimgURL);
				var nickname=$('.change-password-input ul #wechat-nickname input').val();
				changeUserData(tokenID,nickname,headimgURL,function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						displayALertForm(jsonData['msg']);
						if(jsonData['error']=='1'){
							localStorage.nickname=nickname;
							localStorage.headimgURL=jsonData['data']['headimgurl'];
						}
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

		$('footer').hide();

	});

</script>

<?php require('footer.php'); ?>

<script type="text/javascript">
	$('.profile-upload-photo').css('margin-top','40.274%!important');
</script>
