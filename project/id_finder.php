<?php
       require "database_connect.php";
	   $faculty=$_POST['faculty'];
	   $sem=$_POST['semester'];
	   $query="select * from students_id where sem='$sem' and faculty='$faculty'";
	   $result=mysql_query($query);
	   $output="";
	   if(mysql_num_rows($result)>0){
	   while($rows=mysql_fetch_assoc($result)){
		   $output.="<option value=".$rows['id'].">".$rows['id']."</option>";
	   }
	   }
	   else{
		   $output='<option value="">ID</option>';
	   } 
     echo $output;
?>