
	<div class="formula-buy">
		<ul>
			<!-- <li class="formula-li1"><span>食材用量</span></li> -->
			<li class="formula-li2">
        <button style="font-style:italic;background:rgb(229,0,45)" class= "button-add">加入购买清单</button>
      </li>
			<!-- <li><span><img style="width:16px!important;" height="16" src="images/slide_to_top.png"></span></li> -->
    </ul>
    <div class="formula-buy-icon" style="background:url(images/foodlist_white.png) no-repeat scroll center center transparent;background-size:cover;" ></div>

	</div>

	<section></section>

<script type="text/javascript">

        $('.formula-buy-icon').css('left',$(document).width()/2-$('button-add').width()-56);

        /*$('.formula-buy ul li:last-child').click(function(){
        	$('.formula-juice').slideToggle(300);
        	if($(this).find('span').find('img').attr('src')=='images/slide_to_top.png'){
        		$(this).find('span').find('img').attr('src','images/slide_to_bottom.png');
        	}else{
        		$(this).find('span').find('img').attr('src','images/slide_to_top.png');
        	}
          $('.recipes-introduction-footer').toggleClass('fixed-pos');
        });*/
      
      	displayALertForm('正在加载...',2000);

        var formulaidList=new Array();

      	var recipeID=getQueryString('id');
      	if(isQueryValid(recipeID)){
      		getRecipeInfoFormula(recipeID,function(data){
            if(data!=''){
              sessionStorage.formulaIDList='';
              var jsonData=JSON.parse(data);
              if(jsonData['msg']!='成功'){
                displayALertForm(jsonData['msg'],2000);
              }else{
                var formulaList=jsonData['data'];
                var formulaHTMLDOM='';
                for (var i = 0; i < formulaList.length; i++) {
                  formulaChild=formulaList[i]['children'];
                  formulaHTMLDOM+='';
                  for (var j = 0; j < formulaChild.length; j++) {
                    formulaHTMLDOM+='<ul><li class="juice-list-li1"><span recipeid="'+recipeID+'" formulaid="'+formulaChild[j]['id']+'" onclick="addToShoppingList(this)" class="glyphicon glyphicon-plus"></span></li><li class="juice-list-li3">'+formulaChild[j]['title']+'</li><li class="juice-list-li3">'+formulaChild[j]['dosage']+'</li><li class="juice-list-li3">'+formulaChild[j]['note']+'</li></ul>';
                  }
                  sessionStorage.formulaIDList+=formulaList[i]['id']+'|';
                  formulaHTMLDOM='<div id="formula-child-'+formulaList[i]['id']+'" class="formula-juice"><div class="formula-juice-title"><div class="juice-title"><span>'+formulaList[i]['title']+'</span></div></div><div class="formula-juice-list">'+formulaHTMLDOM+'</div></div>';
                  $('.introduction-page').append(formulaHTMLDOM);
                  formulaHTMLDOM='';
                };
              }
            }else{
              displayALertForm('获取失败,请重试');
            }
      		});
      	}else{
      		window.location.href="recipes.php";
      	}

        if(typeof sessionStorage.formulaIDList !='undefined'){
          var formulaIDList=sessionStorage.formulaIDList.split('|');
          formulaIDList=formulaIDList.slice(0,formulaIDList.length-1);
        }
        
        $('.formula-buy ul li .button-add,.formula-buy-icon').click(function(){
          if(formulaIDList!=''){
            formulaIDList.forEach(function(formulaID){
              addFoodList(recipeID,formulaID,localStorage.tokenID,function(data){
                if(data!=''){
                  var jsonData=JSON.parse(data);
                  displayALertForm(jsonData['msg'],2000);
                }else{
                  displayALertForm('加入失败,请重试');
                }
              });
            });
          }else{
            displayALertForm('没有数据可添加');
          }
        });

</script>