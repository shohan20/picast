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
<script src="https://cdn.jsdelivr.net/places.js/1/places.min.js"></script>
      <!--[if lt IE 9]>
	      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]--> 

        <script>
          var  whencast= "<?php echo $_SESSION['whencast']; ?>"
          var cast_id="<?php echo $_SESSION['cast_id']; ?>" 
          var gallery = lightGallery(document.getElementById('lightgallery'),{
            selector: '.ima'
          }); 
          var storevalue;

          $(document).ready(function(){


            ccancel();
            var username= "<?php echo $_SESSION['username']; ?>"
            $.ajax({
                        type: "POST",
                        async: false,
                        url: "php/access.php",
                        success: function(response){
                          if(response<=0){
                            swal({
                                      title: "Access_token of Whencast!",
                                      text: '<a href="#" style="color: blue">How to get whencast access_token?</a>',
                                      type: "input",
                                      showCancelButton: true,
                                      closeOnConfirm: false,
                                      html: true,
                                      animation: "slide-from-top",
                                      inputPlaceholder: "access_token"
                                    },

                                    function(inputValue){
                                      if (inputValue === false) return false;
                                      $.ajax({
                                          type: "GET",
                                          url: "https://api.whenhub.com/api/users/me",
                                          data: {access_token: inputValue},
                                          success: function(response){

                  $.ajax({
                  type: "POST",
                 
                  url: "https://api.whenhub.com/api/users/me/schedules?access_token="+inputValue,
                  data: {name: 'picast-Album',scope: 'public'},
                  success: function(response){
                    var cast_st=JSON.stringify(response);
                    var cast_val= JSON.parse(cast_st);
                      whencast= inputValue;
                      cast_id= cast_val['id'];
                      $.ajax({
                                          type: "POST",
                                         
                                          url: "php/uploadaccess.php",
                                          data: {whencast: inputValue,cast_id: cast_val['id']},
                                          success: function(response){
                                            
                                            albums();
                                          
              swal({
                    title: "Nice",
                    text: "Your info is updated!",
                    type: "info",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                  },
                  function(){
                    setTimeout(function(){
                      window.location.href="album.php";
                    }, 2000);
                  });
                                          }
                                        });
                  }});

                          
                                            
                                            },
                                            error: function (request, status, error) {
                                            
                                            swal.showInputError("Invalid access_token!");
                                            return false
                                          
                                          }
                                      });

                                     
                                    });
                          }

                          else{

                              albums();

                          }


                        }
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

           
            /*
              var data = JSON.stringify(false);

              var xhr = new XMLHttpRequest();
              xhr.withCredentials = true;


              xhr.addEventListener("readystatechange", function () {
                if (this.readyState === this.DONE) {
                  console.log(xhr.status);
                    console.log(xhr.statusText);
                  console.log(this.responseText);
                }
              });

              xhr.open("POST", "https://api.whenhub.com/api/schedules/590262c530135b37fcc0d621/events?access_token=fV5BBlAnAq2lsfmcRStZWmqbpCr3FJhyeWpBpxobHj56U7rZNdXBKKJp4e191nd5&name=dfjk");

              xhr.send(data);

         */
       
         function albums(){


                 
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
                var priv,first,second;
                 $.each(obj['events'],function(index,flower){

                  var id=flower['id'];
                  
                  $.ajax({
                        type: "POST",
                        async: false,
                        url: "php/whenalbum.php",
                        data    : {whenmodel: id},
                        success: function(response){
                           priv=response;

                        }
                      });
                  
                   if(priv=='1'){
                      
                      first="<option value='1'>private</option>";
                      second="<option value='2'>public</option>";
                    }
                  else{
                         first="<option value='2'>public</option>";
                        second="<option value='1'>private</option>";
                    }

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
                 
                  value+='<div class="row well" id="u'+id+'" style="margin-bottom: 5px">';
                 value+='<div class="imag col-md-3" style="margin-right: 10px"  ><a href="viewalbum.php?id='+id+'"> <img class="full  img-thumbnail" id="i'+id+'" src="'+url+'" > </a></div> <div style=" margin-left: 5px">'+tim[0]+'<br>'+nphoto+' photos <br>';
                 value+='<button id="deletebutton" name="'+id+'" type="deletebutton" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-trash"></span> </button>'; 

                 value+= '<button id="editbutton" name="'+id+'" type="button"  class="btn btn-default btn-lg"><span class="glyphicon glyphicon-pencil"></span></button>'; 

                 value+='<button class="btn btn-default btn-lg" name="'+id+'" id="nextbutton" ><span class="glyphicon glyphicon-new-window"></span> </button>';
                 value+= '<label for="sel1"></label><select class="btn btn-default btn-lg" style="font-size=14;" id="sel1"  name='+id+'>'+first+second+'</select>'; 

                 value+= '<div> <textarea class="form-control" readonly id="a'+id+'" placeholder="Album Name..">'+name+'</textarea> <textarea class="form-control" readonly id="c'+id+'" placeholder="Caption..." >'+description+'</textarea> </div>';

                  value+='<input type="search" readonly class="form-control" id="ad'+id+'" placeholder="Location..." />';

                 value+='<div class="btn-group pull-right"> <button id="submitbutton" type="button" style="display: none;" name="'+id+'" class="btn btn-default btn-lg e'+id+'"><span class="glyphicon glyphicon-ok"></span></button> ';

                 value+= '<button id="cancelbutton" type="button" style="display: none;" name="'+id+'" class="btn btn-default btn-lg r'+id+'"><span class="glyphicon glyphicon-remove"></span></button></div></div>';
                 
                        value+='</div>';
                          
                          index=(index+1)%3;
                          $('#light').append(value);
                          
                 var placesAutocomplete = places({
                    container: document.querySelector('#ad'+id)
                  });
                 $('#ad'+id).val(local);
                      
                 });
                
             }
           }

         });

         }
               if(username!=""){
                  var srlog= '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" style="background-color: Transparent; border: none;" type="button" data-toggle="dropdown">'+username+"  "+'<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="php/signout.php">Signout</a></li></ul></div>';
                  $('div#logg').html(srlog);
                    var bari='<a class="navbar-brand" href="gallery.php">My-Gallery</a><a class="navbar-brand" style="color: dodgerblue" href="#">My-Whenhub-Album</a>';
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

            $(document).on("click","button[id='deletebutton']", function(event){
                 $(this).blur();
                
                var al=$(this).attr('name');
                
                      $.ajax({
                          type: "delete",
                          async: false,
                          url: "https://api.whenhub.com/api/events/"+al+"?access_token="+whencast,
                         
                         success: function(response){
                                $.ajax({
                                    type: "POST",
                                    data: {src: al},
                                    url: "php/deletev.php",
                                  success: function(response){

                                          }
                                  });
                         }
                  });
  
                    
                  $('#u'+al).remove();
            });

   

             $(document).on("click","button[id='submitbutton']", function(event){
                $(this).blur();
                 var vl=$(this).attr('name');
                   $('#c'+vl).prop("readonly",true);
                   $('#a'+vl).prop("readonly",true);
                   $('#ad'+vl).prop("readonly",true);
                    var tem=$('#ad'+vl).val();

                  $.ajax({
                          type: "put",
                          async: false,
                          url: "https://api.whenhub.com/api/schedules/"+cast_id+"/events/"+vl+"?access_token="+whencast,
                          data: {name: $('#a'+vl).val(),description: $('#c'+vl).val(),location: {name: tem}},
                         success: function(response){
                        $.ajax({
                          type: "POST",
                          url: "php/updatemodel.php",
                          data: {name: $('#a'+vl).val(),whenmodel: vl},
                          success: function(response){

                          }
                         });
                      }
                       });
                     document.getElementsByClassName("btn btn-default btn-lg e"+vl)[0].style.display ='none';
                      document.getElementsByClassName("btn btn-default btn-lg r"+vl)[0].style.display = 'none';
            });


       $(document).on("click","button[id='cancelbutton']", function(event){
                var vl=$(this).attr('name');
                 
                   $('#c'+vl).prop("readonly",true);
                    $('#a'+vl).prop("readonly",true);
                    $('#ad'+vl).prop("readonly",true);
                  $.ajax({
                          type: "get",
                          async: false,
                          url: "https://api.whenhub.com/api/schedules/"+cast_id+"/events/"+vl+"?access_token="+whencast,
                          
                         success: function(response){
                                $('#a'+vl).val(response['name']);
                                $('#c'+vl).val(response['description']);
                                $('#ad'+vl).val(response['location']['name']);
                          }
                         
                       });
                     document.getElementsByClassName("btn btn-default btn-lg e"+vl)[0].style.display ='none';
                      document.getElementsByClassName("btn btn-default btn-lg r"+vl)[0].style.display = 'none';

          });

             $(document).on("click","button[id='editbutton']", function(event){
                $(this).blur();
                var vl=$(this).attr('name');
              
                    $('#c'+vl).prop("readonly",false);
                    $('#a'+vl).prop("readonly",false);
                    $('#ad'+vl).prop("readonly",false);
                   document.getElementsByClassName("btn btn-default btn-lg e"+vl)[0].style.display='block';
                   document.getElementsByClassName("btn btn-default btn-lg r"+vl)[0].style.display = 'block';   

            });


            $(document).on("change","select[id='sel1']", function(event){
                  $(this).blur();
                   $.ajax({
                        type: "POST",
                        url: "php/whenprivacy.php",
                        data    : {name: $(this).attr('name'),value: $(this).find('option:selected').val()},
                        success: function(response){

                        }
                      });

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
          
      $(document).on("click","button[id='nextbutton']", function(event){
        var i=$(this).attr('name');
      var win = window.open('viewalbum.php?id='+i, '_blank');
        win.focus();
      //window.location.replace();
   });
        function clickcreate(){
          var  whencast1= "<?php  echo $_SESSION['whencast']; ?>"
          var cast_id1="<?php echo $_SESSION['cast_id']; ?>"
           
                            swal({
                                      title: "Create Album!",
                                      text: 'Choose a name for Album',
                                      type: "input",
                                      showCancelButton: true,
                                      closeOnConfirm: false,
                                      html: true,
                                      animation: "slide-from-top",
                                      inputPlaceholder: "Album name"
                                    },

                                    function(inputValue){
                                      if (inputValue === false) return false;
                                      if(inputValue==""){
                                         swal.showInputError("Cann't be empty!");
                                            return false
                                      }

                                      var today = new Date();
                              var dd = today.getDate();
                              var mm = today.getMonth()+1; //January is 0!
                              var yyyy = today.getFullYear();
                                           $.ajax({
                                                type: "POST",
                                                url: "https://api.whenhub.com/api/schedules/"+cast_id1+"/events?access_token="+whencast1,
                                                data: {name: inputValue, when: {period:"day",startDate:yyyy+'-'+mm+'-'+dd},location:{name: ''}},
                                                success: function(response){
                                                 

                                              var cast_st=JSON.stringify(response);
                                            
                                              var cast_val= JSON.parse(cast_st);
                                              var eventid=cast_val['id'];


                   $.ajax({
                        type: "POST",
                        url: "php/whenalbum.php",
                        data    : {whenmodel: eventid,name: inputValue},
                        success: function(response){
                           
                        }
                      });


                                            swal("Nice!", "Your Album " + inputValue+" has been created succesfully", "success");

                                            window.location.replace("viewalbum.php?id="+eventid);
                                            
                                            },
                                            error: function (request, status, error) {
                                            
                                            swal.showInputError("Try with different name!");
                                            return false
                                          
                                          }
                                      });

                                     
                                    });
                          

        }

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
   <h1 >My Whenhub Album</h1>



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
          <li><button id="calbum" role="button" type="uploadbutton" class="btn btn-default btn-lg" onclick="clickcreate()"><span class="glyphicon glyphicon-plus"></span> Create Album</button></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
 </div>
</div>
<!--<button id="myBtn" >upload</button> -->



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
    <div id="light" class="col-sm-9 col-sm-offset-1">

    </div>
    </div>
    </div>
</section>
<!-- FOOTER -->   

</body>
</html>