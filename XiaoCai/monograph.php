<?php require( 'header.php'); ?>
<header>
  <nav style="padding-bottom:0px;padding-top: 8px;padding-bottom:37px;">
    <div class="header-title">
      <div class="header-back monograph-back"><span class="glyphicon glyphicon-menu-left"></span></div>
      <div class="header-main-title monograph-header">
          <ul>
            <li class="header-skillsEvaluating-li"><img width="28" height="14" src="images/watch_white.png"></img> <span id="viewer-count">0</span></li>
            <li onclick="addToReadingList(this)" class="header-skillsEvaluating-li"><img width="16" height="16" src="images/add_white.png"></img></li>
            <li class="header-skillsEvaluating-li"></span><img width="16" height="16" id="mono-share" src="images/share_white.png"></img></li>
          </ul>
      </div>
    </div>
  </nav>
</header>

  <section>
     
     <div class="monograph-img1">
       <img src="">
     </div>

      <div class="skills-evaluating-title">
          <h4>0</h4>
          <p>0</p>
        </div>

        <div class="content-summary">
         <div class="content-summaryIn">
           内容摘要
         </div>
       </div>

        <div class="skeva-content">
              
        </div>

        <div style="margin-top:80px;" id="project-article">
          
        </div>

        <div class="skeva-xiaocai">
            <div class="skeva-xiaocai-content">
                <img width="40" height="20" src="images/logo_small.png">
            </div>
        </div>
  </section>
  <script type="text/javascript">
    $(document).ready(function(){
        $('.monograph-header ul li:last-child').click(function(){
            displayShareForm();
        });

        var articleID=getQueryString("id");
        var tag=getQueryString("type");
        var favouriteList=getFavourteList();

        if(typeof favouriteList!='undefined'){
          for (var k = 0; k < favouriteList.length; k++) {
            var collection=favouriteList[k].split('|');
            var atype=collection[0];
            var aid=collection[1];
            if(aid==articleID && atype==tag){
              $('.monograph-header ul li:nth-child(2)').css('background','rgb(187,0,37)');
              break;
            }
          };
        }

        function loadSeparateInfo(jsonData,type){
          type=(type==null) ? '1':type;
          if(jsonData['msg']=='成功'){
            if(type!='4'){
              $('.monograph-img1 img').attr('src',jsonData['data']['info']['big_image']);            
            }else{
              $('.monograph-img1 img').attr('src',jsonData['data']['info']['image']);
            }
            $('.monograph-header ul .header-skillsEvaluating-li #viewer-count').html(jsonData['data']['info']['browse_num']);
            $('.skills-evaluating-title h4').html(jsonData['data']['info']['title']);
            $('.skills-evaluating-title p').html(jsonData['data']['info']['created_time']);
            $('.content-summaryIn').html(jsonData['data']['info']['paper']);
            if(type=='4'){
              var homeListHtmlDOM="";
              var homeList=jsonData['data']['ProjectArticle'];
              for (var i = 0; i < homeList.length; i++) {
                if(homeList[i]['is_vip']!=null){
                  //带视频
                  var paperLength=homeList[i]['paper'].length;
                  if(paperLength<44){
                    teacherBrandCSS='margin-top:-140px!important;'
                  }
                  if(paperLength>=44){
                    teacherBrandCSS='margin-top:-165px!important;'
                  }else if(paperLength>=34){
                    teacherBrandCSS='margin-top:-150px!important;';
                  }
                  if(paperLength>=48 && paperLength<65){
                    teacherBrandCSS='margin-top:-170px!important;';
                  }else if(paperLength>=45){
                    teacherBrandCSS='margin-top:-190px!important;';
                  }
                  var isVipHTML=homeList[i]['is_vip']=='1' ? '<div class="teacher-brand" id="monograph-member">会员专享</div>' : '';
                  homeListHtmlDOM+='<div idata="'+homeList[i]['id']+'" class="vip-enjoy"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="vip-video"></div><div class="vip-content"><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-title">'+homeList[i]["title"]+'</a></div><div ref="introduction.php?id='+homeList[i]['id']+'" onclick="locateToIntroduction(this)" class="vip-post">'+homeList[i]["paper"]+'</a></div><div class="vip-menu"><ul><li><img width="30" height="16" style="" src="images/watch_grey.png"></img> <span>'+homeList[i]["browse_num"]+'</span></li><li type="'+homeList[i]['type']+'" articleid="'+homeList[i]['id']+'" onclick="addToReadingList(this);"><img width="18" height="18" src="images/add_grey.png"></img></li><li onclick="displayShareForm();"><img width="18" height="18" src="images/share_grey.png"></img></li></ul></div><div style="'+teacherBrandCSS+'" class="teacher-brand"><img src="'+homeList[i]['arrange_image_url']+'"></div></div>'+isVipHTML+'</div>';
                }else{
                  //不带视频
                  var papaerContent=homeList[i]['paper'];
                  var paperTitle=homeList[i]['title'];
                  var changeFontSizeCSS;
                  paperTitle=cutReadingListTitle(paperTitle);
                  changeFontSizeCSS=changeReadingListSize(papaerContent);
                  papaerContent=cutReadingListPaper(papaerContent);
                  homeListHtmlDOM+='<div ref="monograph.php?id='+homeList[i]['id']+'&type='+homeList[i]['type']+'" onclick="locateToIntroduction(this)" id="skills-'+homeList[i]['id']+'" style="height:120px;" class="reading-list-a"><div style="background:url('+homeList[i]['image']+') no-repeat scroll center center transparent;background-size:cover;" class="reading-list-img"></div><div class="reading-list-all-content"><div class="reading-list-all-title '+changeFontSizeCSS+'"><p>'+paperTitle+'</p></div><div class="reading-list-all-summary"><p>'+papaerContent+'</p></div></div><div style="margin-top:0px!important;" class="reading-list-all-footer"><ul><li><span class="glyphicon glyphicon-bookmark"></span> 玩转厨房</li><li><span class="glyphicon glyphicon-time"></span> '+formatDate(homeList[i]['created_time'].split(' ')[0])+'</li></ul></div></div>';
                }
              };
              $('#project-article').append(homeListHtmlDOM+'<div class="padding-div-row"></div>');
              $('.skeva-xiaocai').attr('style','margin-top:10px;');
            }else{
              $('.skeva-content').html(jsonData['data']['info']['content']);              
            }
            $('.skeva-content p').css('background','rgb(226,224,227)');
            var btnAdd=$('.monograph-header ul li:nth-child(2)');
            btnAdd.attr('articleid',jsonData['data']['info']['id']);
            btnAdd.attr('type',tag);
          }else{
              displayALertForm(jsonData['msg']);
          }
        }

        displayALertForm('正在加载...');
        if(isQueryValid([articleID,tag])){
          displayALertForm('验证成功');
          if(tag=='2'){
            getSkillsInfo(articleID,0,1,10,function(data){
              var jsonData=JSON.parse(data);
              loadSeparateInfo(jsonData);
            });
          }else if(tag=='3'){
            getHomeInfo(articleID,0,1,10,function(data){
              var jsonData=JSON.parse(data);
              loadSeparateInfo(jsonData);
            });
          }else if(tag=='4'){
            getProjectInfo(articleID,0,1,10,function(data){
              var jsonData=JSON.parse(data);
              loadSeparateInfo(jsonData,'4');
            });
          }
        }else{
          window.location.href="skills.php";
        }

      $('section').css('marginTop',$('header').height());
      $('.main-footer').hide();
    });
  </script>

  <?php require('footer.php'); ?>

  <script>
    $('section').css('margin-top',$('header').height()-10);
  </script>