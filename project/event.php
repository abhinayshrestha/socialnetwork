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
			   $event=mysql_result($result,0,'event');
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
	 <link rel="stylesheet" href="css/jquery.datetimepicker.css">
	 <link rel="stylesheet" href="css/template.css">
	 <link rel="stylesheet" href="css/event.css">
	 <script src="js/jquery.js"></script>
	 <script src="js/modernizr.js"></script>
	 <script src="js/jquery.datetimepicker.js"></script>
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
    <div id="ewhitebody"></div>
	   <form id="eventform">
	    <table border="0px">
            <h3>Event Uploader</h3>
            <hr size="1px" color="#ccc">
		<tr><td>Event Name : </td><td><input type="text" id="topic" class='text' placeholder="eg: Blood Donation Program" maxlength="30"/>
	   <br><span id='topicerror' style="display:none">*Please Enter Some Heading*<span></td></tr>
	   <tr><td>Event Date : </td><td><input id="date"/>
	   <br><span id='dateerror' style="display:none">*Please Enter UpComming Date*<span></td></tr>
	   <tr><td>Event Description : </td><td><textarea id="description" maxlength="100"></textarea>
	   <br><span id='descerror' style="display:none">*Please Enter Some Description*<span></td></tr>
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
		  <button id="addevent"><i class="fa fa-pencil"></i>&nbsp&nbspCreate Event </button>
	</div>
	<div id="event-container">
	<!--  <div class="eventcount">Upcomming Events : 10 Events&nbsp&nbsp&nbsp&nbspTomorrow : No Events &nbsp&nbsp&nbsp&nbspThis week : No Events</div>-->
	  <!-- <div class="eventtemplate"> <time class="icon"> <strong>September</strong><span>20</span> </time>
		 <div class='event'><b><u>Blood Donation Program</u></b> Something about it <i>Posted by Abhinay shrestha</i></div>
	   </div>	 
	  <div class="eventtemplate"> <time class="icon"> <strong>September</strong><span>20</span> </time>
		 <div class='event'><b><u>Blood Donation Program</u></b> Something about it <i>Posted by Abhinay shrestha</i></div>
	  </div> -->	 
    </div>   
	<div class="right-container">
	   <div id="eventinfo">
	   </div>
	   <span>You Have<br><br><?php echo $event;?><br><br> unseen Events</span>
	   <div id="chat">
	       Chat System
	   </div>
	</div>
	<script>
	    $(document).ready(function(){
		    start=0;
			resetEvent();
			getCount();	
            $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
			$('.right-container #eventinfo').slideDown(500);
			var dateObject = pikadayResponsive(document.getElementById("date"));
			$('#addevent').click(function()
			{
				$('#ewhitebody').show().click(function(){
					$('#eventform').fadeOut(200,function(){
                        $('#ewhitebody').hide();
                    });
					
				});
				$('#eventform').show(0,function(){
					$('#topic').focus();
				});
			});
            $('#cancelsubmit').click(function(e){
                e.preventDefault();
                $('#eventform').fadeOut(200,function(){
                   $('#ewhitebody').hide(); 
                });
            })
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
			$(window).scroll(function(){	
				if($(window).scrollTop()+672>=$(document).height()){
				   start += 7;
				   getEvent();
				}	
			});
		});
		function resetEvent() //ajax for resetting the event count
		{
			$.ajax({
			url : 'infinite_newsfeed.php',
			method : 'POST',
			dataType : 'text',
			data : {
				eventReset : 1
			},
			success : function(data){
			}
		  });	
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
		function getEvent() //ajax for posting Events
		{
			$.ajax({
				url : 'infinite_newsfeed.php',
				method : 'POST',
				dataType : 'text',
				data : {
				   getEvent : 1,
                   start : start				   
				},
				success : function(data){
				 if(data=='error'){
					if(start==0){
						$('#event-container').html('<div style="color:red;text-align:center;  font-size:16px;font-weight:bolder; margin-top:5px">No Upcomming Events </div>');
					} 
				 }
				else{	 
				   $('#event-container').append(data);
				}
			  }
			});
		}
		function getCount() // ajax to load events count
		{
			$.ajax({
				url : "infinite_newsfeed.php",
				method : "POST",
				dataType : "text",
				data : {
					getEventCount : 1
				},
				success : function(data){
					$('#event-container').append(data);
						getEvent();
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