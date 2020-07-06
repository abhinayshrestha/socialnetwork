<?php
     session_start();
	 require "database_connect.php";
       $name=$_FILES['file']['name'];
	   $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
	   $size=$_FILES['file']['size'];
	   $path='images/assignment/'.uniqid().'.'.$ext;
	   $mid=$_SESSION['id'];
	   $sem=$_POST['semester'];
	   $fac=$_POST['faculty'];
	   $subject=mysql_real_escape_string($_POST['asubject']);
	   if($size<5242880 and ($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif')){
	   if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
         {
	      $query="insert into assignment(id,assignments,asubject,date,sem,afaculty) values('$mid','$path','$subject',now(),'$sem','$fac')";
		  $q1="update students_info set assignment=assignment+1 where uid!='$mid' and sem='$sem' and faculty='$fac'";
		  if(mysql_query($query) and mysql_query($q1)){
	      exit('success');
		  }
         }
	   }
   ?>
