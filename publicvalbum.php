<!DOCTYPE html>
<html lang="en-US">
<head>
 <?php session_start(); ?>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width" />
 <title>Picard-Gallery</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style>
  html
  {
    font-size: 100%;
  }
 
</style>

<link rel="stylesheet" href="css/components.css">
<link rel="stylesheet" href="css/responsee.css">
<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
<!-- CUSTOM STYLE -->  
<link rel="stylesheet" href="css/tem-style.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>    
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/responsee.js"></script>   

<!--lightgallery-->

<link rel="stylesheet" href="dist/css/lightgallery.css">
<script src="dist/js/lightgallery.min.js"></script>

<!-- lightgallery plugins -->
<script src="dist/js/lg-thumbnail.min.js"></script>
<script src="dist/js/lg-fullscreen.min.js"></script>
<script src="dist/js/lg-pager.js"></script>
<script src="dist/js/lg-autoplay.js"></script>
<script src="dist/js/lg-fullscreen.js"></script>
<script src="dist/js/lg-zoom.js"></script>
<script src="dist/js/lg-hash.js"></script>
<script src="js/lg-share.js"></script>
<script type="text/javascript"  src="dist/download.js"></script>
<script type="text/javascript"  src="dist/download.js"></script>
      <!--[if lt IE 9]>
	      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]--> 

        <script>
          var whencast="";
          var cast_id="";
          var album_id="<?php echo $_GET['id']; ?>";
          var user_i="<?php echo $_GET['j']; ?>";
        
          var gallery = lightGallery(document.getElementById('lightgallery'),{
            selector: '.ima'
          }); 
          var storevalue;

          $(document).ready(function(){

            ccancel();
             var  a = document.getElementById('photobutton');
              a.setAttribute("href", 'followphoto.php?id='+user_i);
              a = document.getElementById('albumbutton');
              a.setAttribute("href", 'followalbum.php?id='+user_i);
            $.ajax({
                        type: "POST",
                        async: false,
                        url: "php/whenpublic.php",
                        data    : {whenmodel: album_id},
                        success: function(response){
                           if(response!=null){
                            
                          var obj = JSON.parse(response);
                        $.each(obj,function(index,flower){
                          cast_id=flower['cast_id'];
                          whencast=flower['whencast'];
                        });
                      }
                    }
                      });

            var username= "<?php echo $_SESSION['username']; ?>"
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username+"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
                  var bari='<a class="navbar-brand" href="gallery.php">My-Gallery</a><a class="navbar-brand" href="album.php">My-Whenhub-Album</a>';
                  $('#navbari').append(bari);

               }
               else
                  $('div#logg').html('<a id="loggin" href="login/login.html">login</a>');

                 $.ajax({
                      type: "POST",
                      url: "php/isfollow.php",
                      data: {j: user_i},
                      success: function(response){

                        if(response=="true"){

                          $('#bfollow').html('Unfollow');
                          $("#bfollow").attr("onclick","clickunfollow()");
                        }

                      }
                    });
                 
          $('#whenmodel').val(album_id);
          getwhen1();
          $.ajax({
                  type: "POST",
                  url: "php/countphoto.php",
                  data:{id: user_i},
                  success: function(response){
                      $('#baphoto').html(response);
                  }
                });

            $.ajax({
                  type: "POST",
                  url: "php/countalbum.php",
                  data:{id: user_i},
                  success: function(response){
                      $('#baalbum').html(response);
                  }
                });

            $.ajax({
              type: "POST",
              url: "php/iprofileimagef.php",
              //dataType:'JSON', 
              data:{id: user_i},
              success: function(response){
                // put on console what server sent back...
                
                //$("img#profileimg").animate({width: '300px',height: 'auto'});
                $("img#profileimg").attr("src",response+"?"+ new Date().getTime());

           }
         });

          function getwhen1(){
              $("#lightgallery").html('');      
          $.ajax({
              type: "GET",
              cache: false,
              url: "https://api.whenhub.com/api/schedules/"+cast_id+"?filter[include]=media&filter[include][events]=media&access_token="+whencast,

              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                var resstring=JSON.stringify(response);
                var j=0;
                if(resstring.length>0){
                
                var obj = JSON.parse(resstring);
                var index=0;
                 $.each(obj['events'],function(index,flower){
                  var aid=flower['id'];
                  if(aid==album_id){
                    $('#hea').html('Album: '+obj['events'][index]['name']);
                  for(i=0;i<flower['media'].length;i++){
                  var url=flower['media'][i]['url']+"?"+(new Date()).getTime();


                  var getLocation = function(href) {
                    var l = document.createElement("a");
                    l.href = href;
                    return l;
                };
                var l = getLocation(url);
                  var p2=l.pathname.split("?");
                  var p3=p2[0].split("/");
                  var p4=p3[2].split(".");

                  var id=flower['media'][i]['id'];
                  var time=flower['media'][i]['updatedAt'];
                  var tim=time.split('T');
                  var description=flower['media'][i]['name'];
                 // console.log(ib);
                var value="";
                 if(j%3==2)
                  value+='<div class="row">';
                 value+='<div class="imag col-md-3" id="d'+id+'" style="background-color: white; padding-bottom=0; margin: 5px;" ><div class="ima" data-googleplus-share-url="'+url+'" data-facebook-share-url="'+url+'" data-pinterest-share-url= data-pinterest-text= data-tweet-text="'+url+'" data-pinterest-share-url="'+url+'" data-src='+url+' data-sub-html="<p> '+description+' </p>"><img class="full" src='+url+'></div><div class="well"><span>'+tim[0]+'<span> '; 
                if(description.match(/\S/))
                 value+='<div>'+description+'</div>';
               value+='</div></div>';
                  if(j%3==2)
                value+='</div></div>';
              j=(j+1)%3;
                 $("#lightgallery").append(value);
                }
              }
                 });

               setTimeout(function() {
               //gallery.destroy(); // destroy gallery
               gallery = lightGallery(document.getElementById('lightgallery'),{
                selector: '.ima'
      });  //re-initiate gallery
             }, 100);
             }
           }

         });
      }
          
});

   function ccancel(){  
                   $.ajax({
                        type: "POST",
                        url: "php/aabout.php",
                        data:{id: user_i},
                        success: function(response){
                            
                            var obj = JSON.parse(response);
                               $.each(obj,function(index,flower){
                                
                                  $('#aboutname').html(flower['username']);
                                  $('.aboutt').html(flower['about']);
                               
                               });
                        }
                      });
                    
                  
        }
     
     function clickfollow(){
      $.ajax({
                        type: "POST",
                        url: "php/checklogin.php",
                  success: function(response){
                    
                    if(response=="true"){
                    $.ajax({
                      type: "POST",
                      url: "php/clickfollow.php",
                      data: {j: user_i},
                      success: function(response){
                        $('#bfollow').html('Unfollow');
                          $("#bfollow").attr("onclick","clickunfollow()");
                      }
                    });
                    }
                    else{
                      swal({
                              title: "Login",
                              text: "You must login to follow!",
                              type: "info",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Login",
                              closeOnConfirm: false
                            },
                            function(){
                              window.location.href='../login.html';
                            });
                      
                    }
                  }
              });
        
    }

    function clickunfollow(){
        $.ajax({
                      type: "POST",
                      url: "php/clickunfollow.php",
                      data: {j: user_i},
                      success: function(response){
                        $('#bfollow').html('Follow');
                          $("#bfollow").attr("onclick","clickfollow()");
                      }
              });
    }

        
        </script>


        <link rel="stylesheet" type="text/css" href="css/up.css" />
        <link rel="stylesheet" type="text/css" href="dist/dropzone.css" />
        <script type="text/javascript" src="dist/dropzone.js">
          
        </script>
       
      </head>
  <body class="size-1140">
        <!-- TOP NAV WITH LOGO -->  
        <header>
         <nav>
          <div class="line">
           <div class="top-nav">              
            <div class="logo hide-l">
             <a href=".">PICARD</a>
             <div id="logg" > </div>
            </div> 
           <div class=" top-nav s-12 l-5">

            <li><a href=".">Home</a>

            </div>
            <ul class=" s-12 l-2 ">
             <li class="logo hide-s hide-m">
              <a href="."><strong>picard</strong></a>
            </li>
          </ul>
          <div class="top-nav s-12 l-5">
           <ul class="right top-ul chevron">

            <li><div id="logg" > </div>
            </li>
          </ul> 
        </div>
      </div>
    </div>
  </nav>
