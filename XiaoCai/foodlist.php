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
		<ul>
			<li>
				<div class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li><div>白羊葱<span>1汤勺</span></div></li>
						<li><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
					</ul>
				</div>
			</li>
			<li>
				<div class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li><div>白羊葱<span>1汤勺</span></div></li>
						<li><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
					</ul>
				</div>
			</li>
			<li>
				<div class="food-list-title">
					<a href="javascript:void(0)">香酥炸鸡配手工酸奶酱</a>
					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="glyphicon glyphicon-remove"></span>
				</div>
				<div class="setting-list food-list-detail">
					<ul>
						<li><div>白羊葱<span>1汤勺</span></div></li>
						<li><div class="food-list-detail-name">蒜泥<span>1/2茶勺</span></div></li>
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
	$('.food-list-title:not(span)').click(function(){
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
</script>

<?php require('footer.php'); ?>

<script>
	$('.main-footer').hide();
</script>