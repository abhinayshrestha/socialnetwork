<?php
    session_start();
    require "database_connect.php";
    if(isset($_POST['getData'])){
    $id=$_POST['id'];
        $name=$_POST['name'];
        $start=mysql_real_escape_string($_POST['start']);
    $query="select students_info.name,students_info.profilepic,newsfeed.* from students_info,newsfeed where id='$id' and students_info.uid = newsfeed.id
 order by postid desc LIMIT $start,3";
    if($result=mysql_query($query)){
        $output="";
        if(mysql_num_rows($result)>0){
            while($rows=mysql_fetch_assoc($result)){
                if($rows['type']=='p'){
                    $output.="<div class='infiniteimage'>
                <div class='imageboxtop'>
                <div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b>".$name."</b> <span>added a photo</span><date>".$rows['time']."</date>
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
					$q1="select students_info.name,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b>".$comment['name']."</b> ".$comment['comments']."</div>";
					}
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment' id='".$rows['postid']."'>Comment</button>
                </div></div>";
                }
                if($rows['type']=='s'){
                    $output.="<div class='infinitestatus'>
                    <div class='statusboxtop'>
                    <div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b>".$name."</b> <span>updated a status</span><date>".$rows['time']."</date>
                    </div>
                    <hr color='#ccc' style='margin: 0px' size='1px'>
                    <div class='status'>".$rows['value']."</div>
                    <div class='commentnav'>
                    <button class='showcomment'><i class='fa fa-comment-o'> </i> ".$rows['comments']." Comments <i class='fa fa-angle-double-down'></i></button><button class='hidecomment'>Hide Comments <i class='fa fa-angle-double-up'></i></button>
                    </div><div class='commentblock'>";
                    $pid=$rows['postid'];
					$q1="select students_info.name,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b>".$comment['name']."</b> ".$comment['comments']."</div>";
					}
                    else{
                        
                    }
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment' id='".$rows['postid']."'>Comment</button>
                    </div></div>";
                }
                if($rows['type']=='pp'){
                    $output.="<div class='infiniteimage'>
                <div class='imageboxtop'>
                <div class='img-logo'><img src=".$rows['profilepic']."></div>
                    <b>".$name."</b> <span>changed profile picture</span><date>".$rows['time']."</date>
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
					$q1="select students_info.name,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid order by commentid desc LIMIT 0,1";
					$r1=mysql_query($q1);
					if(mysql_num_rows($r1)>0){
					$comment=mysql_fetch_assoc($r1);
					$output.="<div class='comment'><b>".$comment['name']."</b> ".$comment['comments']."</div>";
					}
                    $output.="</div><div class='postcommentnav'>
                    <input type='text' class='commentvalue' placeholder='Comment.....' maxlength='50'>
                    <button class='postcomment' id='".$rows['postid']."'>Comment</button>
                </div></div>";
                }

            } 
            exit($output);
        }
        else{
            exit($output);
        }
    }
    else{
        exit(mysql_error());
    }
    }
   if(isset($_POST['loadComment'])){
       $pid=$_POST['pid'];
         $query="select students_info.name,comment.comments from comment,students_info where comment.siid='$pid' and
					comment.id=students_info.uid";
       if($rows=mysql_query($query)){
		  $output="";
		  while($result=mysql_fetch_assoc($rows)){
			  $output.="<div class='comment'><b>".$result['name']."</b> ".$result['comments']."</div>";
		  }
		  exit($output);
	  }				
	  exit('error');
}
if(isset($_GET['postComment'])){
       $comment=$_GET['comment'];
       $cid=$_GET['cid'];
       $id=$_SESSION['id'];
       $commented_on=$_GET['commentedOn'];
       $comment_count=$_GET['commentCount'];
	   $query="insert into comment(id,siid,comments) values ('$id','$cid','$comment')";
	   if(mysql_query($query)){
       $q1="update newsfeed set comments = '$comment_count'+1 where postid='$cid'";
       if(mysql_query($q1)){
		     $q2="insert into notification(commenter,commented_on,post) values('$id','$commented_on','$cid')";
               if($commented_on != $id){
                   mysql_query($q2);
                   $q3="update students_info set notifi=notifi+1 where uid='$commented_on'";
                    if(mysql_query($q3)){
                        //exit($commented);
                    }
               }
		  }	
	  }
}
if(isset($_POST['updateInfo'])){
      $date=$_POST['date'];
      $email=$_POST['email'];
      $newpassword=$_POST['newpassword'];
      $politicalview=$_POST['politicalview'];
      $religion=$_POST['religion'];
      $location=$_POST['location'];
      $fquote=$_POST['fquote'];
      $gender=$_POST['gender'];
      $id=$_SESSION['id'];
      $query="update students_info set gender='$gender', dob='$date', email='$email', password='$newpassword',      politicalview='$politicalview', religion='$religion', location='$location', quote='$fquote' where uid='$id'";
      if(mysql_query($query)){
          exit('success');
      }
}
if(isset($_POST['deleteid'])){
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $q="delete from conversation_list where user_id='$userid' and chat_with='$id' or user_id='$id' and chat_with='$userid'";
    mysql_query($q);
    $q1="delete from cht_chat where sender_id='$userid' and receiver_id='$id' or sender_id='$id' and receiver_id='$userid'";
    mysql_query($q1);    
}
if(isset($_POST['getNotifi'])){
    $id=$_SESSION['id'];
    $start=$_POST['notifiStart'];
    $q1="update students_info set notifi = 0 where uid='$id'";
    if(mysql_query($q1)){
        $q2="select students_info.profilepic, students_info.name,notification.date from students_info,notification where notification.commented_on='$id' and
        students_info.uid=notification.commenter order by notification.date desc limit 0,10";
        if($result=mysql_query($q2)){
            if(mysql_num_rows($result)>0){
                $output="";
                while($rows=mysql_fetch_assoc($result)){
                    $output.='<div class="notifi-list">
                    <div class="notifi-imagecover"><img src="'.$rows['profilepic'].'"></div><p> <b>'.$rows['name'].'</b> commented on your post. <date style="color:#a3a375; font-size:11px">['.$rows['date'].']</date></p></div>';
                }
                exit($output);
            }
            else{
                
            }
        }
    }
}
if(isset($_POST['loadNotifi'])){
    $id=$_SESSION['id'];
    $start=$_POST['notifiStart'];
    $q="select students_info.profilepic, students_info.name,notification.date from students_info,notification where notification.commented_on='$id' and
        students_info.uid=notification.commenter order by notification.date desc limit $start,10";
        if($result=mysql_query($q)){
            if(mysql_num_rows($result)>0){
                $output="";
                while($rows=mysql_fetch_assoc($result)){
                    $output.='<div class="notifi-list">
                    <div class="notifi-imagecover"><img src="'.$rows['profilepic'].'"></div><p> <b>'.$rows['name'].'</b> commented on your post. <date style="color:#a3a375; font-size:11px">['.$rows['date'].']</date></p></div>';
                }
                exit($output);
            }
            else{
                
            }
        }
}
?>