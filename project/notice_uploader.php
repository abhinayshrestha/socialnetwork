<?php
     session_start();
	 $id=$_SESSION['id'];
	 $title=$_POST['title'];
     $description=$_POST['description'];
	 require "database_connect.php";
	 if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name'])){
	      $name=$_FILES['file']['name'];	   
	      $ext= strtolower(pathinfo($name, PATHINFO_EXTENSION));
	      $size=$_FILES['file']['size'];
	      $path='images/notice/'.uniqid().'.'.$ext;
	      if($size<5242880 and ($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif')){
	      if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
           {
			$q1="insert into notice(id,ntitle,ndescription,nimagepath) values ('$id','$title','$description','$path')";
			$q2="update students_info set notice=notice+1 where uid!='$id'";
        	if(mysql_query($q1) and mysql_query($q2)){		
	         exit('success');
		     }
			else{
				exit('servererror');
			 }
		    }
			else{
				exit('servererror');
			}
		 }   
	    else{
	      exit('photoerror');
	      }		
	  }
	 else{
		   $q1="insert into notice(id,ntitle,ndescription) values ('$id','$title','$description')";
		   $q2="update students_info set notice=notice+1 where uid!='$id'";
		   if(mysql_query($q1) and mysql_query($q2))
		   {
		      exit('photonotsubmited');
		   }
           else{
			   exit('servererror');
		   }		   
	   }
   ?>