</header>
<section>
 <div id="head" style="padding-bottom: 0px; margin-bottom:0px; ">
  <div class="line">
   <h1 id="hea"></h1>



  <nav  id="navi" class="navbar navbar-inverse line top-nav " data-spy="affix" data-offset-top="197">
    <div class="container-fluid ">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="icon-bar"></span>
        </button>
         <div id="navbari">
      <a class="navbar-brand" href="publicGallery.php">Gallery</a>
       <a class="navbar-brand" href="publicalbum.php">Whenhub-Album</a>
       </div>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
 </div>
</div>
<!--<button id="myBtn" >upload</button> -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="php/uploadwhencast.php" method="POST" id="formcast" class="dropzone">
    <input type="text" style="display: none" id="whenmodel" name="whenmodel">
    <div class="dz-message" data-dz-message><span>Click or Drop files here to upload</span></div>
    </form>

  </div>

</div>



<script type="text/javascript" src="js/when.js"></script>



<div style="margin-top:50px; ">
<div class="container-fluid ">
  <div class="col-sm-2" >
      <div  style="padding: 0px">
      <img id="profileimg" src="" style="padding: 0px" class="img-square img-thumbnail"  width="100%" height="auto">
      <div class="well">
      <div id="aboutname"></div>
      <div class="aboutt" ></div>
      </div>
      </div>
    
    
      <a id="photobutton" class="btn btn-default btn-lg">Photo <span id="baphoto" class="badge"></span></button>
      <a id="albumbutton" class="btn btn-default btn-lg">Album <span id="baalbum" class="badge"></span></a>
      <button id="bfollow" type="button" onclick="clickfollow()" class="btn btn-default btn-lg">Follow </button>
    
    </div>
   <div id="lightgallery" class="col-sm-9 col-sm-offset-1"  >

    </div>
  </div>
</div>
</section>
<!-- FOOTER -->   

</body>
</html>