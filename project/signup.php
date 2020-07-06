<?php
   session_start();
   require 'database_connect.php';
    $counter=0;
	$error=0;
   if(isset($_POST['signup'])){
	   $fname=$_POST['fname'];
	   $lname=$_POST['lname'];
	   $gender=$_POST['gender'];
	   $year=$_POST['year'];
	   $month=$_POST['month'];
	   $day=$_POST['day'];
	   $faculty=$_POST['faculty'];
	   $semester=$_POST['semester'];
	   $id=$_POST['id'];
	   $password=$_POST['password'];
	   $email=$_POST['email'];
	   $query= "select * from students_id where id='$id' and id_status='a'";
	   $name= $fname." ".$lname; 
	   $dob=$year."-".$month."-".$day;
	   if($result=mysql_query($query)){
		   if(mysql_num_rows($result)>0){
			 if($gender=='Female'){  
			  $insertquery= "insert into students_info(uid,name,gender,faculty,sem,password,email,dob,profilepic) values('$id','$name','$gender','$faculty','$semester','$password','$email','$dob','webimages/fprofilepic.jpg ')";
			 }
			 else{
			  $insertquery= "insert into students_info(uid,name,gender,faculty,sem,password,email,dob,profilepic) values('$id','$name','$gender','$faculty','$semester','$password','$email','$dob','webimages/mprofilepic.jpg ')"; 
			 }
			  $updatequery="update students_id set id_status='u' where id='$id'";
			  if(mysql_query($insertquery)){
				  mysql_query($updatequery);
				 $_SESSION['id']=$id;
				 $error=0;
				 header('Location: home.php');
			  }
			  else{
				  echo"Something went wrong";
			  }
		   }
		   else{
			 ++$error;
			  ++$counter;
		   }
	   }
   }
?>