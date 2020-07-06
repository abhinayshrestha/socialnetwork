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
	 <link rel="stylesheet" href="css/questionbank.css">
      <link rel="stylesheet" href="css/selectbox.css">
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
    <div id="qwhitebody"><!--<img class="qwhitebodyimg" src="a.jpg">--></div>
     <form id='questionform' method="post" enctype="multipart/form-data" action="questionuploader.php">
         <h3>Select the given field</h3><hr size="1" style="margin:0" color="#ccc">
         <select id='ffaculty' name="faculty">
             <option value="">Select Faculty</option>
             <option value="B.E Computer">B.E Computer</option>
             <option value="BCA">BCA</option>
             <option value="BIT">BIT</option>
         </select>
         <select id="fsemester" name="semester">
             <option value="">Select Semester</option>
             <option value="I">I</option>
             <option value="II">II</option>
             <option value="III">III</option>
             <option value="IV">IV</option>
             <option value="V">V</option>
             <option value="VI">VI</option>
             <option value="VII">VII</option>
             <option value="VIII">VIII</option>
         </select>
         <select id="fsubject" name="subject">
             <option value="">Select Subject</option>
         </select>
         <input type="text" id="tempsubject" name="tempsubject" style="display:none">
         <input id="file" type="file" name="file" accept="image/*" style="display:none">
         <button id="tempbutton" onclick="$('#file').click();">Upload QuestionBank</button>
         <input type="number" id="year" name="year" placeholder="YEAR" maxlength="4">
         <input type="submit" value="Post" name="submit" id="questionsubmit">
         <!--<img src=a.jpg height=100px width="100px">-->
         <progress id="prog" max="100" value="0"></progress><i class="fa fa-check" id="check"></i>
         <hr size="1" style="margin:20px 0px 0px 0px" color="#ccc">
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
        <button id="addquestion"><i class="fa fa-sticky-note"></i>&nbsp&nbspAdd Questions </button>
	</div>
	<div id="questionbank-container">
	    <div class="static"><h4>Search For Question Bank</h4>
      <div class="container">
      <div class="dropdown" id="faculty">
        <div class="select">
          <span>Select Faculty</span>
          <i class="fa fa-chevron-left"></i>
        </div>
        <input type="hidden" name="faculty">
        <ul class="dropdown-menu">
          <li>B.E Computer</li>
          <li>BIT</li>
          <li>BCA</li>
        </ul>
      </div>
        <div class="dropdown" id="semester">
        <div class="select">
          <span>Select Semester</span>
          <i class="fa fa-chevron-left"></i>
        </div>
        <input type="hidden" name="semester">
        <ul class="dropdown-menu">
          <li>I</li>
          <li>II</li>
          <li>III</li>
          <li>IV</li>
          <li>V</li>
          <li>VI</li>
          <li>VII</li>
          <li>VIII</li>
        </ul>
      </div>
     <div class="dropdown" id="subject">
        <div class="select">
          <span>Select Subject</span>
          <i class="fa fa-chevron-left"></i>
        </div>
        <input type="hidden" name="faculty">
        <ul class="dropdown-menu">
    
        </ul>
      </div>
    </div>
            <center><button id='searchquestionbank'>Search</button></center>     <script  src="js/selectbox.js"></script>
            <div id="dynamic">
            <!--<div class="papers">
                <div class="qimgcover"> <img src='a.jpg'></div>
                <date>2012</date>
            </div>-->
            </div>
    </div>
       
    </div>
	<div class="right-container">
	   <div id="background">
	   </div>
	   <span class="info">Question Banks</span>
	   <div id="chat">
	       Chat System
	   </div>
	</div>
    <script>
       $(document).ready(function(){
           $('#searchquestionbank').click(function(){
               var faculty=$('#faculty span').text();
               var semester=$('#semester span').text();
               var subject=$('#subject span').text();
               if(faculty!='Select Faculty' && semester!='Select Semester' && subject!='Select Subject'){
                  getQuestion(faculty,semester,subject);   
               }
               else{
               if(faculty=='Select Faculty'){
                   $('#faculty').css('border','1px solid red');
               }
               if(semester=='Select Semester'){
                   $('#semester').css('border','1px solid red');
               }
               if(subject=='Select Subject'){
                   $('#subject').css('border','1px solid red');
                }
               }
           });
           $('#background').slideDown(500);
           $('#questionform #ffaculty').change(function(){
               var semester=$('#fsemester').val();
               var faculty=$(this).val();
               if(faculty.length!=0 && semester.length!=0){
                   loadFsubject(faculty,semester);
               }
               else{
                   $('#questionform #fsubject').html("<option value=''>Select Subject</option>");
               }
           });
           $('#addquestion').click(function(){
               $('#qwhitebody').html('').show();
               $('#questionform').show();
               $('#qwhitebody').click(function(){
                   $(this).hide(0,function(){
                       $('#questionform').hide();
                   });
               });
           });
           $('#cancelsubmit').click(function(e){
               e.preventDefault();
                $('#questionform').fadeOut(100,function(){
                    $('#qwhitebody').hide();
                });
           });
           $('#questionform').on('submit',function(e){
               e.preventDefault();
               var semester=$('#fsemester').val();
               var faculty=$('#ffaculty').val();
               var subject=$('#fsubject').val();
               $('#tempsubject').val(subject);
               if(semester.length>0 && faculty.length>0 && subject.length>0){
                 $('#questionform h3').css('color','#1280ce'); 
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
                  else{
				    alert(data); 
				  }				  
			     }
		       });
               }
               else{
                  $('#questionform h3').css('color','red');    
               }
           });
           $('#questionform #fsemester').change(function(){
               var faculty=$('#ffaculty').val();
               var semester=$(this).val();
               if(faculty.length!=0 && semester.length!=0){
                   loadFsubject(faculty,semester);
               }
               else{
                   $('#questionform #fsubject').html("<option value=''>Select Subject</option>");
               }
           });
           $('#file').change(function(){
               filePreview(this);
               $('#year ,#questionsubmit').show(200);
               $('#year').focus();
           });
           $('#semester ul li').click(function(){
               if($('#faculty span').text()!='Select Faculty'){
                   var faculty=$('#faculty span').text();
                   var semester=$(this).text();
                   loadSubject(faculty,semester);
               }
               $('#semester').css('border','0');
           });
           $('#tempbutton').click(function(e){
               e.preventDefault();
               return false;
           });
           $('#dynamic').on('click','.papers img',function(){
              var src=$(this).attr('src');
              var name =$(this).attr('id');
               getQname(name);
              $('#qwhitebody').show(0,function(){
                  $(this).html('<img src='+src+' class="qwhitebodyimg">');
              }) 
             $('#qwhitebody').click(function(){
                   $(this).hide();
               });  
           });
           $('#faculty ul li').click(function(){
               if($('#semester span').text()!='Select Semester'){
                   var faculty=$(this).text();
                   var semester=$('#semester span').text();
                   loadSubject(faculty,semester);
               }
                $('#faculty').css('border','0');
           });
           $('#subject').on('click','li',function(){
                $('#subject').css('border','0');
           });
            $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });

           
       });
        function loadSubject(faculty,semester){
            $.ajax({
                url : 'infinite_newsfeed.php',
                method : 'POST',
                dataType : 'text',
                data : {
                    loadSubject : 1,
                    faculty : faculty,
                    semester : semester
                },
                success : function(data){
                    $('#subject ul').html(data);
                }
            });
        }
        function loadFsubject(faculty,semester){
            $.ajax({
                url : 'infinite_newsfeed.php',
                method : 'POST',
                dataType : 'text',
                data : {
                    loadFsubject : 1,
                    faculty : faculty,
                    semester : semester
                },
                success : function(data){
                    $('#fsubject').html(data);
                }
            });
        }
        function filePreview(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                       $('#tempbutton').after('<img src="'+e.target.result+'" width="100px" height="100px" class="preview">');
                      }
                     reader.readAsDataURL(input.files[0]);
                }
         }
        function getQuestion(faculty,semester,subject){
            $.ajax({
                url : "infinite_newsfeed.php",
                method : "POST",
                dataType : "text",
                data : {
                    getQuestion : 1,
                    faculty : faculty,
                    semester : semester,
                    subject : subject
                },
                success : function(data){
                if(data=='empty'){
                  $('#dynamic').html("<div id='emptymsg'>No result found</div>");   
                }   
                else{
                 $('#dynamic').html(data);
                }
              }
            });
        }
        function getQname(name){
            $.ajax({
                url : "infinite_newsfeed.php",
                method : "POST",
                dataType : "text",
                data : {
                    qname :1,
                    name : name
                },
                success : function(data){
                    $('#qwhitebody').append("<div id='name'>Posted By "+data+"</div>");
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