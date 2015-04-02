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
</section>

<footer>
	
</footer>

</div>

<div class="login-page">
	<div class="logo-area">
		<img width="180" height="80" src="images/logo.png" />
		吃大餐·做晓菜
	</div>

	<div class="lo-re-area">
		<a href="" class="button button-caution button-pill">登录</a>
		<div class="fast-register"><a href="">快速注册</a></div>
	</div>

	<div class="column-menu">
		<ul>
			<li><span class="glyphicon glyphicon-link"></span>阅读列表</li>
			<li><span class="glyphicon glyphicon-list"></span>食材采购清单</li>
			<li class="menu-response"><span class="glyphicon glyphicon-link"></span>收到的回复<span id="response-flag">·</span></li>
			<li><span class="glyphicon glyphicon-heart"></span>设置</li>
		</ul>
	</div>
</div>

<?php require('footer.php') ?>