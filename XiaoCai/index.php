<?php require('header.php'); ?>

<div class="main-page">

<header>
	<nav>
		<div class="nav-content">
			<ul>
				<li class="nav-menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></li>
				<li class="main-title">晓菜</li>
				<li class="search-form"><input type="search" placeholder="食谱 食材 工具 话题" /></li>
			</ul>
		</div>
	</nav>
</header>


<section>
	<div class="banner">
		<ul>
			<li style="background-image: url('images/first.jpg');"></li>

			<li style="background-image: url('images/second.jpg');"></li>

			<li style="background-image: url('images/third.jpg');"></li>

			<li style="background-image: url('images/forth.jpg');"></li>
		</ul>
	</div>

	<div class="vip-enjoy">
		<div class="vip-video">
			<video src="movie.ogg" controls="controls">
				您的浏览器不支持 video 标签。
			</video>
			<!--<img src="">-->
		</div>
		<div class="vip-content">
			<div class="vip-title">会员专享标题</div>
			<div class="vip-post">内容标题内容标题内容标题内容标题内容标题内容标题内容标题内容标题</div>
			<div class="vip-menu">
				<ul>
					<li><span class="glyphicon glyphicon-eye-open"></span> 268</li>
					<li><span class="glyphicon glyphicon-heart-empty"></span></li>
					<li><span class="glyphicon glyphicon-link"></span></li>
				</ul>
			</div>
			<div class="teacher-brand">
				ALVIN LEE
			</div>
		</div>
	</div>
	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

<footer>
	
</footer>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		/*幻灯片开始*/

		if(window.chrome) {$('.banner li').css('background-size', '100% 100%');}

		$(function() {$('.banner').unslider();});

		$('.banner').unslider({
			arrows: true,	
			fluid: true,
			dots: true,
			keys:true
		});

		/*幻灯片结束*/
	});

</script>

<?php require('footer.php'); ?>