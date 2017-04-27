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

            $(document).on("click","button[id='search']", function(event){
                  $("#marid").html('');
                  $("#marid").append('<div id="lightgallery1" class="btn-group" ></div>')
                  $.ajax({
                type: "POST",
              url: "php/searchdisplay.php",
               data : {keyword: $('input#insearch').val()},
              success: function(response){
                // put on console what server sent back...
                if(response!=null){
                var obj = JSON.parse(response);
               $.each(obj,function(index,flower){
                    
                    //Do things with things[i]
                    
                    var sr=flower['image_id'];
                    var rsr=sr.replace(".","");
                    var user=flower['user_id'];
                    var usid=flower['email'];
                    var username=flower['username'];
                    var t=flower['time'];
                    var time = t.split(' ');
                     var hourEnd = time[1].indexOf(":");
                    var H = +time[1].substr(0, hourEnd);
                      var h = H % 12 || 12;
                  var ampm = H < 12 ? "AM" : "PM";
                  time[1] = h + time[1].substr(hourEnd, 3) + ampm;
                    var usrs;
                    //console.log(things[i]);
                    var srs="upload/"+user+"/"+sr;
                    $("img#uid").animate({width: '50px',height: '50px'});
                    if(usid=="false")
                      usrs="profile.jpg";
                    else
                      usrs="user/"+usid;
                    var priv=flower['privacy'];
                    var description=flower['description'];
                   
                    storevalue=description;
                   
                 // console.log(ib);
                 
                 var value='<div class="imag btn-group" style="background-color: white;"><div class="btn-group"><img id="uid" class="img-circle img-thumbnail" src='+usrs+'> <span>'+" "+username+" "+'</span></div><div class="ima" data-src='+srs+' data-sub-html="<p> '+description+' </p>"><img class="full" src='+srs+'></div><div><span>'+time[0]+" "+time[1]+'(GMT)<span> </div>';  
                 
                 if(description.match(/\S/)){
                 value+= '<label for="comment"> </label> <textarea readonly class="form-control '+rsr+'" id="comment">'+description+'</textarea> </div>';
               }

                 $("#lightgallery1").append(value);
                
                 });
                $("img#uid").animate({width: '50px',height: '50px'});
               setTimeout(function() {
               //gallery.destroy(); // destroy gallery
               gal = lightGallery(document.getElementById('lightgallery1'),{
                selector: '.ima'
      });  //re-initiate gallery
             }, 100); 

             }
           }

         });
            });

            $.ajax({
              type: "POST",
              url: "php/publicdisplay.php",
               
              success: function(response){
                // put on console what server sent back...
                if(response!=null){
                var obj = JSON.parse(response);
               $.each(obj,function(index,flower){
                    
                    //Do things with things[i]
                    
                    var sr=flower['image_id'];
                    var rsr=sr.replace(".","");
                    var user=flower['user_id'];
                    var usid=flower['email'];
                    var username=flower['username'];
                    var t=flower['time'];
                    var time = t.split(' ');
                     var hourEnd = time[1].indexOf(":");
                    var H = +time[1].substr(0, hourEnd);
                      var h = H % 12 || 12;
                  var ampm = H < 12 ? "AM" : "PM";
                  time[1] = h + time[1].substr(hourEnd, 3) + ampm;
                    var usrs;
                    //console.log(things[i]);
                    var srs="upload/"+user+"/"+sr;
                    $("img#uid").animate({width: '50px',height: '50px'});
                    if(usid=="false")
                      usrs="profile.jpg";
                    else
                      usrs="user/"+usid;
                    var priv=flower['privacy'];
                    var description=flower['description'];
                   
                    storevalue=description;
                   
                 // console.log(ib);
                 
                 var value='<div class="imag btn-group" style="background-color: white;"><div class="btn-group"><img id="uid" class="img-circle img-thumbnail" src='+usrs+'> <span>'+" "+username+" "+'</span></div><div class="ima" data-src='+srs+' data-sub-html="<p> '+description+' </p>"><img class="full" src='+srs+'></div><div><span>'+time[0]+" "+time[1]+'(GMT)<span> </div>';  
                 if(description.match(/\S/)){
                 value+= '<label for="comment"> </label> <textarea readonly class="form-control '+rsr+'"id="comment">'+description+'</textarea> </div>';
               }
                 $("#lightgallery").append(value);
                
                 });
                $("img#uid").animate({width: '50px',height: '50px'});
               setTimeout(function() {
               //gallery.destroy(); // destroy gallery
               gallery = lightGallery(document.getElementById('lightgallery'),{
                selector: '.ima'
      });  //re-initiate gallery
             }, 100); 

             }
           }

         });

          });
        </script>


        <link rel="stylesheet" type="text/css" href="css/upp.css" />
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
             <a href=".">PICARD</a>
             <div id="logg" > </div>
            </div>                  
           <div class="top-nav s-12 l-5">

            <li><a href=".">Home</a>

          </div>
            <ul class="s-12 l-2">
             <li class="logo hide-s hide-m">
              <a href="."><strong>picard</strong></a>
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
   <h1>gallery</h1>
    <nav  id="navii" class="navbar navbar-inverse line top-nav " data-spy="affix" data-offset-top="197">
    <div class="container-fluid ">
      <!-- Brand and toggle get grouped for better mobile display -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="navbar-form navbar-center">
      <div class="form-group">
        <input type="text" id="insearch" class="form-control" placeholder="Picard Search">
      </div>
      <button id="search" type="submit" class="btn btn-default">Search</button>
    </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  
 </div>
</div>

 


<div style="margin-top:50px; ">

  <div class="content">

    <div class="line">

    <div id="marid" class="margin">
    <div id="lightgallery" class="btn-group" >

    </div>
  </div>
</div>
</div>
</div>




</section>
<!-- FOOTER -->   
</body>
</html>