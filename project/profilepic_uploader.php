<?php
     session_start();
	 require "database_connect.php";
       $id=$_SESSION['id'];
       $name=$_FILES['file']['name'];
	   $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
	   $size=$_FILES['file']['size'];
	   $path='images/profilepic/'.uniqid().'.'.$ext;
	   if($size<5242880 and ($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif')){
	   if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
         {
           $query="update students_info set profilepic='$path' where uid='$id'";
           $q1="insert into newsfeed(id,comments,type,value,time) values('$id',0,'pp','$path',now())";
           if(mysql_query($query) && mysql_query($q1)){
	        exit('success');
           }
         }
           else{
               exit('servererror');
           }
	   }
      else{
         exit('exterror'); 
      }
   ?>
