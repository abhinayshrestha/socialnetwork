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
			   $assignment=mysql_result($result,0,'assignment');
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
	 <link rel="stylesheet" href="css/assignment.css">
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
     <div id="awhitebody"></div><img src="" id="awhitebodyimg" align="center">
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
		  <form method="POST" action="assignment_uploader.php" id="aUpload" enctype="multipart/form-data">
		      <input type="file" id="assignmentupload" name="file">
			  <button id="tempupload" onclick="$('#assignmentupload').click();"> 
			  <i class="fa fa-plus"></i>&nbsp&nbspAdd Assignment </button>
			  <div id="auploadForm"> </div>
			  <progress id="aprog" max="100" value="0"></progress>
			  <input type="text" name="semester" value="<?php echo $semester?>" style="display:none">
			  <input type="text" name="faculty" value="<?php echo $faculty?>" style="display:none">
			  <input type="text" id="asubject" name="asubject" placeholder="Enter Subject eg:(Math Part 1)" maxlength="25">
			  <span id="errormsg">*Please give the subject name*</span>
			  <input type="submit" value="Add" id="asubmit">
		  </form>
		  <input type="input" id="asearch" placeholder="searchByDate(eg: 2017-01-03)" maxlength="14">
		  <button id="assubmit"><i class="fa fa-search"></i></button>
		  <span id="searcherrormsg">*Date Format '2017-01-03'*</span>
	</div>
	<div id="assignment-container">
       <!-- <div class="assignmentgallary"><div class="aimgcover"><img src="a.jpg"></div><span>Math Part1<br>2018-12-33</span></div>-->
	</div>
	<div class="right-container">
	   <div id="assignmentinfo">
	   </div>
	   <span id='assignmentinfocontent'>You Have<br><br><?php echo $assignment ?> <br><br> unread assignment</span>
	   <div id="chat">
	       Chat System
	   </div>
	</div>
	<script>
	    $(document).ready(function(){
			start=0;
			resetassignment();
			getAssignment();
			$('#assignment-container').on('click','img',function(){
				var name=$(this).attr('id');
				getName(name);
				$('#awhitebody').show();
				$('#awhitebodyimg').attr('src',$(this).attr('src')).slideDown(200);
			});
            $('#assignmentinfo').slideDown(500);
            $('.right-container span').slideDown(500);			
			$('#awhitebody').click(function(){
				$(this).hide();
				$('#awhitebodyimg').slideUp(200);
			});
			$('#assignmentupload').change(function(){
				filePreview(this);
				$('#asubject , #asubmit').show(200);
			});
			$('#tempupload').click(function(e){
				e.preventDefault();
				return false;
			});
			$(window).scroll(function(){	
				if($(window).scrollTop()+672>=$(document).height()){
				   start += 9;
				   getAssignment();
				}	
			});
			$('#aUpload').on('submit',function(e){
		        e.preventDefault();
			   if($('#asubject').val().length>0){	
		        $(this).ajaxSubmit({
			     beforeSend:function(){
				   $('#aprog').show();
				   $('#aprog').attr('value','0');
			      },
			     uploadProgress:function(event,position,total,percentComplete){
				    $('#aprog').attr('value',percentComplete);
			     },
			      success:function(data){
				 if(data=='success'){
					  $('#aprog').fadeOut(500);
					  location.reload();
				   }
                  else{
				    alert('Server Error Please Try Again Later'); 
				  }				  
			     }
		       });
			   }
			   else{
				   $('#errormsg').fadeIn(200);
				   $('#asubject').keyup(function(){
					   $('#errormsg').fadeOut(200);
				   });
			   }
	        });
			$('#assubmit').click(function(){
				var date=$('#asearch').val();
				var dateReg=/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
				if(dateReg.test(date)){
					$(window).unbind();
					asearchResult(date);
				}
				else{
					$('#searcherrormsg').fadeIn(200);
					$('#asearch').keyup(function(){
						$('#searcherrormsg').fadeOut(200);
					});
;				}
			});
             $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
		});
		 function getAssignment(){
			 $.ajax({
				 url : 'infinite_newsfeed.php',
				 method : 'POST',
				 dataType : 'text',
				 data : {
					 assignmentValue : 1,
					 sem : "<?php echo $semester?>",
					 start : start,
					 faculty : "<?php echo $faculty?>"
				 },
				 success : function(data){
					 if(data=='error'){
					  if(start==0)	 
					    $('#assignment-container').html('<div style="color:red;text-align:center;font-size:16px;margin-top:15px;">No any assignment </div>');
					 }
					 else{
					   $('#assignment-container').append(data);	 
					 }
				 }
			 });
		 }
		 function resetassignment(){
			 $.ajax({
				 url : 'infinite_newsfeed.php',
				 method : 'POST',
				 dataType : 'text',
				 data : {
					 resetValue : 1,
				 },
				 success : function(data){
				 }
			 });
		 }
		 function filePreview(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                      $('#auploadForm + img').remove();
                      $('#auploadForm').after('<img src="'+e.target.result+'" class="apreview"/>');
                      }
                     reader.readAsDataURL(input.files[0]);
                }
         }
		 function asearchResult(date) //ajax search for assignment
		   {
			 $.ajax({
				 url : "infinite_newsfeed.php",
				 method : "POST",
				 dataType : "text",
				 data : {
					 searchValue : 1,
					 sem : "<?php echo $semester?>",
					 date : date,
					 faculty : "<?php echo $faculty?>"
				 },
				 success : function(data){
					 if(data=='error'){
						 $('#assignment-container').html('<div style="color:red;margin-top:15px;text-align:center;font-size:16px;">No result Found </div>');
					 }
					 else{
						 $('#assignment-container').html(data);
					 }
				 }
			 });
		 }
		 function getName(name) //ajax for finding name of assignment uploader
		 {
			 $.ajax({
				 url : 'infinite_newsfeed.php',
				 method : 'POST',
				 dataType : 'text',
				 data : {
					 nameValue : 1,
    				 name : name	 
				 },
				 success : function(data){
					 $('#awhitebody').html("Posted By "+data);
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