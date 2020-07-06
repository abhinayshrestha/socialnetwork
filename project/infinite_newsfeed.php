<?php
   session_start();
   require "database_connect.php";
   if(isset($_POST['getData'])){
   $start=mysql_real_escape_string($_POST['start']);
   $query="SELECT students_info.name,students_info.profilepic, newsfeed.* FROM students_info, newsfeed WHERE students_info.uid = newsfeed.id
           order by newsfeed.postid desc LIMIT $start,3";
	if($result=mysql_query($query)){
		 $output="";
		if(mysql_num_rows($result)>0){
			while($rows=mysql_fetch_assoc($result)){
				if($rows['type']=='p'){
                    $output.="<div class='infiniteimage'>
                <div class='imageboxtop'><div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b><a href=search_result.php?id=".$rows['id'].">".$rows['name']."</a></b> <span>added a photo</span><date>".$rows['time']."</date>
                </div>
                <hr color='#ccc' style='margin: 0px' size='1px'>
                <div class='aboutimage'>".$rows['about']."</div>
                <div class='scrollimagecover'>
                    <img src='".$rows['value']."'>
                </div>
                <div class='commentnav'>
                    <button class='showcomment'><i class='fa fa-comment-o'> </i> ".$rows['comments']." Comments <i class='fa fa-angle-double-down'></i></button><button class='hidecomment'>Hide Comments <i class='fa fa-angle-double-up'></i></button>
                </div><div class='commentblock'>";
                    $pid=$rows['postid'];
					$q1="select students_info.name,students_info.uid,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b><a href=search_result.php?id=".$comment['uid'].">".$comment['name']."</a></b> ".$comment['comments']."</div>";
					}
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment ".$rows['id']."' id='".$rows['postid']."'>Comment</button>
                </div></div>";
                }
                if($rows['type']=='s'){
                    $output.="<div class='infinitestatus'>
                    <div class='statusboxtop'><div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b><a href=search_result.php?id=".$rows['id'].">".$rows['name']."</a></b> <span>updated a status</span><date>".$rows['time']."</date>
                    </div>
                    <hr color='#ccc' style='margin: 0px' size='1px'>
                    <div class='status'>".$rows['value']."</div>
                    <div class='commentnav'>
                    <button class='showcomment'><i class='fa fa-comment-o'> </i> ".$rows['comments']." Comments <i class='fa fa-angle-double-down'></i></button><button class='hidecomment'>Hide Comments <i class='fa fa-angle-double-up'></i></button>
                    </div><div class='commentblock'>";
                    $pid=$rows['postid'];
					$q1="select students_info.name,students_info.uid,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b><a href=search_result.php?id=".$comment['uid'].">".$comment['name']."</a></b> ".$comment['comments']."</div>";
					}
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment ".$rows['id']."' id='".$rows['postid']."'>Comment</button>
                    </div></div>";
                }
                if($rows['type']=='pp'){
                    $output.="<div class='infiniteimage'>
                <div class='imageboxtop'><div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b><a href=search_result.php?id=".$rows['id'].">".$rows['name']."</a></b> <span>changed profile picture</span><date>".$rows['time']."</date>
                </div>
                <hr color='#ccc' style='margin: 0px' size='1px'>
                <div class='aboutimage'>".$rows['about']."</div>
                <div class='scrollimagecover'>
                    <img src='".$rows['value']."'>
                </div>
                <div class='commentnav'>
                    <button class='showcomment'><i class='fa fa-comment-o'> </i> ".$rows['comments']." Comments <i class='fa fa-angle-double-down'></i></button><button class='hidecomment'>Hide Comments <i class='fa fa-angle-double-up'></i></button>
                </div><div class='commentblock'>";
                    $pid=$rows['postid'];
					$q1="select students_info.name,students_info.uid,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b><a href=search_result.php?id=".$comment['uid'].">".$comment['name']."</a></b> ".$comment['comments']."</div>";
					}
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment ".$rows['id']."' id='".$rows['postid']."'>Comment</button>
                </div></div>";
                }

			}
			exit($output);
		}
	}	   
	else{
		exit ('error');
	}
   }
   if (isset($_POST['postValue'])){
	  $status=mysql_real_escape_string($_POST['status']);
      $id=$_SESSION['id'];
      $query="insert into newsfeed (id,comments,type,value,time) values ('$id',0,'s','$status',now())";
       if(mysql_query($query)){
		   exit('ok');
	   }	  
	  else{
		   exit('no');
	   }
   }
     if(isset($_POST['loadComment'])){
       $pid=$_POST['pid'];
         $query="select students_info.name,students_info.uid,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid";
       if($rows=mysql_query($query)){
		  $output="";
		  while($result=mysql_fetch_assoc($rows)){
			  $output.="<div class='comment'><b><a href=search_result.php?id=".$rows['uid'].">".$result['name']."</a></b> ".$result['comments']."</div>";
		  }
		  exit($output);
	  }				
	  exit('error');
   }
   
  if(isset($_POST['resetValue'])){
	  $id=$_SESSION['id'];
	  $query="update students_info set assignment=0 where uid='$id'";
	  if(mysql_query($query)){
		  exit('success');
	  }
  }
  if(isset($_POST['assignmentValue'])){
	  $sem=$_POST['sem'];
	  $start=$_POST['start'];
	  $fac=$_POST['faculty'];
	  $query="select * from assignment where sem='$sem' and afaculty='$fac' order by aid desc LIMIT $start,9";
	  if($result=mysql_query($query)){
		if(mysql_num_rows($result)>0){
		 $output="";	
         while($assignment=mysql_fetch_assoc($result)){ 			
		    $output.="<div class='assignmentgallary'><div class='aimgcover'><img src='".$assignment['assignments']."' id='".$assignment['aid']."'>
			</div><span>".htmlentities($assignment['asubject'])."<br>".$assignment['date']."</span></div>";
			}			  
		 exit($output);
		}
		else{
			exit('error');
		}
	  }
  }
  if(isset($_POST['searchValue'])){
	  $sem=$_POST['sem'];
	  $date=$_POST['date'];
	  $fac=$_POST['faculty'];
	  $query="select * from assignment where sem='$sem' and date='$date' and afaculty='$fac' order by aid desc";
	  if($result=mysql_query($query)){
		  if(mysql_num_rows($result)>0){
			  $output="";
			  while($rows=mysql_fetch_assoc($result)){
				  $output.="<div class='assignmentgallary'><div class='aimgcover'><img src='".$rows['assignments']."' id='".$rows['aid']."'>
			                </div><span>".htmlentities($rows['asubject'])."<br>".$rows['date']."</span></div>";
			  }
			  exit($output);
		  }
          else{
			  exit('error');
		  }		  
	  }
	  else{
		  exit(mysql_error());
	  }
  }
  if(isset($_POST['nameValue'])){
	  $aid=$_POST['name'];
	  $query="select students_info.name from students_info,assignment 
	          where assignment.id=students_info.uid and assignment.aid='$aid'";
	  if($result=mysql_query($query)){
		  $output=mysql_result($result,0,'name');
		  exit($output);
	  }		  
	  else{
		  exit(mysql_error());
	  }
  }
  if(isset($_POST['eventReset'])){
	  $id=$_SESSION['id'];
	  $query="update students_info set event=0 where uid='$id'";
	  if(mysql_query($query)){
		  exit('success');
	  }
  }
  if(isset($_POST['eventValue'])){
	  $time=date('20'.'y-m-d');
	  $date=$_POST['date'];
	  $month=$_POST['month'];
	  $day=$_POST['day'];
	  $heading=$_POST['heading'];
	  $description=$_POST['description'];
	  $id=$_SESSION['id'];
	  if($time<$date){
	  $query="insert into event(id,eheading,edescription,edate,emonth,eday) values('$id','$heading','$description','$date','$month','$day')";
	  $q1="update students_info set event=event+1 where uid!='$id'";
	  if(mysql_query($query) and mysql_query($q1)){
		  exit('success');
	    }
	  else{
		  exit('error');
	   }
	  }
	  else{
		  exit('error');
	  }
  }
  if(isset($_POST['getEvent'])){
	  $start=$_POST['start'];
	  $query="select event.*,students_info.name from event,students_info where students_info.uid=event.id 
	          and edate>CAST(CURRENT_TIMESTAMP AS DATE) order by edate LIMIT $start,7";
	  $month=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August',
	                '09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	  if($result=mysql_query($query)){
		  if(mysql_num_rows($result)>0){
			  $response="";
			  while($rows=mysql_fetch_assoc($result)){
				  $i=$rows['emonth'];
				  $response.="<div class='eventtemplate'> <time class='icon'> <strong>".htmlentities($month[$i])."
				  </strong><span>".htmlentities($rows['eday'])."
				  </span></time><div class='event'><b><u>".htmlentities($rows['eheading'])."</u> </b>".htmlentities($rows['edescription'])."
				   <br><br><br><i>Posted By ".htmlentities($rows['name'])."</i></div> </div>";
			  }
			  exit($response);
		  }
		  else{
			  exit('error');
		  }
	  }
  }
  if(isset($_POST['getEventCount'])){
	  $q1="select count(eid) as totalcount from event where edate>CAST(CURRENT_TIMESTAMP AS DATE)";
	  $q2="select count(eid) as tomorrowcount from event where edate=CAST(CURRENT_TIMESTAMP AS DATE)+1";
	  $q3="select count(eid) as weekcount from event where edate>CAST(CURRENT_TIMESTAMP AS DATE) and edate<CAST(CURRENT_TIMESTAMP AS DATE)+7";
	  if($total=mysql_query($q1) and $tomorrow=mysql_query($q2) and $week=mysql_query($q3)){
		 if(mysql_num_rows($total)>0){
			 $t=mysql_result($total,0,'totalcount');
		 }
		 else{
			 $t=0;
		 }
		 if(mysql_num_rows($tomorrow)>0){
			 $tomo=mysql_result($tomorrow,0,'tomorrowcount');
		 }
		 else{
			 $tomo=0;
		 }if(mysql_num_rows($week)>0){
			 $w=mysql_result($week,0,'weekcount');
		 }
		 else{
			 $w=0;
		 }
		 exit("<div class='eventcount'>Upcomming Events : ".$t." Events&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspTomorrow : 
		         ".$tomo." Events &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspThis week : ".$w." Events</div>");
	  }
	  exit(mysql_error());
  }
  if(isset($_POST['noticeReset'])){
	  $id=$_SESSION['id'];
	  $query="update students_info set notice=0 where uid='$id'";
	  if(mysql_query($query)){
		  exit('success');
	  }
  }
  if(isset($_POST['getNotice'])){
	  $start=$_POST['start'];
	  $query="select students_info.name,notice.* from students_info,notice where students_info.uid=notice.id 
	         order by nid desc LIMIT $start,4";
	  if($result=mysql_query($query)){
		  if(mysql_num_rows($result)>0){
			  $output="";
			  while($rows=mysql_fetch_assoc($result)){
				  if($rows['nimagepath']!= NULL){
	              $output.="<div class='notice-template'>
	                        <h4>".htmlentities($rows['ntitle'])."</h4> 
		                    <text><b style='color:#000'>Description</b> : ".htmlentities($rows['ndescription'])."</text>
		                    <center><div class='nimgframe'><img src='".$rows['nimagepath']."'></div></center>
		                    <i>Posted by ".$rows['name']."</i></div>";			  
			      }
				  else{
					$output.="<div class='notice-template'>
	                        <h4>".htmlentities($rows['ntitle'])."</h4> 
		                    <text><b style='color:#000'>Description</b> : ".htmlentities($rows['ndescription'])."</text>
		                    <i>Posted by ".$rows['name']."</i></div>";  
				  }
			  }	  
			  exit($output);
		  }
		  else{
			  exit('nonotice');
		  }
	  }
	  else{
		  exit('servererror');
	  }
  }
if(isset($_POST['loadSubject'])){
    $semester=$_POST['semester'];
    $faculty=$_POST['faculty'];
    $query="select * from subject where faculty='$faculty' and semester='$semester'";
    if($result=mysql_query($query)){
        if(mysql_num_rows($result)>0){
        $output="";
        while($rows=mysql_fetch_assoc($result)){
            $output.="<li>".$rows['subjects']."</li>";
        }
        exit($output);
        }
        else{
            exit('No result Found');
        }
    }
}
if(isset($_POST['loadFsubject'])){
    $semester=$_POST['semester'];
    $faculty=$_POST['faculty'];
    $query="select * from subject where faculty='$faculty' and semester='$semester'";
    if($result=mysql_query($query)){
        if(mysql_num_rows($result)>0){
        $output="";
        while($rows=mysql_fetch_assoc($result)){
            $output.="<option>".$rows['subjects']."</option>";
        }
        exit($output);
        }
        else{
            exit('No result Found');
        }
    }
}
if(isset($_POST['getQuestion'])){
    $faculty=$_POST['faculty'];
    $semester=$_POST['semester'];
    $subject=$_POST['subject'];
    $query="select * from question where qfaculty='$faculty' and    qsemester='$semester' and qsubject='$subject'";
    if($result=mysql_query($query)){
      if(mysql_num_rows($result)>0){
          $output="";
          while($rows=mysql_fetch_assoc($result)){
              $output.="<div class='papers'><div class='qimgcover'>
                <img id=".$rows['qid']." src=".$rows['qpath']."></div>
                <date>".$rows['year']."</date>
            </div>";
          }
          exit($output);
      }    
        else{
            exit('empty');
        }
    }
    
}
if(isset($_POST['qname'])){
    $name=$_POST['name'];
    $query="select students_info.name from students_info,question where question.qid='$name' and question.id=students_info.uid";
    if($result=mysql_query($query)){
        $output=mysql_result($result,0,'name');
        exit($output);
    }
    else{
        exit(mysql_error());
    }
}
if(isset($_POST['searchResult'])){
   $name = mysql_real_escape_string($_POST['name']);
    $username=$_POST['username'];
   $query= "select profilepic,name,uid,faculty,sem from students_info where name like '$name%' LIMIT 0,5";
    if($result=mysql_query($query)){
        $output="";
        if(mysql_num_rows($result)>0){
            while($rows=mysql_fetch_assoc($result)){
                 $output.="<a href='search_result.php?id=".$rows['uid']."'><div class='search-container'>
            <div class='simgcover listcontainer'>
                <img src='".$rows['profilepic']."'>
            </div>
                <div class='listcontainer detail'><span><b>".$rows['name']." </b> [".$rows['faculty']." - ".$rows['sem']."]</span></div>
            </div></a><br><hr style='margin:1px;' size='1px' color='#ccc'>";
			}
			$output.="<a href='search_page.php?name=$name'><div class='search-container' style='font-size:15px'>
                <div class='listcontainer detail'><span><i class='fa fa-search'></i> Search for ".$name."</span></div>
            </div></a><br><hr style='margin:1px;' size='1px' color='#ccc'>";
           exit($output);
        }
        else{
            exit('No result Found');
        }
    }
}
if(isset($_POST['searchName'])){
   $name = mysql_real_escape_string($_POST['name']);
   $query= "select profilepic,name,uid from students_info where name like '%$name%' ";
    if($result=mysql_query($query)){
        $output="";
        if(mysql_num_rows($result)>0){	 
            while($rows=mysql_fetch_assoc($result)){
			  if($rows['uid']!=$_SESSION['id']){	
			   $output.='<div class="namelist" id="'.$rows['uid'].'">
                    <span>'.$rows['name'].'</span>
                    <div class="simgcover"><img src="'.$rows['profilepic'].'"></div>
                </div>';
			 }
			}			
           exit($output);
        }
        else{
            exit('No result Found');
        }
    }
}
if(isset($_POST['postMessage'])){
	$username=$_POST['username'];
	$text=$_POST['text'];
	$receiver_id=$_POST['id'];
	$sender_id=$_SESSION['id'];
	$query="INSERT INTO cht_chat(
						messageId,
						username,
						text,
						insertDate,
						sender_id,
						receiver_id
					)
					VALUES(
						uuid(),
						'$username',
						'$text',
						CURRENT_TIMESTAMP,
						'$sender_id',
						'$receiver_id'
					)";
    $q2="replace into conversation_list (user_id,chat_with,c_time) values ('$sender_id','$receiver_id',CURRENT_TIMESTAMP)";
    $q3="replace into conversation_list (user_id,chat_with,c_time) values ('$receiver_id','$sender_id',CURRENT_TIMESTAMP)";	
	if(mysql_query($query) and mysql_query($q2) and mysql_query($q3)){
		$q4="select conversation_list.chat_with, conversation_list.c_time,students_info.profilepic, students_info.name,conversation_list.* 
		         from conversation_list,students_info where  conversation_list.user_id='$sender_id' and
                  students_info.uid=conversation_list.chat_with order by c_time desc";
				  if($result=mysql_query($q4)){
                if(mysql_num_rows($result)>0){
					 $output="";
                    while($rows=mysql_fetch_assoc($result)){
                        $output.='<div class="messenger" id="'.$rows['chat_with'].'">
           <table border="0px">
               <tr><td class="imgtd"><div class="msgimgcover"><img src="'.$rows['profilepic'].'"></div></td><td><b>'.$rows['name'].'</b></td>
               </tr>
            </table>
        </div>
        <hr style="margin:0 0 0 4px;" size="1" color="#ccc">';
                    }
					exit($output);
                }
                else{
                    echo "<center class='empty'>No Conversations</center>";
                }
            }
	}	
    else{
		exit('Error');
	}	
}
?>