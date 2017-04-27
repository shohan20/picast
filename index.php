<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width" />
       <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <title>Picard</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->  
      <link rel="stylesheet" href="css/template-style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
       <style>
  html
  {
    font-size: 100%;
    background-color:white;
  }
  html,
body {
  height: 100%;

  /* The html and body elements cannot have any padding or margin. */
}


/* Set the fixed height of the footer here */
footer {
  height: 50px;
  background-color: rgba(0, 30, 34, 0.85);
}


/* Custom page CSS
-------------------------------------------------- */
footer > p {
  padding: 0 125px;
}

</style>    
      <script type="text/javascript" src="js/modernizr.js"></script>
      <script type="text/javascript" src="js/responsee.js"></script>   
      <!--[if lt IE 9]>
	      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
      <![endif]-->
     <?php session_start(); ?>
            
      
      <script>
          $(document).ready(function(){

         var username= "<?php echo $_SESSION['username']; ?>"
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username+"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="gallery.php">My Gallery</a></li><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
               }
               else
                  $('div#logg').html('<a id="loggin" href="login/login.html">login</a>');
                  $(document).on("click","a[id='loggin']",function(event){

               });

         });
      </script>
   </head>
   <body class="size-1140">
      <!-- TOP NAV WITH LOGO -->  
      <header>
         <nav>
            <div class="line">
               <div class="top-nav">              
                  <div class="logo hide-l">
                     <a href="#">picard</a>
                     <div id="logg" > </div>
                  </div>                  
                  
                  <div class="top-nav s-12 l-5">
                     
                        <li><a href="publicGallery.php">Gallery</a>
                       
                     
                  </div>
                  <ul class="s-12 l-2">
                     <li class="logo hide-s hide-m">
                        <a href="#"><strong>picard<strong></a>
                     </li>
                  </ul>
                  <div class="top-nav s-12 l-5 ">
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
         <!-- CAROUSEL -->  	
         <div id="carousel">
            <div id="owl-demo" class="owl-carousel owl-theme">
               <div class="item">
                  <img src="img/first.jpg" alt="">      
                  
               </div>
               <div class="item">
                  <img  src="img/second.jpg" alt="">      
                  
               </div>
               <div class="item">
                  <img src="img/third.jpg" alt="">      
                  
               </div>
            </div>
         </div>
         <!-- FIRST BLOCK --> 	
      <div id="first-block" class="container" >
        
        <div style="width: 100%; z-index: -99; height:500px; margin-top: 100px; margin-bottom: 50px;" class="jumbotron">
        <iframe frameborder="0" height="100%" width="100%" 
                  src="https://youtube.com/embed/UxhnAiXTiqk?autoplay=1&loop=1&controls=0&showinfo=0&autohide=1&playlist=UxhnAiXTiqk">
      </iframe>
        </div>
      </div>
      <footer id="footer" style="position: fixed; bottom: 0px; left: 0px; right: 0px;">
        <p class="h4 s-12 l-5 text-muted"> &#169; Cauliflower, 2017 </p> 
        <a class="h4 s-12 l-5 text-muted " style="text-align: right; color: white;" href="about.php">About</a>
        
      </footer>
      
      
      </section>
     
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>   
      <script type="text/javascript">
         jQuery(document).ready(function($) {  
           $("#owl-demo").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : false,
         	singleItem:true
           });
           $("#owl-demo2").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : true,
         	singleItem:true
           });
         });	
          
      </script> 
   </body>
</html>