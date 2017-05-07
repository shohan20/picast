<!DOCTYPE html>
<!DOCTYPE html >
<html lang="en-US">
<head>
  <title>Picast-Album</title>
  <meta charset="UTF-8">
 
  <?php session_start(); ?>
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
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
  <script src="../dist/sweetalert2.js"></script>
  <link rel="stylesheet" href="../dist/sweetalert2.css">
  <script src="../dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="dist/dropzone.css" />
     <script type="text/javascript" src="dist/dropzone.js"></script>
    <script >
    $(document).ready(function(){
      var username= "<?php echo $_SESSION['username']; ?>"
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username +"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="gallery.php">My Gallery</a></li><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
               }
               else
                  $('div#logg').html('<a id="loggin" href="login/login.html">login</a>');
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
             <a href="index.php">PICAST</a>
              <div id="logg" > </div> 
           </div>                  
           
           <div class="top-nav s-12 l-5">

            <li><a href="index.php">Home</a>

            </div>
            <ul class="s-12 l-2">
             <li class="logo hide-s hide-m">
              <a href="index.php"><strong>picast</strong></a>
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
 <div id="head">
  <div class="line">
   <h1>About</h1>
 </div>
</div>
<div class="content">

    <div class="line">

    <div class="margin">
    <div class="jumbotron" style="padding: 10%">
        <div class="well">
        <center><h3><strong> Picast: </strong></h3></center>
        <div class="list-group-item">
          Picast is a photosharing website where people can easily share their photos and albums. Picast uses whenhub api to organize albums. Complete documentation is provided in <a style="color: dodgerblue" href="https://github.com/shohan20/picast">here</a>
        </div>
        </div>
        <div class="well">
        <center><h3><strong> About me: </strong></h3></center>
        <div class="list-group-item">
        Md. Shorifuzzaman (Shohan)<br>
        Email: <a href="mailto:shohan.jess@gmail.com">shohan.jess@gmail.com</a><br>
         <a href="http://www.cse.du.ac.bd/">Department of Computer Science and Engineering, </a><br>
        <a href="http://www.du.ac.bd/">University of Dhaka, Bangladesh</a>
        </div>
        </div>
        <div class="well">
        <center> <h3><strong> Features: </strong></h3>
        </center>
        <ul class="list-group">
        <li class="list-group-item">personal user account</li>
        <li class="list-group-item">user friendly interface</li>
        <li class="list-group-item">upload multiple photos at a time</li>
        <li class="list-group-item">delete and sharing facilities</li>
        <li class="list-group-item">photo download, zoom & Fullscreen</li>
        <li class="list-group-item">search public photos by user, caption or date</li>
        <li class="list-group-item">social sharing</li>
        <li class="list-group-item">it can load different images for different viewports and can display high resulation images</li>
        <li class="list-group-item">photo captions and locations are easily editable </li>
        <li class="list-group-item">personal and public gallery</li>
        <li class="list-group-item">use of whenhub to create and organize album</li>
        <li class="list-group-item">whenhub users can organize thier albums through picast</li>
        <li class="list-group-item">Follow other users' album and photo</li>
        </div>
        </ul>
        <div class="well">
        <center><h3><strong> Limitations: </strong></h3></center>
        <ul class="list-group">
        <li class="list-group-item">due to limited time and academic examinations, couldn't be able to add some more cool features. </li>
        </ul>
        </div>
        
        <div class="well">
        <center> <h3><strong> Next Plan: </strong></h3></center>
        <ul class="list-group">
        <li class="list-group-item"> image searching using machine learning </li>
        <li class="list-group-item"> image processing and photo editor</li>
        <li class="list-group-item"> more user friendly interface (collage, animation etc)</li>
        <li class="list-group-item"> more socializable </li>
        </ul>
        </div>
        <div class="well">
        <center><h3><strong> Special thanks to: </strong></h3></center>
        <ul class="list-group"> 
        <li class="list-group-item"> http://t4t5.github.io/sweetalert/ </li>
        <li class="list-group-item"> vision design - graphic zoo </li>
        <li class="list-group-item"> https://github.com/sachinchoolur/lightgallery.js/ </li>
        </ul>
        </div>
        <div class="well">
        <center><h3><strong> Contact me: </strong></h3></center>
        <div class="list-group-item">
        Any recommendation is appreciated...<br>
        Email: <a href="mailto:shohan.jess@gmail.com">shohan.jess@gmail.com</a>
        <br>github: https://github.com/shohan20
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>
</body>

</html>
