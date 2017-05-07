<!DOCTYPE html>
<html lang="en-US">
<head>
 <?php session_start(); ?>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width" />
 <title>Picast-Gallery</title>
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
<script src="https://cdn.jsdelivr.net/places.js/1/places.min.js"></script>
      <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]--> 

        <script>
        
          var gallery = lightGallery(document.getElementById('lightgallery'),{
            selector: '.ima'
          }); 
          var storevalue;

          $(document).ready(function(){

            var username= "<?php echo $_SESSION['username']; ?>"
            ccancel();
         
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username+"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
                    var bari='<a class="navbar-brand" style="color: dodgerblue" href="#">My-Gallery</a><a class="navbar-brand" href="album.php">My-Whenhub-Album</a>';
                  $('#navbari').append(bari);
               }
               else
                  window.location.replace("login/login.html");
                 

            $(document).on("click","button[id='downloadbutton']",function(event){
                  $(this).blur();
                  var srcc='upload/'+$(this).attr('name')+"/"+$(this).val();
                  download(srcc);
                
            });
              $(document).on("keyup","textarea[id='comment']",function(e) {
                $(this).each(function () {
                  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
                      }).on('input', function () {
                          this.style.height = 'auto';
                      this.style.height = (this.scrollHeight) + 'px';
                    });
              });

             $.ajax({
                  type: "POST",
                  url: "php/countfollower.php",
                  success: function(response){
                      $('#bafollr').html(response);
                  }
                });

            $.ajax({
                  type: "POST",
                  url: "php/countfollowing.php",
                  success: function(response){
                      $('#bafollg').html(response);
                  }
                });
            $(document).on("click","button[id='deletebutton']", function(event){
                $(this).blur();
                    
                   $.ajax({
                        type: "POST",
                        url: "php/delete.php",
                        data    : {result: $(this).attr('name')},
                        success: function(response){

                        }
                      });
                  $('#dl'+$(this).val()).remove();

            });

             $(document).on("click","button[id='submitbutton']", function(event){
                $(this).blur();
                    $('textarea.form-control.'+$(this).val()).prop("readonly",true);
                    $('#ad'+$(this).val()).prop("readonly",true);
                    var tem=$('#ad'+$(this).val()).val();
                   $.ajax({
                        type: "POST",
                        url: "php/edit.php",
                        data    : {name: $(this).attr('name'), result: $('textarea.form-control.'+$(this).val()).val(),location: tem},
                        success: function(response){
                           
                        }
                      });
                    document.getElementsByClassName('btn btn-default btn-lg '+"su "+$(this).val())[0].style.display='none';
                              document.getElementsByClassName('btn btn-default btn-lg '+"ca "+$(this).val())[0].style.display = 'none';

            });


       $(document).on("click","button[id='cancelbutton']", function(event){
                $(this).blur();
                    $('textarea.form-control.'+$(this).val()).prop("readonly",true);
                    $('#ad'+$(this).val()).prop("readonly",true);
                   var tem= $(this).val();
                   $.ajax({
                        type: "POST",
                        url: "php/canceledition.php",
                        data    : {name: $(this).attr('name')},
                        success: function(response){

                            var obj = JSON.parse(response);
                               $.each(obj,function(index,flower){
                                if(flower['description']!=null){

                                  $('textarea.form-control.'+tem).val(flower['description']);
                                  $('#ad'+$(this).val()).val(flower['location']);
                                }
                               });
                        }
                      });
                    document.getElementsByClassName('btn btn-default btn-lg '+"su "+$(this).val())[0].style.display='none';
                              document.getElementsByClassName('btn btn-default btn-lg '+"ca "+$(this).val())[0].style.display = 'none';

          });

             $(document).on("click","button[id='editbutton']", function(event){
                $(this).blur();
                    $('textarea.form-control.'+$(this).val()).prop("readonly",false);
                    $('#ad'+$(this).val()).prop("readonly",false);
                   document.getElementsByClassName('btn btn-default btn-lg '+"su "+$(this).val())[0].style.display='block';
                   document.getElementsByClassName('btn btn-default btn-lg '+"ca "+$(this).val())[0].style.display = 'block';

            });

               $(document).on("change","input[id='ima']", function(event){
                
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
                      // $("img#profileimg").animate({width: '300px',height: 'auto'});
                      var sr="<?php echo $_SESSION['id'] ?>";
                          $("img#profileimg").attr("src","user/"+sr+"."+file+"?t=" + new Date().getTime());
                          
                     }
              });  
            
            });
           
            
            
           $.ajax({
              type: "POST",
              url: "php/iprofileimage.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                
                //$("img#profileimg").animate({width: '300px',height: 'auto'});
                $("img#profileimg").attr("src",response+"?"+ new Date().getTime());

           }
         });


            $(document).on("change","select[id='sel1']", function(event){
                  $(this).blur();
                   $.ajax({
                        type: "POST",
                        url: "php/privacyProcess.php",
                        data    : {name: $(this).attr('name'),value: $(this).find('option:selected').val()},
                        success: function(response){

                        }
                      });

            });
            $(document).on("click","div[id='lid']", function(event){
              var value=$(this).attr('name');
              var ar = value.split(',');
              
              var srs="http://picast.azurewebsites.net/"+ar[0];
              var  whencast1= "<?php echo $_SESSION['whencast']; ?>"
                 $.ajax({
                          type: "POST",
                          async: false,
                          cache: false,
                          url: "https://api.whenhub.com/api/events/"+ar[1]+"/media?access_token="+whencast1,
                          data: {type: "image", url: srs, name: ar[2]},
                         success: function(response){
                            swal("Successful!", "Your image is copied to "+ar[3]+" album ", "success")
                         }
          });
            });
            $.ajax({
              type: "POST",
              url: "php/display.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...

                if(response!=null){
                
                 
                var obj = JSON.parse(response);
                var i=0;

               $.each(obj,function(index,flower){
                    
                    //Do things with things[i]
                    flag=true;
                    var sr=flower['image_id'];
                    var rsr=sr.replace(".","");
                    var user=flower['user_id'];
                    //console.log(things[i]);
                    var srs="upload/"+user+"/"+sr;
                    var priv=flower['privacy'];
                    var description=flower['description'];
                    storevalue=description;
                    var t=flower['time'];
                    var tim=t.split(' ');
                    var first;
                    var second;

                    
                    if(priv=='1'){
                      first="<option value='1'>private</option>";
                      second="<option value='2'>public</option>";
                    }
                    else{
                         first="<option value='2'>public</option>";
                        second="<option value='1'>private</option>";
                    }
                 // console.log(ib);
                 var shareurl='<?php echo "https://picast.azurewebsites.net/share.php?link=" ?>'+"<?php echo '\''.urlencode(base64_encode($_SESSION['id'])).'\''?>"+"&value='"+sr+"'";

                 var value="";
                 if(i%3==2)
                  value+='<div class="row">';
                 value+='<div class=" col-md-4" id="dl'+rsr+'" style=" padding-bottom=0; margin-top: 2px" ><div class="ima" data-googleplus-share-url="'+shareurl+'" data-facebook-share-url="'+shareurl+'" data-pinterest-share-url= data-pinterest-text= data-tweet-text="'+shareurl+'" data-pinterest-share-url="'+shareurl+'" data-src='+srs+' data-sub-html="<p> '+description+' </p>"><img class="full" src='+srs+'></div><div class="well" style="margin-bottom: 0px" ><div><span>'+tim[0]+'<span> </div><div class="btn-group"> <button id="downloadbutton" type="button" name="'+user+'"value="'+sr+'" class="btn btn-default btn-lg"><span class="  glyphicon glyphicon-download-alt"></span></button> <button id="deletebutton" type="deletebutton" name="'+sr+'" value="'+rsr+'" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-trash"></span> </button>'; 

                    value+= '<label for="sel1"></label><select style="font-size=10;" id="sel1" class="btn btn-default btn-lg" name='+sr+'>'+first+second+' </select> ';

                    value+='<a class="dropdown"><button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-share"></span> <span class="caret"></span></button><ul class="dropdown-menu" id="dp'+rsr+'" ></ul></a>';
                 value+= '<button id="editbutton" type="button" value="'+rsr+'" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-pencil"></span></button></div>';
                

                 value+= '<div class="btn-form"> <label for="comment"> </label> <textarea readonly class="form-control '+rsr+'"id="comment" placeholder="Caption..." >'+description+'</textarea> ';

                 value+='<input type="search" readonly class="form-control" id="ad'+rsr+'" placeholder="Location..." />';

                 value+='<div class="btn-group pull-right"> <button id="submitbutton" type="button" style="display: none;" name="'+sr+'" value="'+rsr+'" class="btn btn-default btn-lg '+"su "+rsr+'"><span class="glyphicon glyphicon-ok"></span></button> ';

                 value+= '<button id="cancelbutton" type="button" style="display: none;" name="'+sr+'" value="'+rsr+'" class="btn btn-default btn-lg '+"ca "+rsr+'"><span class="glyphicon glyphicon-remove"></span></button></div> </div></div></div>';

            if(i%3==2)
                value+='</div>';
              i=(i+1)%3;

                 $("#lightgallery").append(value);
                 var placesAutocomplete = places({
                    container: document.querySelector('#ad'+rsr)
                  });

                 $('#ad'+rsr).val(flower['location']);
                 $.ajax({
                  type: "POST",
                  url: "php/getalbum.php",
                  success: function(response){
                    if(response!=null){
                    var obj = JSON.parse(response);

                     $.each(obj,function(index,flower){
                        $('#dp'+rsr).append('<li><div id="lid" name="'+srs+','+flower['whenmodel']+','+description+','+flower['album_name']+'">'+flower['album_name']+'</div></li>');
                      });
                   }
                 }

                 });
                 
                
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
         
        });
        
        function aboutedit(){
         
                    $('.aboutt').prop("readonly",false);
                    $('#aboutb').css('display','none');
                   $('#submitabutton').css('display','block');
                 $('#cancelabutton').css('display','block');
        }
        function ccancel(){
           $('.aboutt').prop("readonly",true);
                   
                   $.ajax({
                        type: "POST",
                        url: "php/acancel.php",
                        
                        success: function(response){
                            
                            var obj = JSON.parse(response);
                               $.each(obj,function(index,flower){
                                

                                  $('.aboutt').val(flower['about']);
                               
                               });
                        }
                      });
                    $('#aboutb').css('display','block');
                   $('#submitabutton').css('display','none');
                 $('#cancelabutton').css('display','none');
                  
        }
        function asumbit(){
         $('.aboutt').prop("readonly",true);
                   $.ajax({
                        type: "POST",
                        url: "php/asubmit.php",
                        data    : {name: $('.aboutt').val()},
                        success: function(response){
                            
                        }
                      });
                   $('#aboutb').css('display','block');
                   $('#submitabutton').css('display','none');
                 $('#cancelabutton').css('display','none');
                  
        }
         
        </script>


        
        <link rel="stylesheet" type="text/css" href="dist/dropzone.css" />
        <link rel="stylesheet" type="text/css" href="css/up3.css" />
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
   <h1>My gallery</h1>



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
          <li><button id="myBtn" role="button" type="uploadbutton" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-upload"></span>Upload</button></li>

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
    <form action="php/uploadProcess.php" class="dropzone">
    <div class="dz-message" data-dz-message><span>Click or Drop files here to upload</span></div>
    </form>

  </div>

</div>



<script type="text/javascript" src="js/up.js"></script>



<div style="margin-top:50px; ">

<div class="container-fluid">

   <div class="col-sm-2" >
      <div  style="padding: 0px">
      <img id="profileimg" src="" style="padding: 0px" class="img-square img-thumbnail"  width="100%" height="auto">
      <div class="well">
      <?php echo $_SESSION['username']; ?>
      <div ><textarea class="aboutt" readonly placeholder="About me..." ></textarea> 
       <button id="aboutb" style="display: block" type="button" onclick="aboutedit()" class="btn btn-default btn-lg pull-right"><span class="glyphicon glyphicon-pencil"></span></button>

      <div class="btn-group pull-right"> <button onclick="asumbit()" id="submitabutton" type="button" style="display: none;" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span></button> 

      <button id="cancelabutton" type="button" onclick="ccancel()" style="display: none;" class="btn btn-default btn-lg "><span class="glyphicon glyphicon-remove"></span></button></div> </div>
      </div>
      </div>

   
     <label class="btn btn-default btn-file btn-lg">
    Change Photo <div id="pclear"> <input type="file" id="ima" style="display: none;"> </div>
    </label>
    
    
      <button id="editbutton" type="button" style="" name="" value="" class="btn btn-default btn-lg">Change Password </button>
      <a id="followerbutton" href="follower.php" class="btn btn-default btn-lg">Follower <span id="bafollr" class="badge"></span></a>
      <a id="followingbutton" href="following.php" class="btn btn-default btn-lg">Following <span id="bafollg" class="badge"></span> </a>
    
    </div>
    <div id="lightgallery" class="col-sm-9 col-sm-offset-1">

    </div>
    </div>
    </div>
</section>
<!-- FOOTER -->   

</body>
</html>