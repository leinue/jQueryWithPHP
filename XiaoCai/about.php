<?php include('header.php');?>

<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">关于</div>
		</div>
	</nav>
</header>
<section style="padding:20px;padding-top:10px;">
	
</section>

<script type="text/javascript">
	$(document).ready(function(){
		getAbout(function(data){
			if(data!=''){
				var jsonData=JSON.parse(data);
				$('section').append(jsonData['data']);
			}else{
				displayALertForm('获取失败,请重试');
			}
		});

		$('footer').hide();
	});

</script>

<?php include('footer.php'); ?>