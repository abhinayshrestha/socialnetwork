<?php
  session_start();
  if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
      header('Location: index.php');
  }
  else{
	  require "database_connect.php"; 
	  $query="select * from students_info where uid='".mysql_real_escape_string($_SESSION['id'])."'";
	  if($result=mysql_query($query)){
		  if(mysql_num_rows($result)>0){
		       $name=mysql_result($result,0,'name');
			   $id=mysql_result($result,0,'uid');
			   $gender=mysql_result($result,0,'gender');
			   $faculty=mysql_result($result,0,'faculty');
			   $semester=mysql_result($result,0,'sem');
			   $profile=mysql_result($result,0,'profilepic');
			   $assignment=mysql_result($result,0,'assignment');
			   $event=mysql_result($result,0,'event');
			   $notice=mysql_result($result,0,'notice');
              $dob=mysql_result($result,0,'dob');
              $email=mysql_result($result,0,'email');
              $politicalview=mysql_result($result,0,'politicalview');
              $religion=mysql_result($result,0,'religion');
              $location=mysql_result($result,0,'location');
              $quote=mysql_result($result,0,'quote');
               $password=mysql_result($result,0,'password');
		  }
		  else{
		   session_destroy(); 
		    header('Location: index.php');
			echo "<script>alert('Server Error Please Login Later')</script>";
		  }
	  }
	  else{
		 session_destroy(); 
		 header('Location: index.php');
		 echo "<script>alert('Server Error Please Login Later')</script>";
	  }
  }
