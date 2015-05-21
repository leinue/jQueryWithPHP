<?php
  $upFilePath = "/uploadimg";
  $ok=@move_uploaded_file($_FILES['img']['tmp_name'],$upFilePath);
if(!$ok){
 echo json_encode("上传失败");
}else{
 echo json_encode('上传成功');
}
?>