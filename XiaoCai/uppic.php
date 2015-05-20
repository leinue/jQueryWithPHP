<?php

$arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg');
$max_size='500000';      // 最大文件限制（单位：byte）
$upfile='./upload'; //图片目录路径
$file=$_FILES['imgFile'];
 
   if($_SERVER['REQUEST_METHOD']=='POST'){ //判断提交方式是否为POST
     if(!is_uploaded_file($file['tmp_name'])){ //判断上传文件是否存在
    echo "文件不存在！";
    exit;
    }
  
  if($file['size']>$max_size){  //判断文件大小是否大于500000字节
    echo "上传文件太大！";
    exit;
   }
  if(!in_array($file['type'],$arrType)){  //判断图片文件的格式
     echo "上传文件格式不对！";
     exit;
   }
  if(!file_exists($upfile)){  // 判断存放文件目录是否存在
   mkdir($upfile,0777,true);
   } 
      $imageSize=getimagesize($file['tmp_name']);
   $img=$imageSize[0].'*'.$imageSize[1];
   $fname=$file['name'];
   $ftype=explode('.',$fname);
   $picName=$upfile."/cloudy".$fname;
  
   if(file_exists($picName)){
    echo "同文件名已存在！";
    exit;
     }
   if(!move_uploaded_file($file['tmp_name'],$picName)){ 
    echo "移动文件出错！";
    exit;
    }
   else{
    echo "图片文件上传成功！<br/>";
    echo "<font color='#0000FF'>图片大小：$img<br/>";
    echo "图片预览：<br><div style='border:#F00 1px solid; width:200px;height:200px'>
    <img src=\"".$picName."\" width=200px height=200px>".$fname."</div>";
    }
      }
?>