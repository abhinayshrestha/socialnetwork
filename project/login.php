<?php
   require "database_connect.php";
   $loginerror=0;
   if(isset($_POST['login'])){
	   $lid=$_POST['lid'];
	   $lpassword=$_POST['lpassword'];
	   $query="select uid from students_info where uid='".mysql_real_escape_string($lid)."'"." and password='".mysql_real_escape_string($lpassword)."'";
	   if($result=mysql_query($query)){
		   if(mysql_num_rows($result)>0){
			   $_SESSION['id']=$lid;
			   $loginerror=0;
			   header('Location: home.php');
		   }
		   else{
			   ++$loginerror;
		   }
	   }
   }
?>