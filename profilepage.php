<!DOCTYPE html>
<!DOCTYPE html >
<html lang="en-US">
<head>
  <title>Picast-Profile</title>
  <meta charset="UTF-8">
 
  <?php session_start();?>
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
     <script>
     $(document).ready(function(){
            $('#cpassword, #lpass, #lconp, #submitbutton, #cancelbutton').hide();
            
            var username= "<?php echo $_SESSION['username']; ?>";
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username +"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="gallery.php">My Gallery</a></li><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
               }
               else{
                  $('div#logg').html('<a id="loggin" href="login/login.html">login</a>');
               }
                


            $(document).on("click","button[id='editbutton']", function(event){
                $(this).blur();
                    $('#cpassword').prop("readonly",false);
                   $('#cpassword, #lpass, #lconp, #cancelbutton').show();
                    $('#editbutton').hide();

            });

            $(document).on("keyup","input[id='cpassword']", function(event){
                if(document.getElementById('cpassword').value.length >3){
                   $('#submitbutton').show();
                }
                else
                  $('#submitbutton').hide();
            });

            $(document).on("click","button[id='submitbutton']", function(event){
                $(this).blur();

                 $.ajax({
                      type: "POST",
                      url: "php/submitpass.php",
                      //dataType:'JSON', 
                      data: {password : $("input#cpassword").val()},
                      success: function(response){
                        $('#cpassword, #lpass, #lconp, #submitbutton, #cancelbutton').hide();
                        $('#editbutton').show();
                     }
                });

            });

            $(document).on("click","button[id='cancelbutton']", function(event){
                $('#cpassword, #lpass, #lconp, #submitbutton, #cancelbutton').hide();
                 $('#editbutton').show();
            });

            $(document).on("change","input[type='file']", function(event){
                $(this).blur();
                  var filedata=$(this).prop('files')[0];
                   var file= $(this)[0].files[0].name.split('.').pop();
                   
                  var form_data= new FormData();
                  form_data.append('file',filedata);
                  $('div#pclear').html('<input type="file" style="display: none;">');
                 // alert(form_data);
                  $.ajax({
                      type: "POST",
                      url: "php/profileimage.php",
                       contentType: false,
                        cache: false,
                        processData: false,
                      //dataType:'JSON', 
                      data: form_data,
                      success: function(response){
                      // put on console what server sent back...
                       $("img#profileimg").attr("src","");
                       $("img#profileimg").animate({width: '236px',height: '236px'});
                      var sr="<?php echo $_SESSION['id'] ?>";
                          $("img#profileimg").attr("src","user/"+sr+"."+file+"?t=" + new Date().getTime());
                          
                     }
              });
                  
            
            });

            $.ajax({
              type: "POST",
              url: "php/profile.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                if(response!=null){
                var obj = JSON.parse(response);
                var flag=false;
               $.each(obj,function(index,flower){
                    
                    var user=flower['username'];
                    var email= flower['email'];
                    $('input#name').val(user);
                    $('input#email').val(email);
                      flag=true;
                    });
               if(flag==false)
               window.location.replace("login/login.html");
             }
           }
         });

           $.ajax({
              type: "POST",
              url: "php/iprofileimage.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                $("img#profileimg").animate({width: '236px',height: '236px'});
                $("img#profileimg").attr("src",response);

           }
         });

         
          $('[data-toggle="password"]').tooltip();

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
   <h1>Profile</h1>
 </div>
</div>
<div class="content">

    <div class="line">

    <div class="margin">
    <div class="center btn-group pull-right">
    <div>
      <img id="profileimg" src="" class="img-circle img-thumbnail"  width="236" height="236">
    </div>
    <div>
     <label class="btn btn-default btn-file btn-lg">
    Change Photo <div id="pclear"> <input type="file" style="display: none;"> </div>
    </label>

      <button id="editbutton" type="button" style="" name="" value="" class="btn btn-default btn-file"><span class="glyphicon glyphicon-pencil"> Password</span></button>
    </div>
    <div>
      <label for='name' >User Name:</label>
     <input type="text" name="" class="form-control" readonly id="name" value=""></input>
    </div>
    <div>
      <label for='email'>Email:</label>
      <input type="email" class="form-control" readonly id="email" value=""></textfield>
    
    </div>
    <div>
      <label id="lpass" for="cpassword">Change password:</label>
      <input type="password" pattern=".{4,}"   required data-toggle="password" data-placement="top" title="atleast 4 characters" class="form-control"  id="cpassword" ></textfield>
    
    </div>

    <div class="btn-group pull-right">

    <button id="submitbutton" type="button" style="" name="" value="" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span></button>

    <button id="cancelbutton" type="button" style="" name="" value="" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
   </div>
   </div>
   </div>
   </div>
</section>
</body>

</html>
