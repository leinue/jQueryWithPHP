<?php require( 'header.php'); ?>

<script type="text/javascript">

</script>
  <header>
    <nav>
      <div class="header-title">
        <div class="header-back">
          <span class="glyphicon glyphicon-menu-left">
          </span>
        </div>
        <div class="header-main-title">
          食谱
        </div>
      </div>
    </nav>
  </header>
<div class="introduction-page">
  <section>
    <div class="vip-enjoy vip-enjoy-padding">
      <div class="vip-video">
        <video src="movie.ogg" controls="controls">
          您的浏览器不支持 video 标签。
        </video>
        <!--<img src="">-->
      </div>
      <div class="vip-content">
        <div class="vip-title">
          标题标题标题
        </div>
        <div class="vip-post">
          内容标题内容标题内容标题内容标题内容标题内容标题内容标题内容标题
        </div>
        <div class="vip-content-time">
          <ul id="introduction-time-list1" class="introduction-time">
            <li>备料和预处理</li>
            <li>料理时长</li>
            <li>享用份量</li>
          </ul>
          <ul id="introduction-time-list2" class="introduction-time">
            <li id="prepare-time">0分钟</li>
            <li id="cooking-time">0分钟</li>
            <li id="enjoy-num">0人份</li>
          </ul>
        </div>
        <div class="vip-menu">
          <ul>
            <li><span class="glyphicon glyphicon-eye-open"></span> <span id="browser-num">0</span></li>
            <li>
              <span class="glyphicon glyphicon-heart-empty">
              </span>
            </li>
            <li>
              <span class="glyphicon glyphicon-link">
              </span>
            </li>
          </ul>
        </div>
        <div class="teacher-brand introduction-teacher-brand"><img src=""></div>
      </div>
    </div>
    <div class="introduction-comment">
      <ul class="introduction-comment-ul">
        <li class="introduction-comment-photo">
          <div class="logo-area register-area  profile-upload-photo">
            <div class="profile-phtot-uploaded introduction-photo-uploaded">
              <img width="40" height="40" src="images/default_photo.png" />
            </div>
          </div>
        </li>
        <li class="introduction-comment-input">
          <input type="text">
        </li>
      </ul>
      <ul id="comment-show-area" class="introduction-comment-ul">
        <li class="introduction-comment-photo">
          <div class="logo-area register-area  profile-upload-photo">
            <div class="profile-phtot-uploaded introduction-photo-uploaded">
              <img width="40" height="40" src="images/default_photo.png" />
            </div>
          </div>
        </li>
        <div class="introduction-comment-show">
          <div class="introduction-comment-showComment">
            <ul class="introduction-comment-show-ul">
              <li>
                <h3>
                  嗡嗡Carl
                </h3>
              </li>
              <li>
                2015-4-7
              </li>
            </ul>
            <div class="introduction-comment-showComment-p">
              <p>
                显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示评论显示
              </p>
            </div>
          </div>
          <div class="introduction-comment-showXiaocai">
            <ul>
              <li>
                <h3>
                  晓菜
                </h3>
              </li>
              <li>
                2015-3-28
              </li>
            </ul>
            <div class="offical-comments">
              <p>
                内容文字内容文字内容文字内容文字内容文字内容
              </p>
            </div>
          </div>
        </div>
      </ul>
    </div>
    </section>
    </div>
    <footer>
    <div id="recipes-introduction-footer">
      <ul id="recipes-introduction-footer-ul">
        <li><span id="introductionFooterLi1">介绍</span></li>
        <li><span id="introductionFooterLi2">配方</span></li>
        <li><span id="introductionFooterLi3">步骤</span></li>
      </ul>
    </div>
    </footer>
  <script type="text/javascript">
    $(document).ready(function() {

      displayALertForm('正在加载...',1000);
      var currentHref=document.location.href;
      if(currentHref.indexOf('#')!=-1){
        currentHref=currentHref.split('#')[1];
        getRecipeInfo(currentHref,0,function(data){
          var jsonData=JSON.parse(data);
          if(jsonData['msg']!='成功'){
            displayALertForm(jsonData['msg']);
          }else{
            var introList=jsonData['data'];
            if(introList['info']!=''){
              var introInfo=introList['info'];
              console.log(introInfo);
              $('.vip-title').html(introInfo['title']);
              $('.vip-post').html(introInfo['paper']);
              $('.introduction-time #prepare-time').html(introInfo['prepare_time']);
              $('.introduction-time #cooking-time').html(introInfo['cooking_time']);
              $('.introduction-time #enjoy-num').html(introInfo['enjoy_num']);
              $('.vip-menu ul li #browser-num').html(introInfo['browse_num']);
              $('.introduction-teacher-brand img').attr('src',introInfo['arrange_image_url']);
            }
            if(introList['comments']!=''){

            }else{
              $('#comment-show-area').hide();
            }
          }
        });
      }else{
        window.location.href="recipes.php";
      }

      var tag = true;
      var flag = false;
      var index = false;
      $('#introductionFooterLi1').addClass('borderActive');
      $('#introductionFooterLi1').click(function() {
        if (!tag) {
          $(this).addClass('borderActive');
          if (flag) {
            $('#introductionFooterLi2').removeClass('borderActive');
            flag = false;
          }
          if (index) {
            $('#introductionFooterLi3').removeClass('borderActive');
            index = false;
          }
          tag = true;
        }
      });
      $('#introductionFooterLi2').click(function() {
        if (!flag) {
          $(this).addClass('borderActive');
          if (tag) {
            $('#introductionFooterLi1').removeClass('borderActive');
            tag = false;
          }
          if (index) {
            $('#introductionFooterLi3').removeClass('borderActive');
            index = false;
          }

          flag = true;
        }
      });
      $('#introductionFooterLi3').click(function() {
        if (!index) {
          $(this).addClass('borderActive');
          if (flag) {
            $('#introductionFooterLi2').removeClass('borderActive');
            flag = false;
          }
          if (tag) {
            $('#introductionFooterLi1').removeClass('borderActive');
            tag = false;
          }
          index = true;
        }
      });
    });

    $('.header-back').click(function() {
      //backPreviosPage('introduction.php');
      history.go(-1);
    });

      $('#recipes-introduction-footer ul #introductionFooterLi1').click(function(){
      loadPagesA('introduction.php','body');
    });

    $('#recipes-introduction-footer ul #introductionFooterLi2').click(function(){
      loadPagesA('pages/introduction/formula.php','.introduction-page');
    });

    $('#recipes-introduction-footer ul #introductionFooterLi3').click(function(){
      loadPagesA('pages/introduction/step.php','.introduction-page');
    });



  </script>

<?php require('footer.php'); ?>

<script>
  $('.main-footer').html('');
</script>