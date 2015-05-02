<?php include('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title">玩转厨房</li>
			</ul>
		</div>
	</nav>
</header>


<section>
	
	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

</section>

<footer>
	
</footer>

</div>

<script type="text/javascript">
	
	displayALertForm('正在加载..');
	getSkillsList(1,10,function(data){
		if(data!=''){
			var jsonData=JSON.parse(data);
			if(jsonData['msg']=='成功'){
				var homeList=jsonData['data'];
				printReadingList(homeList,'section');
			}else{
				displayALertForm(jsonData['msg']);
			}
		}else{
			displayALertForm('获取失败,请重试');
		}
		
	});

</script>

<?php require('footer.php'); ?>