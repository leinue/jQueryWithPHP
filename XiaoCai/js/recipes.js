function addLoadEvent(func){
	  var oldonload=window.onload;
	  if (typeof window.onload!='function') {
	  	window.onload=func;
	  }
	  else {
	  	  window.onload=function(){
	  	  	  oldonload();
	  	  	  func();
	  	  }
	  }
}

function ingredientSearch(){
	   var recipes_ingreSearch=document.getElementById('recipes_ingreSearch');
	   var recipes_style=document.getElementById('recipes_style');
	   var slidedown=document.getElementById('slidedown');
	   var slidedownStyle=document.getElementById('slidedownStyle');
	   var tag=true;
	   var flag=true;
	       recipes_ingreSearch.onclick=function(){
                  if(flag)
                 {
                   $('.header-recipes ul li span').removeClass('glyphicon glyphicon-triangle-top');
                    $('.header-recipes ul li span').addClass('glyphicon glyphicon-triangle-bottom');                 
	   	            if(!tag)
	   	            {
	   	            	   $('#slidedownStyle').slideUp(); 
	   	            }
	   	            $('#slidedown').slideDown();
	   	            flag=false;
	   	        }
	   	        else {
	   	        	    $('.header-recipes ul li span').removeClass('glyphicon glyphicon-triangle-bottom');
                    $('.header-recipes ul li span').addClass('glyphicon glyphicon-triangle-top');                 
	   	            $('#slidedown').slideUp();
	   	            flag=true;
	   	        }
	       }
	    
	     recipes_style.onclick=function(){
                  if(tag)
                 {
                   $('.header-recipes ul li span').removeClass('glyphicon glyphicon-triangle-top');
                    $('.header-recipes ul li span').addClass('glyphicon glyphicon-triangle-bottom');                 
	   	            if(!flag)
	   	            {
	   	            	  $('#slidedown').slideUp(); 
	   	            }
	   	             $('#slidedownStyle').slideDown();
	   	            tag=false;
	   	        }
	   	        else {
	   	        	 $('.header-recipes ul li span').removeClass('glyphicon glyphicon-triangle-bottom');
                    $('.header-recipes ul li span').addClass('glyphicon glyphicon-triangle-top');                 
	   	            $('#slidedownStyle').slideUp();
	   	            tag=true;
	   	        }
	       }
	    

	    var Searchli=slidedown.getElementsByTagName('li');
	   for(i=0;i<Searchli.length;i++)
	   {
	   	   Searchli[i].onclick=function(){
	   	   	        $('#slidedown').slideUp();
	   	   }
	   }
	     var Foodli=slidedownStyle.getElementsByTagName('li');
	      for(i=0;i<Foodli.length;i++)
	   {
	   	   Foodli[i].onclick=function(){
	   	   	        $('#slidedownStyle').slideUp();
	   	   }
	   }
}




addLoadEvent(ingredientSearch);


/*$('.header-recipes ul #recipes_ingreSearch').click(function(){
	console.log("sddds");
});*/