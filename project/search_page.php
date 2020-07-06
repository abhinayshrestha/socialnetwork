<?php
   session_start();
  if(isset($_SESSION['id']) and !empty($_SESSION['id']))
  {
    $searchname=$_GET['name'];
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
     <link rel="stylesheet" href="css/search_page.css">
	 <script src="js/jquery.js"></script>
     <style>
	      body{
     font-family:arial;
     padding:0px;
	 margin:0px;
	 background:#f8f8f8; 
   }
</style>
  </head>
   <body>
   <header>
	<ul>
        <li><a href="home.php" id="logo" title="kccConnection.com"> < KccConnection /></a></li>
        <li><input type="text" id="searchinput" placeholder="find friends" maxlength="30" value="<?php echo $searchname;?>"><div class="searchresult">
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
            <table border="0" cellspacing="5px">
                <?php
    $q1= "select profilepic,name,uid,faculty,sem from students_info where name like '$searchname%'";
          if($result=mysql_query($q1)){
              if(mysql_num_rows($result)>0){
                  $output="";
                  while($rows=mysql_fetch_assoc($result)){
                      echo "<tr><td rowspan='2' class='imgtd'><a href='search_result.php?id=".$rows['uid']."'><div class='searchimgframe'><img src='".$rows['profilepic']."' ></div></a></td><td class='searchname'><a href='search_result.php?id=".$rows['uid']."&name=".$name."'><b><div>".$rows['name']."</div></b></a></td>
                </tr>
                <tr><td class='searchfaculty'><a href='search_result.php?id=".$rows['uid']."&name=".$name."'><div>".$rows['faculty']." -".$rows['sem']." Sem"."</div></a></td>
                 </tr>
                <tr><td colspan='2'> <hr style='margin:0;size:1'></td></tr>";
                  }
              }
          }
             
              ?>
               <!-- <tr><td rowspan='2' class='imgtd'><a href='#'><div class='searchimgframe'><img src='a.jpg' ></div></a></td><td class='searchname'><a href='#'><b><div>Abhinay shrestha</div></b></a></td>
                </tr>
                <tr><td class='searchfaculty'><a href='#'><div>B.E Computer V Sem</div></a></td>
                 </tr>
                <tr><td colspan='2'> <hr style='margin:0;size:1'></td></tr>
                -->
            </table>
        </div>
       <script>
           $(document).ready(function(){
               $('#searchinput').keyup(function(){
              getSearchResult();     
            });
             $('body').click(function(){
                 $('.searchresult').hide();
             });
           });
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