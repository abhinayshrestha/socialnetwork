<?php
     session_start();
	 require "database_connect.php";
       $name=$_FILES['file']['name'];
	   $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
	   $size=$_FILES['file']['size'];
	   $path='images/'.uniqid().'.'.$ext;
	   $mid=$_SESSION['id'];
	   $about=mysql_real_escape_string($_POST['about']);
	   if($size<5242880 and ($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif')){
	   if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
         {
	      $query="insert into newsfeed(id,comments,type,value,time,about) values('$mid',0,'p','$path',now(),'$about')";
	      if(mysql_query($query)){
	      exit('success');
	      }
          }
	   }
?>