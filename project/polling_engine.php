<?php

require 'database_connect.php';
$id=$_GET['id'];
set_time_limit(0);
//$filename= "a.txt";
$lastmodif = isset( $_GET['timestamp'])? $_GET['timestamp']: 0 ;
$q="select mod_time from students_info where uid='$id'";
$result=mysql_query($q);
$date=mysql_result($result,0,'mod_time');
$currentmodif=strtotime($date); 
while ($currentmodif <= $lastmodif) {
    usleep(10000);
    clearstatcache();
    $result=mysql_query($q);
    $date=mysql_result($result,0,'mod_time');
     $currentmodif=strtotime($date);
}

$response = array();
$q1="select assignment,notice,event,notifi from students_info where uid='$id'";
$result1=mysql_query($q1);
$response['assignment'] =mysql_result($result1,0,'assignment');
$response['notice'] =mysql_result($result1,0,'notice');
$response['event'] =mysql_result($result1,0,'event');
$response['notification'] =mysql_result($result1,0,'notifi');
$response['last']=$lastmodif;
$response['timestamp']= $currentmodif;
echo json_encode($response);

?>