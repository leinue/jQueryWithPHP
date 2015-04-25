<?php include('header.php');?>

<div class="reading-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title search-form search-page"><input type="search" placeholder="食谱 食材 工具 话题" /></div>
		</div>
		<div class="header-reading-menu">
			<ul>
				<li id="reading-list-all"><span class="header-reading-menu-active">全部文章</span></li>
				<li id="reading-list-receip"><span>一手好菜</span></li>
				<li id="reading-list-skills"><span>玩转厨房</span></li>
				<li id="reading-list-review"><span>专题文章</span></li>
			</ul>
		</div>
	</nav>
</header>

<section>
	
	<div class="reading-all-list">
		
	</div>
	
</section>

<div class="loading"><div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div></div>

</div>

<script type="text/javascript">
	$('.search-form').keyup(function(event){
		if(event.which == 13){
			var searchContent=$('.search-form input').val();
			if(searchContent!=''){
				search_(searchContent,function(data){
					if(data!=''){
						var jsonData=JSON.parse(data);
						console.log(jsonData['data']);
					}else{
						displayALertForm('搜索失败,请重试');
					}
				});
			}else{
				displayALertForm('搜索内容不能为空,请重新输入');
			}
		}
	});
</script>

<?php include('footer.php');?>

<script>
	$('.main-footer').hide();
</script>