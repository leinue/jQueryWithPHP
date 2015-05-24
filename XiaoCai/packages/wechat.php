<?php
/**
 * 微信SDKss
 */
class weChatSDK{

    var $appid = "";
    var $appsecret = "";
    //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
      if($appid){
        $this->appid = $appid;
      }
      if($appsecret){
        $this->appsecret = $appsecret;
      }
      $this->lasttime = 1395049256;
      $this->access_token = "nRZvVpDU7LxcSi7GnG2LrUcmKbAECzRf0NyDBwKlng4nMPf88d34pkzdNcvhqm4clidLGAS18cN1RTSK60p49zIZY4aO13sF-eqsCs0xjlbad-lKVskk8T7gALQ5dIrgXbQQ_TAesSasjJ210vIqTQ";
      if (time() > ($this->lasttime + 7200)){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        
        $this->access_token = $result["access_token"];
        $this->lasttime = time();
      }
    }
    //获取用户基本信息
    public function get_user_info($access_token,$openid)
    {
      $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
      $res = $this->https_request($url);
      return json_decode($res, true);
    }

    public function refresh_access_token(){

    }

    public function access_token_is_valid(){

    }

    //https请求
    public function https_request($url, $data = null)
    {
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
      if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      }
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($curl);
      curl_close($curl);
      return $output;
    }
  }

  function oauth2($isRegister){
      define('APP_ID','wxcd5e8635095ba695');
      define('APP_SECRET', '114f18ef6fac879b406821f0e084620c');
      $wechat=new weChatSDK(APP_ID,APP_SECRET);
      if(isset($_GET['code'])){
        //https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APP_ID."&secret=".APP_SECRET;
        $res=$wechat->https_request($url);
        $res=(json_decode($res, true));
        $row=$wechat->get_user_info($res['access_token'],$res['openid']);
        if($row['openid']){
          // cookie('wechat',$row['openid'],25920000);
          echo "<script>displayALertForm('授权成功,正在为您处理...',1000000);</script>";
          $nickname=$row['nickname'];
          $headimgurl=$row['headimgurl'];
          $openid=$row['openid'];
          if($isRegister===1){
            $locate='window.location.href="profile.php?register='.$isRegister.'"';
          }else{
            $locate='window.location.href="index.php"';
          }
          echo "<script>
        registerOrLoginByWechat('$openid','$nickname','$headimgurl',function(data){
          if(data==''){
            displayALertForm('登录失败,请重试',3000);
          }else{
            var jsonData=JSON.parse(data);
            if(jsonData['error']=='0'){
              displayALertForm(jsonData['msg'],3000);
              localStorage.isLogin=false;
            }else{
              displayALertForm('授权成功,2秒后将自动跳转',3000);
              localStorage.uid=jsonData['data']['uid'];
              localStorage.nickname=jsonData['data']['nickname'];
              localStorage.tokenID=jsonData['data']['token_id'];
              localStorage.headimgurl=jsonData['data']['headimgurl']==''?'images/default_photo.png':jsonData['data']['headimgurl'];
              localStorage.isReply=jsonData['data']['is_reply'];
              localStorage.loginByWechat=true;
              localStorage.isLogin=true;
              if(browser.versions.iPhone){
                alert('登录成功,点击确定跳转');
                $locate;
              }else if(browser.versions.webKit){
                alert('登录成功,点击确定跳转');
                $locate;
              }else{
                setTimeout('$locate',2000);
              }
            }
          }
        });
          </script>";
          // echo "<script>displayALertForm('".$row['nickname']."',3000);</script>";
        }else{
          echo "<script>displayALertForm('授权出错,请重新授权!',3000);</script>";
        }
      }
    }

?>