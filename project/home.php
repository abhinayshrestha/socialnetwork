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
               $notification=mysql_result($result,0,'notifi');
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
    <title>KccConnection- News Feed</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.2">
      <link rel="icon" href="webimages/icon.png">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/home.css">
      <link rel="stylesheet" href="css/jquery.datetimepicker.css">
	<script src="js/jquery.js"></script>
	<script src="js/ajaxfileupload.js"></script>
       <script src="js/modernizr.js"></script>
      <script src="js/jquery.datetimepicker.js"></script>
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
     <div id="whitebody"></div><img src="" id="whitebodyimg" align="center">
      <form id="eventform">
	    <table border="0px">
            <h3>Event Uploader</h3>
            <hr size="1px" color="#ccc">
		<tr><td>Event Name : </td><td><input type="text" id="topic" class='text' placeholder="eg: Blood Donation Program" maxlength="30"/>
            <br><span id='topicerror' style="display:none">*Please Enter Some Heading*</span></td></tr>
	   <tr><td>Event Date : </td><td><input id="date"/>
           <br><span id='dateerror' style="display:none">*Please Enter UpComming Date*</span></td></tr>
	   <tr><td>Event Description : </td><td><textarea id="description" maxlength="100"></textarea>
           <br><span id='descerror' style="display:none">*Please Enter Some Description*</span></td></tr>
	   <!--<tr><td colspan="2"><center><hr size="1"><button id="eventsubmit">Post</button></center></td></tr>
	   <tr><td colspan="2"><center><font size="6" color="red" style="display:none">Event Added Successfully</font></center></td>
	   </tr>-->
	   </table>
           <hr size="1px" color="#ccc">
           <button id="eventsubmit">Post</button>
           <button id="cancelsubmit">Cancel</button>
	</form>
    <header>
	<ul>
        <li><a href="home.php" id="logo" title="kccConnection.com"> < KccConnection /></a></li>
        <li><input type="text" id="searchinput" placeholder="find friends" maxlength="30"><div class="searchresult">
            <!--<a href="#">
            <div class="simgcover listcontainer">
                <img src="a.jpg">
            </div>
                <div class="listcontainer detail"><span><b>Abhinay shrestha </b> [B.E Computer - V]</span></div>
            </a><br><hr style="margin:1px;" size="1px" color="#ccc">
            --></div>
	   <button id="search"><i class="fa fa-search"></i></button></li>    
	   <li class="left"><a id="home" href="home.php" title="Home"><i class="fa fa-home"></i></a></li>
	   <li class="left"><a href="profile.php" title="Profile"><i class="fa fa-user"></i></a></li>
	   <li class="left"><a href="message.php" title="Message"><i class="fa fa-envelope"><div id="mred" class="red">10</div></i></a></li>
        <li class="left" id="notification">
            <a title="Notification"><i class="fa fa-bell"><div id="nred" class="red"></div></i></a>
            <div id="notifi-panel">
                
              <!--  <div class="notifi-list">
                    <div class="notifi-imagecover"><img src="a.jpg"></div><p> <b>Abhinay Shrestha</b> commented on your post</p>
                </div>-->
            </div>
        </li>
	   <li class="left"><a href="log_out.php" title="Log out"><i class="fa fa-power-off"></i></a></li>     
	</ul>
   </header> 
	<div class="left-container">
            <div class="top">
              <div class="imgcover">
                  <img src="<?php echo $profile?>" id="profileimg">
              </div>
              <div class="pabout"><h3><?php echo $name?></h3> 
                  <hr> ID : <?php echo $id?><hr>Faculty : <?php echo $faculty?><hr>
                  Semester: <?php echo $semester?><hr> Gender : <?php echo $gender?>
              </div>
            </div>
        </div>
      <div class="center">
      <div id="news-feed">
	      <div id="statusdiv">
              <div class="statusdivhead"><i class="fa fa-edit"></i> &nbspShare Your Thoughts</div>
	         <textarea id="status" type="text" placeholder="What's on your mind?" maxlength="95"></textarea><input type="button" value="Share" id="post" name="post">
              <button class='photoupload' id="uploader" title="Add your photo to newsfeed" onclick='$("#photoupload").click();'><i class="fa fa-camera"></i>
				&nbspAdd photos</button>
              	   <button class='addevents' title="Go to Event panel to view" id="addevent">
			  <i class="fa fa-calendar"></i>&nbsp Add Events</button> 
			 <progress id="prog" max="100" value="0"></progress>
              <div id="uploadForm"></div>
			   <form method="POST" action="posting_photo.php" id="upload" enctype="multipart/form-data">
			   
                   <input type="file" id="photoupload" name="file" accept="image/*">
                <input type="text" id="aboutimage" name="about" placeholder="About Pic....." maxlength="50">
				<input type="submit" name="submitpic" id="submitpic" value="Post" >
				</form>
          </div></div>
            <div class="post">
                <!--<div class="infiniteimage">
                <div class="imageboxtop">
                    <div class="img-logo"><img src="a.jpg"></div> <b>Abhinay Shrestha</b> <span>added a photo</span><date>2014-01-30</date>
                </div>
                <hr color="#ccc" style="margin: 0px" size="1px">
                <div class="aboutimage">Mount Everest.......
                </div>
                <div class="scrollimagecover">
                    <img src="a.jpg">
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
                    <div class="statusboxtop"><div class="img-logo"><img src="a.jpg"></div>
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
                </div> 
            </div>  -->  
        </div>
	    <img src='webimages/loader.gif'  id="loader">
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
             }
            else{
            echo "<div style='margin:10px; text-align:center; color:#aaa'>No Connection !!!<div>";
            }
           ?>
           
	   </div>
	  </div>
	 <script>
        timestamp=null; 
	    var start=0;
        var notifiStart=0;
		var reachedMax=false;
		$(document).ready(function(){
			 getData();  //loading data for the first time in newsfeed
             polling();
			var assignment= '<?php echo $assignment;?>';
			var event='<?php echo $event?>';
			var notice='<?php echo $notice?>';
            var notification = '<?php echo $notification?>';
			var assignmentcount=Number(assignment);
			var eventcount=Number(event);
			var noticecount=Number(notice);
            var notificationcount=Number(notification)
			if(assignmentcount!=0){
				$('#ared').html(assignmentcount).show();
			}
			if(eventcount!=0){
				$('#eventred').html(eventcount).show();
			}
			if(noticecount!=0){
			    $('#noticered').html(noticecount).show();
			}
            if(notificationcount!=0){
			    $('#nred').html(notificationcount).show();
			}
            var dateObject = pikadayResponsive(document.getElementById("date"));
			$('.post').on('click','img',function(e){
				e.preventDefault();
				var src=$(this).attr('src');
				$('#whitebody').show();
				$('#whitebodyimg').attr('src',src).show();
			});
			$('#whitebody').click(function(){
				$(this).hide();
				$('#whitebodyimg').hide();
			});
             $('#addevent').click(function(){
                 $('#whitebody').show();
                 $('#eventform').show(0,function(){
                     $('#topic').focus();
                 });
                 $('#whitebody').click(function(){
                     $(this).hide(0,function(){
                         $('#eventform').hide();
                     });
                 });
             });
            $('#cancelsubmit').click(function(e){
                e.preventDefault();
                $('#eventform').fadeOut(200,function(){
                   $('#whitebody').hide(); 
                });
            });
            $('#eventsubmit').click(function(e){
			   e.preventDefault();
			   var dateReg=/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
			   var date=$('#date').val();
			   var heading=$('#topic').val();
			   var description=$('#description').val();
			   if(dateReg.test(date) && heading.length>3 && description.length>5){
				   var month=date.slice(date.indexOf('-')+1,date.lastIndexOf('-'));
				   var day=date.slice(date.lastIndexOf('-')+1);
                   postEvent(date,month,day,heading,description);      				   
			   }
			   else{
				   if(!dateReg.test(date)){
					   $('#dateerror').fadeIn(200);
				   }
				   if($('#topic').val().length<3){
					   $('#topicerror').fadeIn(200);
				   } 
				   if($('#description').val().length<5){
					   $('#descerror').fadeIn(200);
				   } 				   
			   }
			});
			$('#topic').focus(function(){$('#topicerror').fadeOut(200)});
			$('#date').change(function(){$('#dateerror').fadeOut(200)});
			$('#description').focus(function(){$('#descerror').fadeOut(200)});
			 $('#uploader').on('click',function(e){
                  e.preventDefault();
				  return false;
   			 }); 
			 $('#post').click(function(){
				 postData();
			 });
			 $('#photoupload').change(function(){
				 filePreview(this);
				 $('#submitpic , #aboutimage').show(400);
                 $('#aboutimage').focus();
			 });
		   $('#upload').on('submit',function(e){
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
					  $('#prog').fadeOut(500);
					  location.reload();
				   }
                  else{
					 alert('size must be less than 5 MB'); 
				  } 				   
			     }
		       });
	        });
            $('.post').on('click','.showcomment',function(){
                 var a=parseInt($(this).text());
                if(a>1){
                    var pid=$(this).parent().siblings('.postcommentnav').children('.postcomment').attr('id');
                    $(this).parent().children('.hidecomment').show();
                    loadComment(pid);
                }
            });
            $('.post').on('click','.hidecomment',function(){
               $(this).parent().siblings('.commentblock').children('div').slideUp(200);
                $(this).slideUp(200);
            });
            $('.post').on('click','.postcomment',function(){
                    var comment=$(this).parent().children('.commentvalue').val();
                    var commentedOn= $(this).attr('class').slice($(this).attr('class').indexOf(" ")+1);
                    if(comment.length>0){
                        var a=$(this).parent().siblings('.commentnav').children('.showcomment');
                        var cid=$(this).attr('id');
                        var commentcount=parseInt(a.text());
                        var value=a.html();
                        var newValue=value.replace(commentcount,commentcount+1);
                        a.html(newValue);
                        postComment(comment,cid,commentcount,commentedOn); 
                        $(this).parent().siblings('.commentblock').append('<div class="comment"><b><?php echo $name." "?></b>'+comment+'</div');
                        $(this).parent().children('.commentvalue').val('');
                    }
                });
            $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
            $('#notification').click(function(){
                $('#nred').hide();
                notifiStart=0;
                getNotifi();
                $('#notifi-panel').toggle(0,function(){
                    var color=$('.fa-bell').css('color');
                    if(color=='rgb(0, 0, 139)'){
                        $('.fa-bell').css('color','#fff'); 
                    }
                    else{
                        $('.fa-bell').css('color','rgb(0, 0, 139)');
                    }
                });
            });
            $('#notifi-panel').scroll(function(){
                if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight){
                    notifiStart+=10;
                    loadNotifi();
                }
                
            });
          
        });
		    function filePreview(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                      $('#uploadForm + img').remove();
                      $('#uploadForm').after('<img src="'+e.target.result+'" class="preview"/>');
                      }
                     reader.readAsDataURL(input.files[0]);
                      }
            }
			$(window).scroll(function(){	
				if($(window).scrollTop()+672>=$(document).height()){
					 $('#loader').show();
					start += 3;
				   getData();
				}	
			});	
      	     function getData(){
                $.ajax({
                 url : "infinite_newsfeed.php",
                 method : "POST",
                 dataType : "text",
                 data : {
                    getData : 1,
                     start : start
                 },
                success : function(data){
                     $('.post').append(data);
                }    
              });
            }
		   function postData()  // ajax for posting status
		   { 
			var status= $('#status').val();
			$('#status').val('');
			var postValue=1;
			if(status.length>0){
			 $.ajax({
			    url : 'infinite_newsfeed.php',
			    method : 'POST',
			    dataType : 'text',
			    data : {
					status : status,
					postValue : 1
				},
			    success : function(response){
				 	location.reload();
			  }
			});
		   }
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
            function postComment(comment,cid,commentCount,commentedOn){
                $.ajax({
                    url : "dynamic_page_loader.php",
                    method : "GET",
                    dataType : "text",
                    data : {
                        postComment : 1,
                        comment : comment,
                        cid : cid,
                        commentCount: commentCount,
                        commentedOn : commentedOn
                    },
                    success : function(data){
                        //alert(data);
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
         function postEvent(date,month,day,heading,description){
			$.ajax({
				url : "infinite_newsfeed.php",
				method : "POST",
				dataType : "text",
				data : {
					eventValue : 1,
					date : date,
					month : month,
					day : day,
					heading : heading,
					description : description
				},
				success : function(data){
					if(data=='success'){
                        $('#eventform').html('<span style="color:green; margin-left:230px;line-height:320px;">Success <i class="fa fa-check"></i></span>');
                            $('#eventform').delay(800).fadeOut(100,function(){
                                $('#ewhitebody').hide();
                                window.location.reload();
                            }); 
					}
					else{
						$('#dateerror').fadeIn(200);
					}
				}
			});
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
                if(json['notification']>0){
                    $('#nred').html(json['notification']).show();
                }  
             timestamp =json["timestamp"];
             setTimeout("polling()",1000);
         }, 
      error: function(XMLHttpRequest,textStatus,errorThrown) {
         setTimeout("polling()",1000);
      }
      });
         }
     function getNotifi(){
         $.ajax({
             url : "dynamic_page_loader.php",
             method : "POST",
             dataType : "text",
             data : {
                 getNotifi : 1,
                 notifiStart : notifiStart
             },
             success : function(data){
                 $('#notifi-panel').html(data);
             }
        });
     } 
     function loadNotifi(){
        $.ajax({
             url : "dynamic_page_loader.php",
             method : "POST",
             dataType : "text",
             data : {
                 loadNotifi : 1,
                 notifiStart : notifiStart
             },
             success : function(data){
                 $('#notifi-panel').append(data);
             }
        });
     }     
 </script>
  </body>
</html>