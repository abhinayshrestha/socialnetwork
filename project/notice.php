<?php
  session_start();
  if(isset($_SESSION['id']) and !empty($_SESSION['id']))
  {
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
			   $notice=mysql_result($result,0,'notice');
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
  else{
	 header('Location: index.php');
  }
?>
<html>
  <head>
     <title>KccConnection - Assignment</title>
      <link rel="icon" href="webimages/icon.png">
	 <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	 <link rel="stylesheet" href="css/template.css">
	 <link rel="stylesheet" href="css/notice.css">
	 <script src="js/jquery.js"></script>
	 <script src="js/ajaxfileupload.js"></script>
  </head>
  <style>
	      body{
     font-family:arial;
     padding:0px;
	 margin:0px;
	  background:#ebeef4; 
   }
</style>
<body>
     <div id="noticewhitebody"></div><form id="noticeform" method="post" enctype="multipart/form-data" action="notice_uploader.php">
    <h3>Notice uploader</h3>
     <hr style="margin:0" color="#ccc" size="1">
	    <table border="0px"><tr><td>Title:</td><td> <input type="text" name="title" id="title" placeholder="Notice Title" maxlength="30"><div class="searchresult">
            <!--<a href="#">
            <div class="simgcover listcontainer">
                <img src="a.jpg">
            </div>
                <div class="listcontainer detail"><span><b>Abhinay shrestha </b> [B.E Computer - V]</span></div>
            </a><br><hr style="margin:1px;" size="1px" color="#ccc">-->
            </div>
		       <br><span id="ntitleerror" class="error">*Title must be of atleast 6 character.</span>
		 </td></tr>
		<tr><td>Description:</td><td><textarea id="description"  name="description" maxlength="100"></textarea>
		         <br><span id="ndescriptionerror" class="error">*Description must be of atleast 6 character.</span>
		</td></tr>
		<tr><td align="center" colspan="2"><input type="file" style="display:none" name="file" id="noticeupload">
		<button id="tempnoticeupload" onclick='$("#noticeupload").click()'> Add Photo (optional)</button>
		<span id="nphotoerror" class="error">*Photo must be less than 5MB</span><br>
		</td></tr>
		<tr><td align="center" colspan="2" id="prev"><!--<img src="a.jpg" id="noticeimage">--></td></tr>
		<tr><td align="center" colspan="2"><progress id="nprog"></progress><i class="fa fa-check" id="check"></i></td></tr>
		</table>
        <hr style="margin:0" color="#ccc" size="1">
        <input type="submit" id="noticesubmit" value="Post">
    <button id="cancelsubmit">Cancel</button>
	</form>
	  <img id="noticewhitebodyimg" src="">
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
	     <div id="profile-pic"><img src="<?php echo $profile?>"></div>
		  <table border="0px">
          <tr><td><b><?php echo $name?></b></td></tr>
		  <tr><td><?php echo $id?></td></tr>
		  </table>
		  <button id="addnotice"><i class="fa fa-sticky-note"></i>&nbsp&nbspPost Notice </button>
	</div>
	<div id="notice-container">
	 <!-- <div class="notice-template">
	     <h4>Exam Routine for 5th semester fdfsd sdfsdf sdfsd sdff sd</h4> 
		 <text>Abhiay shrestha Abhiay shrestha dfsdfgsdfg dfsgsdfgsdf sdfgsdfgsd sdfgsdfgs fsdgsdfgs sfdgsdfgsdf sdfgsdfg sdfgsdfgs fsdgsdfg 
		 sadasdsa asdsadsad sadasdsad asdasdsadsa asdsadsad sdasdasdasd asdasd sdfg sfd</text>
          <center><div class="nimgframe"><img src="a.jpg" alt="No img"></div></center>
		 <i>Posted by Abhinay shrestha</i>
	  </div>-->
	 </div>
	<div class="right-container">
	   <div id="noticeinfo">
	   </div>
	   <span class="unseennotice">You Have<br><br><?php echo $notice?><br><br> unseen Notices</span>
	   <div id="chat">
	       Chat System
	   </div>
	</div>
	<script>
	    $(document).ready(function(){
			start=0;
			resetNotice();
			getNotice();
			$('#noticeinfo').slideDown(500);
			$('#addnotice').click(function(){
				$('#noticewhitebody').show();
				$('#noticeform').css('display','block');
					$('#title').focus();
					$('#title').val('');
					$('#description').val('');
				    $('#noticeupload').attr('src','');
				$('#noticewhitebody').click(function(){
					$('#noticeform').fadeOut(200,function(){
                         $('#noticewhitebody').hide();
                    });
                });
			});
            $('#cancelsubmit').click(function(e){
                e.preventDefault();
                $('#noticeform').fadeOut(200,function(){
                    $('#noticewhitebody').hide();
                });
            });
			$(window).scroll(function(){	
				if($(window).scrollTop()+672>=$(document).height()){
				   start +=4;
				   getNotice();
				}	
			});
			$('#tempnoticeupload').click(function(e){
				e.preventDefault();
				return false;
			});
			$('#noticeupload').change(function(){
				filePreview(this);
			});
			$('#notice-container').on('click','img',function(){
				$('#noticewhitebody').show();
				$('#noticewhitebodyimg').attr('src',$(this).attr('src')).slideDown(200);
				$('#noticewhitebody').click(function(){
				     $('#noticewhitebodyimg').slideUp(200);
					$(this).hide();
				});
			});
			$('#noticeform').on('submit',function(e){
				e.preventDefault();
				var noticetitle=$('#title').val();
				var noticedescription=$('#description').val();
				if(noticetitle.length>5 && noticedescription.length>8){
				    $(this).ajaxSubmit({
			           beforeSend:function(){
				       $('#nprog').show();
				       $('#nprog').attr('value','0');
			        },
			           uploadProgress:function(event,position,total,percentComplete){
				       $('#nprog').attr('value',percentComplete);
			        },
			           success:function(data){
				          if(data=='success'){
					        $('#check').show(function(){
								$('#nprog').fadeOut(500,function(){
									$('#check').hide();
									location.reload();
								});
							});
				          }
                          if(data=='photoerror'){							  
				            $('#nprog').fadeOut(500);
                            $('#nphotoerror').fadeIn(200);							
				          }				  
						  if(data=='photonotsubmited'){
							$('#check').show(function(){
								$('#nprog').fadeOut(500,function(){
									$('#check').hide();
									location.reload();
								});
							});
						 }
						 if(data=='servererror'){
							$('#nprog').fadeOut(500);
						 }
			        }
		           });				   
			   }
				else{
				   if(noticetitle.length<=5){	 
					$('#ntitleerror').fadeIn(200);
                      $('#title').css('border','1px solid red');						
				   }
				   if(noticedescription.length<=8){	 
					$('#ndescriptionerror').fadeIn(200);
                      $('#description').css('border','1px solid red');						
				   }
				}
				$('#title').focus(function(){
					$('#ntitleerror').fadeOut(200);
				});
				$('#description').focus(function(){
					$('#ndescriptionerror').fadeOut(200);
				});
			});
            $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
		});
		 function filePreview(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                      $('#prev').html('<img src="'+e.target.result+'" id="noticeimage"/>');
                      }
                     reader.readAsDataURL(input.files[0]);
                }
         }
		 function resetNotice() //ajax for resetting notice value to 0
		 {
			 $.ajax({
				 url : 'infinite_newsfeed.php',
				 method : 'POST',
				 dataType : 'text',
				 data : { noticeReset : 1},
				 success : function(data){
				 } 
			 });
		 }
		 function getNotice() //ajax for loading notice
		 {
			 $.ajax({
				 url : 'infinite_newsfeed.php',
				 method : 'POST',
				 dataType : 'text',
				 data : {getNotice : 1,
				          start : start},
				 success : function(data){
					 if(data=='nonotice'){
						 if(start==0){
						  $('#notice-container').html('<div style="color:red;text-align:center;font-size:18px;font-weight:bolder; margin-top:15px">No Notices</div>'); 
						 }
					 }	
                     else{					 
					 $('#notice-container').append(data);
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
	</script>
</body>
</html>