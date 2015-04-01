	<link rel="stylesheet" href="extension/bootstrap.min.css" />
	<script type="text/javascript" src="extension/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="extension/bootstrap.min.js"></script>
	<script type="text/javascript" src="extension/unslider.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
		
		$(function() {
    		$('.banner').unslider();
		});

		if(window.chrome) {
			$('.banner li').css('background-size', '100% 100%');
		}

		$('.banner').unslider({
			arrows: true,	
			fluid: true,
			dots: true
		});
	</script>
</body>
</html>
