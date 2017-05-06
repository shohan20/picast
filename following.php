<!DOCTYPE html>
<html lang="en-US">
<head>
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
<!--<script src="js/lg-share.js"></script>-->
      <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]--> 
        <?php session_start(); ?>
        <script>

          var gallery = lightGallery(document.getElementById('lightgallery'),{
            selector: '.ima'
          }); 
         
          var gal = lightGallery(document.getElementById('lightgallery1'),{
            selector: '.ima'
          });

          $(document).ready(function(){
              $("#navi").hide();

              var username= "<?php echo $_SESSION['username']; ?>"
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username +"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="gallery.php">My Gallery</a></li><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
                   var bari='<a class="navbar-brand" href="gallery.php">My-Gallery</a><a class="navbar-brand"  href="album.php">My-Whenhub-Album</a>';
                  $('#navbari').append(bari);
               }
               else
                  $('div#logg').html('<a id="loggin" href="login/login.html">login</a>');
                

            $(document).on("change","select[id='sel1']", function(event){
                   $.ajax({
                        type: "POST",
                        url: "php/privacyProcess.php",
                        data    : {name: $(this).attr('name'),value: $(this).find('option:selected').val()},
                        success: function(response){
                        
                        }
                      });

            });

            
            $.ajax({
              type: "POST",
              url: "php/foundfollowing.php",
               
              success: function(response){
                // put on console what server sent back...
                if(response!=null){
                var obj = JSON.parse(response);
                var i=0;
               $.each(obj,function(index,flower){
                    
                    //Do things with things[i]
                    
                    var user_id=flower['id'];
                    var about=flower['about'];
                    var usid=flower['whentmp'];
                    var username=flower['username'];
                    
            
                    var usrs;
                    //console.log(things[i]);
                    if(usid=="false")
                      usrs="profile.jpg";
                    else
                      usrs="user/"+usid;
                    
                   
                 // console.log(ib);
                 var value="";
                 if(i%3==2)
                  value+='<div class="row">';
                 value +='<div class="imag col-md-3" style="background-color: white; margin: 5px; "><img id="uid" class=" img-thumbnail" src='+usrs+'><div class="well"><div class=well> '+username;  
                 if(about.match(/\S/)){
                 value+= '<br>'+about;
               }

               value+='</div><a class="btn btn-default btn-lg" href="followphoto.php?id='+user_id+'">Photo <span id="baphoto'+user_id+'" class="badge"></span></a><br><a class="btn btn-default btn-lg" href="followalbum.php?id='+user_id+'">Album <span id="baalbum'+user_id+'" class="badge"></span></a></div></div>';
               if(i%3==2)
                value+='</div>';
              i=(i+1)%3;
                 $("#light").append(value);
                  $.ajax({
                  type: "POST",
                  url: "php/countphoto.php",
                  data: {id: user_id},
                  success: function(response){
                      $('#baphoto'+user_id).html(response);
                  }
                });

            $.ajax({
                  type: "POST",
                  url: "php/countalbum.php",
                  data: {id: user_id},
                  success: function(response){
                      $('#baalbum'+user_id).html(response);
                  }
                });
                
                 }); 

             }
           }

         });

          });
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
           <div class="top-nav s-12 l-5">

            <li><a href=".">Home</a>

          </div>
            <ul class="s-12 l-2">
             <li class="logo hide-s hide-m">
              <a href="."><strong>picast</strong></a>
            </li>
          </ul>
          <div class="top-nav s-12 l-5">
           <ul class="right top-ul chevron">

            <li ><div id="logg" > </div> </li>
          </ul> 
        </div>
      </div>
    </div>
  </nav>
</header>
<section>
 <div id="head" style="padding-bottom: 0px; margin-bottom:0px;">
  <div class="line">
   <h1>Following</h1>
    <nav  id="navii" class="navbar navbar-inverse line top-nav " data-spy="affix" data-offset-top="197">
    <div class="container-fluid ">
      <!-- Brand and toggle get grouped for better mobile display -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div id="navbari">
      <a class="navbar-brand"  href="publicGallery.php">Gallery</a>
       <a class="navbar-brand" href="publicalbum.php">Whenhub-Album</a>
       </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  
 </div>
</div>

 


<div style="margin-top:50px; ">
<div class="container-fluid ">
  
   <div id="light" class="btn-group col-md-offset-2"  >

    </div>
  </div>
</div>




</section>
<!-- FOOTER -->   
</body>
</html>