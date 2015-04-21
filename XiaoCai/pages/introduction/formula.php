  <header>
	<div class="formula-buy">
		<ul>
			<li class="formula-li1"><span>食材用量</span></li>
			<li class="formula-li2"><button class= "button-add">加入采购清单</button></li>
			<li><span class="glyphicon glyphicon-menu-up"></span></li>
	</div>	
	    <div id="formula-add">
	    	加入成功
	    </div>
	</header>
	<section></section>

<script type="text/javascript">
	$(document).ready(function(){
        $('#formula-buy-img').click(function(){
            $('#formula-add').css('display','block');
            $('#formula-add').css({           
                 }).show(300).delay(2000).hide(300);  
        }); 
      
      	displayALertForm('正在加载...');
      	var currentHref=document.location.href;
      	if(currentHref.indexOf('#')!=-1){
      		currentHref=currentHref.split('#')[1];
      		getRecipeInfoFormula(currentHref,function(data){
      			var jsonData=JSON.parse(data);
      			if(jsonData['msg']!='成功'){
      				displayALertForm(jsonData['msg']);
      			}else{
      				var formulaList=jsonData['data'];
      				var formulaHTMLDOM='';
      				for (var i = 0; i < formulaList.length; i++) {
      					formulaChild=formulaList[i]['children'];
      					formulaHTMLDOM+='';
      					for (var j = 0; j < formulaChild.length; j++) {
      						//console.log(formulaChild[j]);
      						formulaHTMLDOM+='<ul><li class="juice-list-li1"><span class="glyphicon glyphicon-plus-sign"></span></li><li class="juice-list-li3">'+formulaChild[j]['title']+'</li><li class="juice-list-li3">'+formulaChild[j]['dosage']+'</li><li class="juice-list-li3">'+formulaChild[j]['note']+'</li></ul>';
      					};
      					formulaHTMLDOM='<div class="formula-juice"><div class="formula-juice-title"><div class="juice-title"><span>'+formulaList[i]['title']+'</span></div></div><div class="formula-juice-list">'+formulaHTMLDOM+'</div></div>';
      					$('section').append(formulaHTMLDOM);
      					formulaHTMLDOM='';
      				};
      			}
      		});
      	}else{
      		window.location.href="recipes.php";
      	}
    });

</script>