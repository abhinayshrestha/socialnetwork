<?php
     session_start();
	 require "database_connect.php";
       $name=$_FILES['file']['name'];
	   $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
	   $size=$_FILES['file']['size'];
	   $path='images/questionbank/'.uniqid().'.'.$ext;
	   $id=$_SESSION['id'];
       $faculty=$_POST['faculty'];
       $semester=$_POST['semester'];
       $subject=$_POST['tempsubject'];
       $year=$_POST['year'];
	   if($size<5242880 and ($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif')){
	   if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
         {
          $q1="insert into question (id,qfaculty,qsemester,qsubject,year,qpath) values('$id','$faculty','$semester','$subject','$year','$path')"; if(mysql_query($q1)){
	           exit('success');
          }
           else{
               exit('ok');
           }
         }
	   }
   ?>
