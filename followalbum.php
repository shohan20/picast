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
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
      <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]--> 

        <script>
            var user_i="<?php echo $_GET['id']; ?>";
          var gallery = lightGallery(document.getElementById('lightgallery'),{
            selector: '.ima'
          }); 
          var storevalue;

          $(document).ready(function(){



            var username="<?php echo $_SESSION['username']; ?>"; 
            ccancel();
            var  a = document.getElementById('photobutton');
              a.setAttribute("href", 'followphoto.php?id='+user_i);
             $.ajax({
              type: "POST",
              url: "php/whenusersf.php",
              data: {id: user_i},
              //dataType:'JSON', 
              success: function(response){
                if(response!=null){
                
                var obj = JSON.parse(response);
                   var i=0;

               $.each(obj,function(index,flower){
               var  whencast= flower['whencast'];
               var cast_id=flower['cast_id'];
               var user_id=flower['user_id'];
               var username=flower['username'];
               var model_id=flower['whenmodel'];  
               var priv=flower['privacy'];
              if(priv=='2'){
              
          $.ajax({
              type: "GET",

              url: "https://api.whenhub.com/api/schedules/"+cast_id+"?filter[include]=media&filter[include][events]=media&access_token="+whencast,

              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                var resstring=JSON.stringify(response);

                if(resstring.length>0){
                
                var obj = JSON.parse(resstring);
                var index=0;
                
                 $.each(obj['events'],function(index,flower){
                  if(flower['id']==model_id){
                  var id=flower['id'];
                  

                  var name=flower['name'];
                  var nphoto=flower['media'].length;
                  var time =flower['updatedAt'];
                  var tim=time.split('T');
                  var local=flower['location']['name'];
                  var url;
                  
                  
                  if(nphoto>0)
                    url=flower['media'][0]['url'];
                  else
                    url="noimage.png";
                  var description=flower['description'];
                  if(description==null){
                    description="";
                  }
                  var value="";
                 if(i%3==2)
                  value +='<div class="row">';
                  value='<div class="imag col-md-3 " style="background-color: white; margin: 5px;"><a href="publicvalbum.php?id='+id+'&j='+user_id+'"> <img id="i'+id+'" src="'+url+'" class="img-square img-thumbnail"  width="200" height="100"></a><div class="well" style="margin-bottom: 0px"><div>'+tim[0]+'<br>'+nphoto+' photos</div> <div> Album: '+name+'</div>';
                  if(description.match(/\S/)){
                 value+= '<div>'+description+' </div>';
               }
               if(local.match(/\S/)){
                 value+= '<div class="glyphicon glyphicon-map-marker">'+local+' </div>';
               }
               value+='</div></div>';

                   if(i%3==2){

                value+='</div>';
              }
              i=(i+1)%3;
                          $('#light').append(value);
                       
                      
                 }
               });
                
             }
           }

         });
        }
        });
             }
        }
      });

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
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username+"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
                   var bari='<a class="navbar-brand" href="gallery.php">My-Gallery</a><a class="navbar-brand"  href="album.php">My-Whenhub-Album</a>';
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

          });
          

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
        <script type="text/javascript" src="dist/dropzone.js"></script>
      </head>
  <body class="size-1140">
        <!-- TOP NAV WITH LOGO -->  
        <header>
         <nav>
          <div class="line">
           <div class="top-nav">              
            <div class="logo hide-l">
             <a href=".">PICAST</a>
             <div id="logg" > </div>
            </div> 
           <div class=" top-nav s-12 l-5">

            <li><a href=".">Home</a>

            </div>
            <ul class=" s-12 l-2 ">
             <li class="logo hide-s hide-m">
              <a href="."><strong>picast</strong></a>
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
   <h1>Whenhub Album</h1>



  <nav  id="navi" class="navbar navbar-inverse line top-nav " data-spy="affix" data-offset-top="197">
    <div class="container-fluid ">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="icon-bar"></span>
        </button>
        <div id="navbari">
      <a class="navbar-brand"  href="publicGallery.php">Gallery</a>
       <a class="navbar-brand" href="publicalbum">Whenhub-Album</a>
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
    
    
      <a id="photobutton" href="" class="btn btn-default btn-lg">Photo <span id="baphoto" class="badge"></span></a>
      <a id="albumbutton" href="#" class="btn btn-default btn-lg">Album <span id="baalbum" class="badge"></span></a>
      <button id="bfollow" type="button" onclick="clickfollow()" class="btn btn-default btn-lg">Follow </button>
    
    </div>
    <div id="light" class="col-sm-9 col-sm-offset-1">

    </div>
    </div>
    </div>
</section>
<!-- FOOTER -->   

</body>
</html>