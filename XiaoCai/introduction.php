<?php require( 'header.php'); ?>

  <header>
    <nav style="padding-top: 8px;padding-bottom:30px;">
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

<section class="introduction-main-section">
<div style="margin-bottom: 30px;" class="introduction-page">
    <div class="vip-enjoy vip-enjoy-padding vip-enjoy-content">
      <div class="vip-video">
        <video style="visibility:hidden" id="video-main" src="movie.ogg" controls="controls">
          您的浏览器不支持 video 标签。
        </video>
        <!--<img src="">-->
      </div>
      <div class="vip-content">
        <div class="vip-title">
          loading
        </div> 
        <div class="vip-post">
          loading
        </div>
        <div class="vip-content-time">
          <ul id="introduction-time-list1" class="introduction-time">
            <li>备料和预处理</li>
            <li>料理时长</li>
            <li>享用份量</li>
          </ul>
          <ul id="introduction-time-list2" class="introduction-time">
            <li id="prepare-time">loaing</li>
            <li id="cooking-time">loading</li>
            <li id="enjoy-num">loading</li>
          </ul>
        </div>
        <div class="vip-menu">
          <ul>
            <li><img width="28" height="14" src="images/watch_grey.png"></img> <span id="browser-num">0</span></li>
            <li onclick="addToReadingList(this)">
              <img width="16" height="16" src="images/add_grey.png"></img>
              </span>
            </li>
            <li onclick="displayShareForm()">
              <img width="16" height="16" id="mono-share" src="images/share_grey.png"></img>
              </span>
            </li>
          </ul>
        </div>
        <div class="display:none!important;" class="teacher-brand introduction-teacher-brand"><img style="display:none;" src=""></div>
      </div>
    </div>
    
    <div class="introduction-comment">
      <ul>
        <li>
            <div class="profile-phtot-uploaded">
              <!-- <img width="50" id="user-comment-photo" height="50" src="images/default_photo.png" />    -->
                  <div id="user-comment-photo" style="background:url(images/default_photo.png) no-repeat scroll 50% 50% transparent;background-size:cover;"></div>
            </div>
        </li>
        <li>
          <div class="introduction-comment-input-container">
            <span>在此输入留言或内容</span>
            <textarea style="display:none;width:100%;"></textarea>
            <input style="margin:0 auto;display:none;margin-top:10px;" class="button button-caution button-pill" value="提交" type="button">
          </div>
        </li>
      </ul>
    </div>

    </div>
    </section>
    
    <div style="position:fixed" class="recipes-introduction-footer">
      <ul id="recipes-introduction-footer-ul">
        <li><span id="introduction" class="borderActive">介绍</span></li>
        <li><span id="formula">配方</span></li>
        <li><span id="step">步骤</span></li>
      </ul>
    </div>

  <script type="text/javascript">
    $(document).ready(function() {

      $('.profile-phtot-uploaded #user-comment-photo').attr('style',"background:url("+localStorage.headimgurl+") no-repeat scroll 50% 50% transparent;background-size:cover;");

      var favouriteList=getFavourteList();

      function displayCommentsList(data){
        var commentsList=data;
        var usereply;
        var officalReply;
        var username;
        commentsList.forEach(function(e){
          username=e['username']==''?'[undefined]':e['username'];
          usereply='<ul><li><a id="com'+e['id']+'"></a><div class="profile-phtot-uploaded"><div id="user-comment-photo" style="background:url('+e['headimgurl']+') no-repeat scroll 50% 50% transparent;background-size:cover;"></div></div></li><li><div class="introduction-comment-title"><ul><li>'+username+'</li><li>'+e['created_time']+'</li></ul></div><div class="introduction-comment-content"><span>'+e['content']+'</span></div>';
          if(e['reply_username']==null){
            officalReply='';
          }else{
            officmalReply='<div class="introduction-comment-reply"><div class="introduction-comment-title"><ul><li>'+e['reply_username']+'</li><li>'+e['reply_time']+'</li></ul></div><div class="introduction-comment-content comment-reply-content"><span>'+e['reply_content']+'</span></div></div></li></ul>';            
          }
          $('.introduction-comment').append(usereply+officalReply);
        });
      }

      displayALertForm('正在加载...',1000);
      var articleID=getQueryString("id");  
      if(isQueryValid(articleID)){
        getRecipeInfo(articleID,0,1,10,function(data){
          if(data!=''){
            var jsonData=JSON.parse(data);
            if(jsonData['msg']!='成功'){
              displayALertForm(jsonData['msg']);
            }else{
              var introList=jsonData['data'];
              if(introList['info']!=''){
                var introInfo=introList['info'];
                $('.vip-title').html(introInfo['title']);
                $('.vip-post').html(introInfo['paper']);
                $('.introduction-time #prepare-time').html(introInfo['prepare_time']);
                $('.introduction-time #cooking-time').html(introInfo['cooking_time']);
                $('.introduction-time #enjoy-num').html(introInfo['enjoy_num']);
                $('.vip-menu ul li #browser-num').html(introInfo['browse_num']);
                $('.introduction-teacher-brand img').attr('src',introInfo['arrange_image_url']);
                if(introInfo['video_url_480']==''){
                  $('.vip-video').attr('style','background:url('+introInfo['image']+') no-repeat scroll center center transparent;background-size:cover;width:'+$(document).width()+'px!important;');
                  if(browser.versions.iPad || browser.versions.iPhone){
                  }
                }else{
                  $('.vip-video video').attr('src',introInfo['video_url_480']);
                  console.log('dssd');
                  $('.vip-video video').css('visibility','visible');
                }
              }
              if(introList['comments']!=''){
                displayCommentsList(introList['comments']);
                var anchorUrl=window.location.href;
                if(anchorUrl.indexOf('#')!=-1){
                  anchorUrl=anchorUrl.split('#');
                  document.getElementById(anchorUrl[1]).scrollIntoView();
                }
              }else{
                $('#comment-show-area').hide();
                $('.introduction-comment').css('margin-bottom','60px');
              }
            }
          }else{
            displayALertForm('加载失败,请重试');
          }
        });
      }else{
        window.location.href="recipes.php";
      }

      if(typeof favouriteList!='undefined'){
        for (var k = 0; k < favouriteList.length; k++) {
          var collection=favouriteList[k].split('|');
          var atype=collection[0];
          var aid=collection[1];
          if(aid==articleID){
            $('.vip-menu ul li:nth-child(2)').find('img').attr('src','images/add_red.png');
            break;
          }
        };
      }

      var flag = false;
      function submitComments(articleid,comments){
        sendComments(1, localStorage.tokenID, articleid, comments,function(data) {
          if(data!=''){
            var jsonData = JSON.parse(data);
            displayALertForm(jsonData);
            if (jsonData['msg'] == '留言成功') {
              displayALertForm(jsonData['msg']);
              var usereply='<ul><li><div class="profile-phtot-uploaded"><div id="user-comment-photo" style="background:url('+localStorage.headimgurl+') no-repeat scroll 50% 50% transparent;background-size:cover;"></div></div></li><li><div class="introduction-comment-title"><ul><li>'+localStorage.nickname+'</li><li>'+getCurrentTime()+'</li></ul></div><div class="introduction-comment-content"><span>'+comments+'</span></div>';
              $('.introduction-comment').append(usereply);
              $('html, body').animate({scrollTop: $(document).height()}, 300);
              $('.introduction-comment-input-container').html('<span>在此输入留言或内容</span><textarea style="display:none;width:100%;"></textarea><input style="margin:0 auto;display:none;margin-top:10px;" class="button button-caution button-pill" value="提交" type="button">');
              flag = true;
            } else {
              var _msg=jsonData['msg'];
              if(_msg.indexOf('不存在')!=-1){
                window.location.href='login.php';
              }else{
                displayALertForm(jsonData['msg']);
              }
            }
          }else{
            displayALertForm('获取失败,请重试');
          }
        });
      }

      function sendComments_(scomments){
        displayALertForm('消息发送中，请稍候...');
          if (flag == false) {
            var overtime = new Date();
            localStorage.Time = overtime.getMinutes() + 0.50;
            submitComments(articleID,scomments);
          } else if (flag == true) {
            var repeatTime = new Date();
            if (repeatTime.getMinutes() < localStorage.Time) {
              submitComments(articleID,scomments);
              localStorage.Time = repeatTime.getMinutes() + 0.50;
            }
          }
      }

      $('.introduction-comment-input-container textarea').keydown(function(event) {
        if (event.ctrlKey && event.which == 13) {
          if(localStorage.isLogin=='true'){
            var scomments = $('.introduction-comment-input-container textarea').val();
            if(scomments!=''){
              sendComments_(scomments);
            }else{
              displayALertForm('请填写内容');
            }
          }else{
            displayALertForm('请登录');
            window.location.href="login.php";
          }
        }
      });

      $('.introduction-comment-input-container input').click(function(){
        if(localStorage.isLogin == 'true'){
          var scomments = $('.introduction-comment-input-container textarea').val();
          if(scomments!=''){
            sendComments_(scomments);
          }else{
            displayALertForm('请填写内容');
          }
        }else{
          displayALertForm('请登录');
          window.location.href="login.php";
        }
      });

      $('.vip-menu ul li:nth-child(2)').attr('type',1);
      $('.vip-menu ul li:nth-child(2)').attr('articleid',articleID);

      $('.recipes-introduction-footer ul li').click(function(){
        if(!$(this).find('span').hasClass('borderActive')){
          displayALertForm('正在努力加载,请稍候...',4000);
          var _this=$(this);
          var type=_this.find('span').attr('id');
          var elm;
          
          $('.recipes-introduction-footer ul li').each(function(e){
            var thisSpan=$(this).find('span');
            if(thisSpan.hasClass('borderActive')){thisSpan.removeClass('borderActive');}
          });
          _this.find('span').addClass('borderActive');
          if(type=='introduction'){
            loadPagesA('introduction.php','body');
          }else{
            loadPagesA('pages/introduction/'+type+'.php','.introduction-page');
          }
        }
      });

      $('.introduction-comment-input-container').click(function(){
        var _this=$(this);
        var thisInput=_this.find('textarea');
        var thisBtn=_this.find('input');
        if(thisInput.css('display')=='none' || thisInput.val()==''){
          _this.find('span').toggle();
          thisInput.attr('width',_this.parent().width());
          thisInput.attr('height',_this.parent().height());
          thisInput.toggle();
          thisBtn.toggle();
          thisInput.focus();
        }
      });

      /*function handleRecipesFooterEvent(){
          if(isUserAtBottom()){
            $('.recipes-introduction-footer').css({
              'position':'relative',
              'margin-top':'40px'
            });
          }else{
            $('.recipes-introduction-footer').css('position','fixed');
          }
      }*/

      //$(window).scroll(handleRecipesFooterEvent);
      $('.main-footer').html('');
      $('.introduction-page').css('margin-top','-7px');

      var media=document.getElementById("video-main");
      var eventListener=function(e){
        media.addEventListener(e,function(){
          switch(e){
            case 'play':
              $('.teacher-brand').hide();
              break;
            case 'pause':
              $('.teacher-brand').hide();
              break;
            case 'ended':
              $('.teacher-brand').hide();
              break;
            default:
              break;
            }
        });
      }

      eventListener('play');
      eventListener('pause');
      eventListener('ended');

      $(window).scroll(function () {
        // if($(document).scrollTop() + $(window).height() >= $(document).height()){
        //   $('.recipes-introduction-footer').css({
        //     'position':'relative'
        //   });
        // }else{
        //   $('.recipes-introduction-footer').css({
        //     'position':'fixed'
        //   });
        // }
      });

    });

  </script>

<?php require('footer.php'); ?>
