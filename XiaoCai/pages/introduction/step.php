
<div class="step-page">

</div>

	<script>

		$('.formula-juice').each(function(e){
			$(this).remove();
		});
		function loadSteps(data){
			var stepsHTMLDOM;
			var stepsImgHTMLDOM;
			data.forEach(function(e){
				var ichild=1;
				var stepsChild=e['children'];
				var stepsContent=e['content'];
				stepsHTMLDOM+='<ul><li></li><li stepid="'+e['id']+'" id="red1">'+stepsContent+'</li></ul>';
				stepsChild.forEach(function(child){
					if(child['type']=='1'){
						//文字
						stepsHTMLDOM+='<ul type='+child['type']+' id="'+child['id']+'"><li>'+ichild+'</li><li>'+child['content']+'<span class="glyphicon glyphicon-triangle-top"></span></li></ul>';
					}else if(child['type']=='2'){
						//图片
						stepsImgHTMLDOM+='<li><img src="'+child['content']+'"></li>'
					}
					ichild+=1;
				});
				if(stepsImgHTMLDOM.substring(0,9)=='undefined' || stepsHTMLDOM.substring(0,9)=='undefined'){
					stepsImgHTMLDOM=stepsImgHTMLDOM.substring(9,stepsImgHTMLDOM.length);
					stepsHTMLDOM=stepsHTMLDOM.substring(9,stepsHTMLDOM.length);
				}
				stepsImgHTMLDOM='<div class="tomato-sauce-img"><ul>'+stepsImgHTMLDOM+'</ul></div>';
				stepsHTMLDOM='<div class="tomato-sauce">'+stepsHTMLDOM+'</div>'+stepsImgHTMLDOM;
				$('.step-page').append(stepsHTMLDOM);
				stepsHTMLDOM='';
				stepsImgHTMLDOM='';
			});

			$('.step-page').append('<div class="step-main-tips"><div class="step-tips"><h3>Tips</h3><ul><li>内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要</li><li>内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要</li><li>内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要内容摘要</li></ul></div></div>');
		}

		function loadTips(data){

		}

		function loadRecommended(data){

		}

		displayALertForm('正在加载...',500);
		var currentHref=document.location.href;
      	if(currentHref.indexOf('#')!=-1){
      		currentHref=currentHref.split('#')[1];
      		getRecipeInfoSteps(currentHref,function(data){
      			var jsonData=JSON.parse(data);
      			if(jsonData['msg']!='成功'){
      				displayALertForm(jsonData['msg']);
      			}else{
      				var recipeSteps=jsonData['data']['steps'];
      				var recipeTips=jsonData['data']['tips'];
      				var recipeRecommended=jsonData['data']['recommended'];
      				if(recipeSteps!=''){
      					loadSteps(recipeSteps);
      				}else if(recipeTips!=''){
      					loadTips(recipeTips);
      				}else if(recipeRecommended!=''){
      					loadRecommended(recipeRecommended);
      				}else{
      					displayNoData('再怎么找也没有啦');
      				}
      			}
      		});
      	}else{
      		window.location.href="recipes.php";
      	}

	</script>