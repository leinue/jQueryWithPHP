    <!DOCTYPE HTML>  
    <html>  
    <head>  
        <title>上传图片</title>  
        <meta charset="utf-8">  
    </head>  
    <body>  
        <iframe name="uploadfrm" id="uploadfrm" style="display: none;"></iframe>  
        <form name="formHead" method="post" action="" id="formHead" enctype="multipart/form-data" target="uploadfrm">  
      
            <div>  
                <div>  
                    <input type="file" name="file_head" id="file_head" onchange="javascript:setImagePreview();" />  
                </div>  
                <div>  
                    <div id="DivUp" style="display: none">  
                        <input type="submit" data-inline="true" id="BtnUp" value="确认上传" data-mini="true" />
                    </div>  
                </div>  
            </div>
        </form>
        <div data-role="fieldcontain">
            <div id="localImag">
                <img id="preview" width="-1" height="-1" style="display: none" />
            </div>
        </div>
              
      
        <script type="text/javascript">  
            function setImagePreview() {  
                var preview, img_txt, localImag, file_head = document.getElementById("file_head"),  
                picture = file_head.value;  
                if (!picture.match(/.jpg|.gif|.png|.bmp/i)) return alert("您上传的图片格式不正确，请重新选择！"),  
                !1;  
                if (preview = document.getElementById("preview"), file_head.files && file_head.files[0]) preview.style.display = "block",  
                    preview.style.width = "63px",  
                    preview.style.height = "63px",  
                    preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);  
                else {  
                    file_head.select(),  
                    file_head.blur(),  
                    img_txt = document.selection.createRange().text,  
                    localImag = document.getElementById("localImag"),  
                    localImag.style.width = "63px",  
                    localImag.style.height = "63px";  
                    try {  
                        localImag.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)",  
                        localImag.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = img_txt  
                    } catch(f) {  
                        return alert("您上传的图片格式不正确，请重新选择！"),  
                        !1  
                    }  
                    preview.style.display = "none",  
                    document.selection.empty()  
                }  
                return document.getElementById("DivUp").style.display = "block",  
                !0  
            }  
        </script>  
    </body>  
    </html>  