?>
<html>
 <head>
     <link rel="icon" href="webimages/icon.png">
     <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/profile.css">
      <link rel="stylesheet" href="css/jquery.datetimepicker.css">
     <script src="js/jquery.js"></script>
     <script src="js/ajaxfileupload.js"></script>
     <script src="js/jquery.datetimepicker.js"></script>
     <script src="js/modernizr.js"></script>
     <style>
	      body{
     font-family:arial;
     padding:0px;
	 margin:0px;
	 background:#ebeef4; 
         }
     </style>
    </head>
    <body>
        <div id="whitebody"></div><img src="" id="whitebodyimg">
        <div id="editinfo">
            <div class="formheader"><i class="fa fa-edit"></i> &nbspEdit Info</div>
            <hr color="#ccc" size="1" style="margin: 0">
            <table border="0px" cellspacing="10px">
                <tr><td>D.O.B</td><td><input id="date" value="<?php echo $dob?>"></td>
                    <td>Gender</td><td><input type="radio" name="gender" value="Male" <?php if($gender=='Male'){ echo "checked";}?> > Male<input type="radio" name="gender" value="Female" <?php if($gender=='Female'){ echo "checked";}?>> Female</td>
                </tr>
                <tr><td colspan="4"><hr color="#ccc" size="1" style="margin:0"></td></tr>
                <tr><td>Email</td><td><input type="text" value="<?php echo $email?>" id="email" maxlength="50"></td><td>Password</td><td><input type="password" maxlength="30" id="newpassword" value="<?php echo $password?>"></td></tr>
                <tr><td colspan="4"><hr color="#ccc" size="1" style="margin:0"></td></tr>
                <tr><td>Political View</td><td><input type="text" value="<?php echo $politicalview?>" id="politicalview" maxlength="30"></td><td>Religious View</td><td><input type="text" value="<?php echo $religion?>" id="religion" maxlength="30"></td></tr>
                <tr><td colspan="4"><hr color="#ccc" size="1" style="margin:0"></td></tr>
                <tr><td>Location</td><td><input type="text" value="<?php echo $location?>" id="location" maxlength="30"></td></tr>
                <tr><td colspan="4"><hr color="#ccc" size="1" style="margin:0"></td></tr>
                <tr>
                    <td>Favourite Quote</td>
                    <td><textarea id="fquote" maxlength="200"><?php echo $quote?></textarea></td>
                </tr>    
            </table>
            <div class="formfooter"><button id="save">Save</button><button id="cancel">Cancel</button></div>
            <div class="confirmpage">Your Password: <input type="password" id="password"><button id="submitpassword">Submit</button><button id="back" >Back</button><span class="errormsg">*Invalid Password*</span></div>
        </div>
        <header>
	<ul>
        <li><a href="home.php" id="logo" title="kccConnection.com"> < KccConnection /></a></li>
        <li><input type="text" id="searchinput" placeholder="find friends" maxlength="30"><div class="searchresult">
            <!--<a href="#">
            <div class="simgcover listcontainer">
                <img src="a.jpg">
            </div>
                <div class="listcontainer detail"><span><b>Abhinay shrestha </b> [B.E Computer - V]</span></div>
            </a><br><hr style="margin:1px;" size="1px" color="#ccc">-->
            </div>
	   <button id="search"><i class="fa fa-search"></i></button></li>    
	   <li id="home" class="left"><a  href="home.php" title="Home"><i class="fa fa-home"></i></a></li>
	   <li class="left"><a href="profile.php" title="Profile"><i class="fa fa-user"></i></a></li>
	   <li class="left"><a href="message.php" title="Message"><i class="fa fa-envelope"><div id="mred" class="red">10</div></i></a></li>
	   <li class="left"><a href="#" title="Notification"><i class="fa fa-bell"><div id="nred" class="red">10</div></i></a></li>
	   <li class="left"><a href="log_out.php" title="Log out"><i class="fa fa-power-off"></i></a></li>
	</ul>
   </header>
        <div class="left-container">
            <div class="top"><form id="changepic" method="post" action="profilepic_uploader.php"><input type="file" name="file" id=picupload><input type="submit" id="submitpic" value="Change" name="submit"></form><button id="tempchangepic" class="editbutton" title="Change Profile Pic" onclick="$('#picupload').click();"><i class="fa fa-edit"></i></button>
              <div class="imgcover">
                  <img src="<?php echo $profile?>" id="profileimg">
              </div>
                <div class="progress"><progress id="prog"></progress><i id="check" class="fa fa-check"></i></div>
              <div class="pabout"><h3><?php echo $name?></h3> <quote><?php if(strlen($quote)){echo '" '.$quote.' "';}else{ echo "";}?></quote>
              </div>
            </div>
            <div class="photos">
                <h4><i class="fa fa-camera-retro"></i> &nbsp;Photos</h4>
                <hr color="#ccc" size="1" style="margin: 0">
                <div class='album'>
                    <div class="cover">
                    <img src="webimages/userupload.png">
                    </div>    
                    <div class="albumtype">Uploads</div>
                </div>
                  <div class='album'>
                    <div class="cover">
                    <img src="<?php echo $profile?>">
                    </div>  
                    <div class="albumtype">Profile Picture</div>
                </div>
              </div>
        </div>
        <div class="center">
          <div class="heading">    
            My Profile
            </div>
            <div class="info">
                <h5>About Me <button id="edit" class="editbutton" title="Edit Your Personal Info">Edit Info <i class="fa fa-edit" id="editbutton"></i></button></h5><hr style="margin: 1" color="#ccc" size="1">
                <table border="0px" cellpadding="2px" cellspacing="2px;">
                    <tr><td>Name</td><td><?php echo $name?></td>
                        <td>Faculty</td><td><?php echo $faculty?></td></tr><tr><td colspan="4"><hr color="#ccc" style="margin: 0px" size="1px"></td></tr>
                    <tr><td>Gender</td><td><?php echo $gender?></td>
                    <td>Semester</td><td><?php echo $semester?></td></tr>
                    <tr><td colspan="4"><hr color="#ccc" style="margin: 0px" size="1px"></td></tr>
                    <tr><td>Date of Birth</td><td><?php echo $dob?></td>
                    <td>ID</td><td><?php echo $id?></td></tr>
                    <tr><td colspan="4"><hr color="#ccc" style="margin: 0px" size="1px"></td></tr>
                    <tr><td>Email</td><td style="color:#1280ce"><?php echo $email?></td>
                    <td>Political View</td><td><?php if(strlen($politicalview)>0){echo $politicalview; }else{ echo"-----"; }?></td></tr>
                    <tr><td colspan="4"><hr color="#ccc" style="margin: 0px" size="1px"></td></tr>
                    <tr><td>Religious View</td><td><?php if(strlen($religion)>0){echo $religion; }else{ echo"-----"; }?></td>
                    <td>Location</td><td><?php if(strlen($location)>0){echo $location; }else{ echo"-----"; }?></td></tr>
                </table>
            </div>
            <div class="post">
               <!-- <div class="infiniteimage">
                <div class="imageboxtop">
                    <div class="img-logo"><img src="a.jpg"></div>
                    <b>Abhinay Shrestha</b> <span>added a photo</span><date>2014-01-30</date>
                </div>
                <hr color="#ccc" style="margin: 0px" size="1px">
                <div class="aboutimage">Mount Everest.......
                </div>
                <div class="scrollimagecover">
                    <img src="d.jpg">
                </div>
                <div class="commentnav">
                    <button id="showcomment"><i class="fa fa-comment-o"> </i> 1 Comments <i class='fa fa-angle-double-down'></i></button><button id="hidecomment">Hide Comments <i class='fa fa-angle-double-up'></i></button>
                </div>
                <div class="commentblock">
                    <div class="comment"><b>Abhinay Shrestha</b> this is awsome</div>
                    <div class="comment"><b>Abhinay Shrestha</b> this is awsome</div>
                </div>
                <div class="postcommentnav">
                    <input type="text" class="commentvalue" placeholder="Comment.....">
                    <button class="postcomment" id="101">Comment</button>
                </div>
            </div>
                <div class="infinitestatus">
                    <div class="statusboxtop">
                        <div class="img-logo"><img src="a.jpg"></div>
                    <b>Abhinay Shrestha</b> <span>updated a status</span><date>2014-01-30</date>
                    </div>
                    <hr color="#ccc" style="margin: 0px" size="1px">
                    <div class="status">
                        This is a status post....
                    </div>
                    <div class="commentnav">
                    <button id="showcomment"><i class="fa fa-comment-o"> </i> 1 Comments <i class='fa fa-angle-double-down'></i></button><button id="hidecomment">Hide Comments <i class='fa fa-angle-double-up'></i></button>
                </div>
                <div class="commentblock">
                    <div class="comment"><b>Abhinay Shrestha</b> this is awsome</div>
                    <div class="comment"><b>Abhinay Shrestha</b> this is awsome</div>
                </div>
                <div class="postcommentnav">
                    <input type="text" class="commentvalue" placeholder="Comment.....">
                    <button class="postcomment" id="101">Comment</button>
                </div>
                </div>  -->  
            </div>    
        </div>
        <div class="right-container">
	   <div class="buttons"> 
	   <a role="button" href="assignment.php" class="info"><button id="assignment">Assignments<div id="ared" class="red"></div></button></a>
	   <a href="note.php" class="info"><button id="note">Notes</button></a>
	   <a href="event.php" class="info"><button id="event">Events<div id="eventred" class="red"></div></button></a>
	   <a href="questionbank.php" class="info"><button id="questionbank">QuestionBank</button></a>
	   <a href="notice.php" class="info"><button id="notice">Notices<div id="noticered" class="red"></div></button></a>
	    </div>
	   <div id="chat">
           <div class="top"><img src="./webimages/university-logo.png"></div><hr color="#ccc" size="1" style="margin:0">
           <?php
            $connected = @fsockopen("www.google.com", 80); 
            $notices = 0;           
            if ($connected){
                include 'simple_html_dom.php';
	            $websiteurl1='http://puexam.edu.np/index.php?obj=all_events&category=E';
	            $websiteurl2='http://puexam.edu.np/index.php?obj=all_events&category=R';
	            $html1=file_get_html($websiteurl1);
	            $html2=file_get_html($websiteurl2);
	            $arr=array();
	            foreach($html1->find('strong') as $a){
		           if (strpos($a, $faculty)) {
                       ++$notices;
                       echo '<div class="unotice"><a href="http://puexam.edu.np/index.php?obj=exam_schedules" target="_blank"><i class="fa fa-forward"></i> '.$a.'</a></div><hr color="#ccc" size="1" style="margin:0">';
		           }
    	        }
	           foreach($html2->find('strong') as $b){
		           if (strpos($b, $faculty) !== false) {
                       ++$notices;
                      echo '<div class="unotice"><a href="http://www.puexam.edu.np/results/results.php?action=view&type=student" target="_blank"><i class="fa fa-forward"></i>'.$b.'</a></div><hr color="#ccc" size="1" style="margin:0">';
		          }
	            }
                if($notices==0){
                    echo "<div style='margin:10px; text-align:center; color:#aaa'>No Notice For You !!!<div>";
                }
               fclose($connected);
             }else{
            echo "<div style='margin:10px; text-align:center; color:#aaa'>No Connection !!!<div>";
            }
           ?>
           
	   </div>
	  </div>
        <script>
            timestamp=null;
            var start=0; 
            $(document).ready(function(){   
            getData();
            polling();    
            var dateObject = pikadayResponsive(document.getElementById("date"));
            var assignment= '<?php echo $assignment;?>';
			var event='<?php echo $event?>';
			var notice='<?php echo $notice?>';
			var assignmentcount=Number(assignment);
			var eventcount=Number(event);
			var noticecount=Number(notice);
			if(assignmentcount!=0){
				$('#ared').html(assignmentcount).show();
			}
			if(eventcount!=0){
				$('#eventred').html(eventcount).show();
			}
			if(noticecount!=0){
				$('#noticered').html(noticecount).show();
			}
            $('.post').on('click','.showcomment',function(){
                 var a=parseInt($(this).text());
                if(a>1){
                    var pid=$(this).parent().siblings('.postcommentnav').children('.postcomment').attr('id');
                    $(this).parent().children('.hidecomment').show();
                    loadComment(pid);
                }
            });
                $('#edit').click(function(){
                   $('#whitebody').show(0,function(){
                       $('#editinfo').fadeIn(300);
                   });
                });
                $('#cancel').click(function(){
                    $('#editinfo').fadeOut(100,function(){
                                $('#whitebody').hide();
                    });
                });
                $('#back').click(function(){
                    $('.confirmpage').hide();
                    $('#editinfo table , #editinfo .formfooter').show();
                });
            $('.post').on('click','.hidecomment',function(){
               $(this).parent().siblings('.commentblock').children('div').slideUp(200);
                $(this).slideUp(200);
            });
                $('.post').on('click','.postcomment',function(){
                    var comment=$(this).parent().children('.commentvalue').val();
                    if(comment.length>0){
                        var a=$(this).parent().siblings('.commentnav').children('.showcomment');
                        var cid=$(this).attr('id');
                        var commentcount=parseInt(a.text());
                        var value=a.html();
                        var newValue=value.replace(commentcount,commentcount+1);
                        a.html(newValue);
                       postComment(comment,cid,commentcount); $(this).parent().siblings('.commentblock').append('<div class="comment"><b><?php echo $name." "?></b>'+comment+'</div');
                        $(this).parent().children('.commentvalue').val('');
                    }
                });
                $('.post').on('click','img',function(){
                    $('#whitebody').show();
                    var src=$(this).attr('src');
                    $('#whitebodyimg').attr('src',src).show();
                });
                $('#whitebody').click(function(){
                    $(this).hide(0,function(){
                        $('#whitebodyimg').hide();
                        $('#editinfo').hide();
                    });
                });
                $('#picupload').change(function(){
                    filePreview(this);
                    $('#submitpic').show();
                });
                $('#changepic').on('submit',function(e){
		        e.preventDefault();
		        $(this).ajaxSubmit({
			     beforeSend:function(){
				   $('#prog').show();
				   $('#prog').attr('value','0');
			      },
			     uploadProgress:function(event,position,total,percentComplete){
				    $('#prog').attr('value',percentComplete);
			     },
			      success:function(data){
				  if(data=='success'){
					  $('#check').show(function(){
								$('#prog').fadeOut(500,function(){
									$('#check').hide();
									location.reload();
								});
							});
                  }
                  if(data=='exterror'){
                     alert('File size must be less than 5MB and of .jpg,.png,.gif');     
                  }
                      if(data=='servererror'){
                          alert('Server Error Please Try Again Later');
                      }
			     }
		       });
	        });
                $('#save').click(function(){
                    var date=$('#date').val();
                    var email=$('#email').val();
                    var newpassword=$('#newpassword').val();
                    var politicalview=$('#politicalview').val();
                    var religion=$('#religion').val();
                    var location=$('#location').val();
                    var fquote=$('#fquote').val();
                    var gender=$('[type="radio"]:checked').val();
                    var dateerror=false;
                    var emailerror=false;
                    var newpassworderror=false;
                    var dateReg=/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
                    if(dateReg.test(date) && date.length>0){
                       dateerror=true;
                    }
                    emailReg=/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			       if(emailReg.test(email) && email.length>0){
			          emailerror=true;
			         }
                    var passwordReg=/(?=.*[0-9])/;
                    if(passwordReg.test(newpassword) && newpassword.length>0){
                        newpassworderror=true; 
                    }
                    if(dateerror==true && emailerror==true && newpassworderror==true){
                        $('#editinfo table , #editinfo .formfooter').hide();
                        $('.confirmpage').slideDown(200);
                        $('#password').focus();
                        $('#submitpassword').click(function(){
                            var password=$('#password').val();
                              if(password == '<?php echo $password?>')
                               {
                                  updateInfo(date,email,newpassword,politicalview,religion,location,fquote,gender);
                               }
                            else{
                                $('.errormsg').fadeIn(200);                   
                            }
                        });
                    }
                    else{
                        if(emailerror==false){
                            $('#email').css('border','1px solid red');
                        }
                         if(newpassworderror==false){
                            $('#newpassword').css('border','1px solid red');
                        }
                         if(dateerror==false){
                            $('#date').css('border','1px solid red');
                        }
                    }              
                });
                $('#password').focusin(function(){
                    $('.errormsg').fadeOut(200);
                });
                 $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
          });
             $(window).scroll(function(){	
				if($(window).scrollTop()+672>=$(document).height()){
					 $('#loader').show();
					start += 3;
				   getData();
				}	
			});
            function getData(){
                $.ajax({
                 url : "dynamic_page_loader.php",
                 method : "POST",
                 dataType : "text",
                 data : {
                    getData : 1,
                     start : start,
                    id: "<?php echo $id?>",
                    name: "<?php echo $name?>"
                 },
                success : function(data){
                    $('.post').append(data);
                }    
              });
            }
            function loadComment(pid){
                $.ajax({
                    url : 'dynamic_page_loader.php',
                    method : 'POST',
                    dataType : 'text',
                    data : {
                        loadComment : 1,
                        pid : pid
                    },
                    success : function(data){$('[id='+pid+']').parent().siblings('.commentblock').html(data);
                    }
                });
            }
            function postComment(comment,cid,commentCount){
                $.ajax({
                    url : "dynamic_page_loader.php",
                    method : "POST",
                    dataType : "text",
                    data : {
                        postComment : 1,
                        comment : comment,
                        cid : cid,
                        commentCount: commentCount
                    },
                    success : function(data){
                        //
                    }
                });
            } 
            function filePreview(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                          $('.left-container #profileimg').attr('src',e.target.result);
                      }
                     reader.readAsDataURL(input.files[0]);
                      }
            }
            function updateInfo(date,email,newpassword,politicalview,religion,location,fquote,gender){
                $.ajax({
                    url : 'dynamic_page_loader.php',
                    method : 'POST',
                    dataType : 'text',
                    data : {
                        updateInfo : 1,
                        date : date,
                        email :email,
                        newpassword : newpassword,
                        politicalview : politicalview,
                        religion : religion,
                        location : location,
                        fquote : fquote,
                        gender : gender
                    },
                    success : function(data){
                        if(data=='success'){
                            $('.confirmpage').html('<span style="color :green; margin-left:35%">Success <i class="fa fa-check"></i></span>');
                            $('#editinfo').delay(800).fadeOut(100,function(){
                                $('#whitebody').hide();
                                window.location.reload();
                            });
                        }
                        else{
                            $('.confirmpage').html('<span style="color :red; margin-left:35%">Server Error <i class="fa fa-times"></i></span>');
                            $('#editinfo').delay(1000).fadeOut(100,function(){
                                $('#whitebody').hide();
                                window.location.reload();
                            });
                        }
                    }
                });
            }
            function getSearchResult(){
             var name=$('#searchinput').val();
                 if(name != ''){
                     $.ajax({
                         url : "infinite_newsfeed.php",
                         method : "POST",
                         dataType : "text",
                         data : {
                             name :name,
                             searchResult : 1,
                             username : "<?php echo $name ?>"
                         },
                         success : function(data){
                             $('.searchresult').show(0,function(){
                                $(this).html(data); 
                             });
                         }
                     });
                 }
                else{
                    $('.searchresult').hide();
                }
           }
             function polling(){ 
              $.ajax({
              type: "GET",
              url: "polling_engine.php?timestamp="+timestamp,
              async: true,
              data : {id : '<?php echo $id;?>'}, 
              cache: false,
              timeout : 50000,
              success: function(data){
              var json=eval('('+data+ ')');
                if (json['assignment']>0) {
                   $('#ared').html(json['assignment']).show(); 
                }
                if (json['event']>0) {
                   $('#eventred').html(json['event']).show(); 
                }
                if (json['notice']>0) {
                   $('#noticered').html(json['notice']).show(); 
                }
             timestamp =json["timestamp"];
             setTimeout("polling()",1000);
         }, 
      error: function(XMLHttpRequest,textStatus,errorThrown) {
         setTimeout("polling()",1000);
      }
      });
         }
        </script>
    </body>
</html>