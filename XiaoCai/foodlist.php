<?php require('header.php'); ?>

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="header-back"><span class="glyphicon glyphicon-menu-left"></span></li>
				<li class="foodlist-menu">购物清单</li>
				<li class="delete-all">清空</li>
			</ul>
		</div>
	</nav>
</header>

<section style="padding-top:1px">
	<div class="setting-list food-list">
		<ul mainmenucontainer>
			<li>
				<div mainmenu class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li childmenu><div>白羊葱<span>1汤勺</span></div></li>
						<li childmenu><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
					</ul>
				</div>
			</li>
			<li>
				<div mainmenu class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li childmenu><div>白羊葱<span>1汤勺</span></div></li>
						<li childmenu><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
					</ul>
				</div>
			</li>
			<li>
				<div mainmenu class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li childmenu><div>白羊葱<span>1汤勺</span></div></li>
						<li childmenu><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

<script type="text/javascript">

	getFoodList(localStorage.tokenID,function(data){
		if(!data){
			displayALertForm('读取出错,请重试');
		}else{
			var jsondata=JSON.parse(data);
			if(!jsondata['msg']=='成功'){
				displayALertForm(jsondata['msg'])
			}else{
				displayALertForm('读取成功,正在加载...');
				var foodList=jsondata['data'];
				if(foodList==''){
					foodList.forEach(function(e){
						var recipeID=e['recipe_id'];
						var recipeTitle=e['recipe_title'];
						var recipeChildren=e['children'];
						var mainMenuDOM='<div mainmenu onclick="toggleRecipeMenu(this)" recipeID="'+recipeID+'" class="food-list-title"><a href="javascript:void(0)">'+recipeTitle+'</a><span class="glyphicon glyphicon-menu-right"></span><span recipeid="'+recipeID+'" onclick="removeFormula(this)" class="glyphicon glyphicon-remove"></span></div>';
						var childMenuDom;
						recipeChildren.forEach(function(child){
							var childID=child['recipe_id'];
							var formulaID=child['formula_id'];
							var childTitle=child['title'];
							var dosage=child['dosage'];
							var status=child['status'];
							childMenuDom+='<li childata='+childID+' formulaID='+formulaID+' status='+status+' childmenu="true"><div>'+childTitle+'<span>'+dosage+'</span></div></li>';
							if(childMenuDom.substring(0,9)=="undefined"){
								childMenuDom=childMenuDom.substring(9,childMenuDom.length);
							}	
						});
						childMenuDom='<div class="setting-list food-list-detail"><ul>'+childMenuDom+'</ul></div>';
						mainMenuDOM='<li recipeid="'+recipeID+'">'+mainMenuDOM+childMenuDom+'</li>';
						$('.food-list ul[mainmenucontainer]').append(mainMenuDOM);
						mainMenuDOM='';
					});
				}else{
					dsiplayNoData('再怎么找也没有啦');
				}
			}
		}
	});

	function toggleRecipeMenu(obj){
		var this_=$(obj);
		this_.next().slideToggle();
		this_.find('a').toggleClass('food-list-active');
		this_.find('span:last-child').toggle();
		var fthspan=this_.find('span:nth-child(2)');
		if(fthspan.attr('class')=='glyphicon glyphicon-menu-down'){
			fthspan.attr('class','glyphicon glyphicon-menu-right');
		}else{
			fthspan.attr('class','glyphicon glyphicon-menu-down');		
		}
	}

	function removeFormula(obj){
		displayALertForm('正在为您删除...');
		var this_=$(obj);
		var recipeid=this_.attr('recipeid');
		deleteFoodList(recipeid,0,localStorage.tokenID,function(data){
			if(data!=''){
				var jsondata=JSON.parse(data);
				if(jsondata['msg']='删除成功'){
					displayALertForm(jsondata['msg']);
					var thisParent=this_.parent().parent();
					if(thisParent.attr('recipeid')==recipeid){
						thisParent.fadeOut();
					}
				}else{
					displayALertForm(jsondata['msg']);
				}
			}else{
				displayALertForm('删除失败,请重试');
			}
		});
	}

	$('.food-list ul li div[mainmenu]').on('click',function(){
		var this_=$(this);
		this_.next().slideToggle();
		this_.find('a').toggleClass('food-list-active');
		this_.find('span:last-child').toggle();
		var fthspan=this_.find('span:nth-child(2)');
		if(fthspan.attr('class')=='glyphicon glyphicon-menu-down'){
			fthspan.attr('class','glyphicon glyphicon-menu-right');
		}else{
			fthspan.attr('class','glyphicon glyphicon-menu-down');		
		}
	});

	$('.food-list-detail ul li[childmenu]').click(function(){

	});
</script>

<?php require('footer.php'); ?>

<script>
	$('.main-footer').hide();
</script>