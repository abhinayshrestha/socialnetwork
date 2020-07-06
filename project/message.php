<?php
session_start();
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
      header('Location: index.php');
  }
 else{
     $sender= $_SESSION['id'];
     require "database_connect.php"; 
	  $query="select * from students_info where uid='".mysql_real_escape_string($_SESSION['id'])."'";
	  if($result=mysql_query($query)){
		  if(mysql_num_rows($result)>0){
		       $name=mysql_result($result,0,'name');
               $assignment=mysql_result($result,0,'assignment');
			   $event=mysql_result($result,0,'event');
			   $notice=mysql_result($result,0,'notice');
              $faculty=mysql_result($result,0,'faculty');
		  }
		  else{
		   session_destroy(); 
		    header('Location: index.php');
			echo "<script>alert('Server Error Please Login Later')</script>";
		  }
	  }
	  else{
		 session_destroy(); 
		 header('Location: index.php');
		 echo "<script>alert('Server Error Please Login Later')</script>";
	  }
 }
  ?>
<html>
<head>
	<title>KccConnection - Message</title>
    <link rel="icon" href="webimages/icon.png">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <link href="css/message.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
</head>
<body>
    <div id="mwhitebody"></div><div id="showstatus"></div>
    <form id="msgform" method="post">
        <div class="header">To : <span class="msgto"></span><input type="text" id="to" autocomplete="off">
            <div class="searchresult">
            </div>
        </div>
        <hr color="#ccc" style="margin:3" size="1"> 
        <textarea id="msg"></textarea>
        <fieldset><input type="submit" value="Send">
            <button id="cancelmsg">Cancel</button>
            <span id="error"></span>
        </fieldset>
    </form>
    <div id='prompt'><p>Are you sure you want to delete this conversation??</p>
        <div><button id='delete'>OK</button> <button id='canceldelete'>Cancel</button></div>
    </div>
    <header>
	<ul>
        <li><a href="home.php" id="logo" title="kccConnection.com"> < KccConnection /></a></li>
        <li><input type="text" id="searchinput" placeholder="find friends" maxlength="30"><div class="searchresult">
            <!--<a href="#">
            <div class="simgcover listcontainer">
                <img src="a.jpg">
            </div>
                <div class="listcontainer detail"><span><b>Abhinay shrestha </b> [B.E Computer - V]</span></div>
            </a><br><hr style="margin:1px;" size="1px" color="#ccc">
            --></div>
	   <button id="search"><i class="fa fa-search"></i></button></li>    
	   <li class="left"><a id="home" href="home.php" title="Home"><i class="fa fa-home"></i></a></li>
	   <li class="left"><a href="profile.php" title="Profile"><i class="fa fa-user"></i></a></li>
	   <li class="left"><a id="message" href="message.php" title="Message"><i class="fa fa-envelope"><div id="mred" class="red">10</div></i></a></li>
	   <li class="left"><a href="#" title="Notification"><i class="fa fa-bell"><div id="nred" class="red">10</div></i></a></li>
	   <li class="left"><a href="log_out.php" title="Log out"><i class="fa fa-power-off"></i></a></li>
	</ul>
   </header>
    <div class="left-container">
        <h3><i class="fa fa-envelope"></i> Message List
         <button class="addmessage"><i class="fa fa-plus-square"></i> Compose message</button></h3>
        <hr style="margin:0;" size="1" color="#ccc">
        <div class="messenger-container">
        <?php
          $query="select conversation_list.chat_with, conversation_list.c_time,students_info.profilepic, students_info.name,conversation_list.* from conversation_list,students_info where  conversation_list.user_id='$sender' and
                  students_info.uid=conversation_list.chat_with order by c_time desc";
            if($result=mysql_query($query)){
                if(mysql_num_rows($result)>0){
                    while($rows=mysql_fetch_assoc($result)){
                        echo '<div class="messenger" id="'.$rows['chat_with'].'" role="button">
           <table border="0px">
               <tr><td class="imgtd"><div class="msgimgcover"><img src="'.$rows['profilepic'].'"></div></td><td><b>'.$rows['name'].'</b></td>
               </tr>
            </table>
        </div>
        <hr style="margin:0 0 0 4px;" size="1" color="#ccc">';
                    }
                }
                else{
                    echo "<center class='empty'>No Conversations</center>";
                }
            }
            
        ?>
        <!--<div class="messenger" id="01BEC2015">
           <table border="0px">
               <tr><td class="imgtd"><div class="msgimgcover"><img src="a.jpg"></div></td><td><b>Abhinay Shrestha</b></td>
               </tr>
            </table>
        </div>
        <hr style="margin:0 0 0 4px;" size="1" color="#ccc">
            <div class="messenger" id="02BEC2015">
           <table border="0px">
               <tr><td class="imgtd"><div class="msgimgcover"><img src="a.jpg"></div></td><td><b>Alisha Shrestha</b></td>
               </tr>
            </table>
        </div>
        <hr style="margin:0 0 0 4px;" size="1" color="#ccc">
            <div class="messenger" id="03BEC2015">
           <table border="0px">
               <tr><td class="imgtd"><div class="msgimgcover"><img src="a.jpg"></div></td><td><b>Roshan Shrestha</b></td>
               </tr>
            </table>
        </div>
        <hr style="margin:0 0 0 4px;" size="1" color="#ccc">-->
        </div>
        
    </div>
    <div class="chat-with"><h3></h3><i id='delconv' class="fa fa-trash"></i></div>
    <div class="chatMessageList" id="chatMessageList" ></div>
	<form action="chatterEngine.php" method="post" id="formPostChat">
		<fieldset>
			<textarea id="postText"></textarea>
		</fieldset>
		<fieldset>
			<input type="submit" value="Send" id="postMessage" />
		</fieldset>
	</form>
    <div class="right-container">
	   <div class="buttons"> 
	   <a role="button" href="assignment.php" class="info"><button id="assignment">Assignments<div id="ared" class="red"></div></button></a>
	   <a href="note.php" class="info"><button id="note">Notes</button></a>
	   <a href="event.php" class="info"><button id="event">Events<div id="eventred" class="red"></div></button></a>
	   <a href="questionbank.php" class="info"><button id="questionbank">QuestionBank</button></a>
	   <a href="notice.php" class="info"><button id="notice">Notices<div id="noticered" class="red"></div></button></a>
	    </div>
        <div id="chat">
           <div class="top"><img src="./webimages/university-logo.png"></div><hr color="#ccc" size="1" style="margin:0">
           <?php
            $connected = @fsockopen("www.google.com", 80); 
            $notices = 0;           
            if ($connected){
                include 'simple_html_dom.php';
	            $websiteurl1='http://puexam.edu.np/index.php?obj=all_events&category=E';
	            $websiteurl2='http://puexam.edu.np/index.php?obj=all_events&category=R';
	            $html1=file_get_html($websiteurl1);
	            $html2=file_get_html($websiteurl2);
	            $arr=array();
	            foreach($html1->find('strong') as $a){
		           if (strpos($a, $faculty)) {
                       ++$notices;
                       echo '<div class="unotice"><a href="http://puexam.edu.np/index.php?obj=exam_schedules" target="_blank"><i class="fa fa-forward"></i> '.$a.'</a></div><hr color="#ccc" size="1" style="margin:0">';
		           }
    	        }
	           foreach($html2->find('strong') as $b){
		           if (strpos($b, $faculty) !== false) {
                       ++$notices;
                      echo '<div class="unotice"><a href="http://www.puexam.edu.np/results/results.php?action=view&type=student" target="_blank"><i class="fa fa-forward"></i>'.$b.'</a></div><hr color="#ccc" size="1" style="margin:0">';
		          }
	            }
                if($notices==0){
                    echo "<div style='margin:10px; text-align:center; color:#aaa'>No Notice For You !!!<div>";
                }
               fclose($connected);
             }else{
            echo "<div style='margin:10px; text-align:center; color:#aaa'>No Connection !!!<div>";
            }
           ?>
           
	   </div>
	  </div>
    <script>
            var assignment= '<?php echo $assignment;?>';
			var event='<?php echo $event?>';
			var notice='<?php echo $notice?>';
			var assignmentcount=Number(assignment);
			var eventcount=Number(event);
			var noticecount=Number(notice);
			if(assignmentcount!=0){
				$('#ared').html(assignmentcount).show();
			}
			if(eventcount!=0){
				$('#eventred').html(eventcount).show();
			}
			if(noticecount!=0){
			    $('#noticered').html(noticecount).show();
			}
        var name='<?php echo $name?>';
        function Chatter(){
	this.getMessage = function(callback, lastTime){
		var t = this;
		var latest = null;
		
		$.ajax({
			'url': 'chatterEngine.php',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'get',
				'lastTime': lastTime,
				'sender': '<?php echo $sender?>',
				'receiver':receiver_id
			},
			'timeout': 1000,
            'async':true,
			'cache': false,
			'success': function(result){
				if(result.result){
					callback(result.message);
					latest = result.latest;
                    
				}	
                setTimeout(this.getMessage,1000);
			},
			'error': function(e){
				console.log(e);
			},
			'complete': function(){
				t.getMessage(callback, latest);
			}
		});
	};
	
	this.postMessage = function(user, text, callback,sender,receiver,name){
		$.ajax({
			'url': 'chatterEngine.php',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'post',
				'user': user,
				'text': text,
				'sender': sender,
				'receiver':receiver,
			},
			'success': function(result){
				callback(result);
			},
			'error': function(e){
				console.log(e);
			}
		});
	};
};

var c = new Chatter();

$(document).ready(function(){
    var nameList=$('.messenger-container .messenger');
    if(nameList.length==0){
        $('#chatMessageList').hide();
        $('#formPostChat').hide();
    }
    else{
        $('#chatMessageList').show();
        $('#formPostChat').show();
    }
    $('.addmessage').click(function(){
        $('#mwhitebody').show(0,function(){
           $('#msgform').show(); 
        });
    });
    $('#cancelmsg').click(function(e){
        e.preventDefault();
        $('#mwhitebody').hide(0,function(){
           $('#msgform').hide(); 
            return false;
        });
    });
    $('#msgform .searchresult').on('click','.namelist',function(){
        var name=$(this).find('span').html();
        msgId=$(this).attr('id');
        $('.header .msgto').html(name+' <i class="fa fa-times"></i>').show();
        $('.header input').css('visibility','hidden');
        $(this).parent().hide();
        $('.header input').val('');
        
    });
    $('#msgform .msgto').on('click','i',function(){
        $('#msgform .msgto').html('').hide();
        $('.header input').css('visibility','visible');
    });
    $('#to').keyup(function(){
        var name=$(this).val();
        if(name.length!=0){
            $.ajax({
                url : "infinite_newsfeed.php",
                method : "POST",
                dataType : "text",
                data : {
                    name :name,
                    searchName : 1
                 },
                success : function(data){
                    $('#msgform .searchresult').show(0,function(){
                                $(this).html(data); 
                    });
                 }
            });    
           }
          else{
               $('.searchresult').hide();
          }
    });
  
    $('.messenger-container').on('click','.messenger',function(){
        var cname=$(this).text();
        $('.chatMessageList').show();
         $('.chat-with').show(0,function(){
             $(this).children('h3').html(cname);
         });
        $('#chatMessageList').show();
        $('#formPostChat').show();
        $('.messenger').removeClass('state');
        $(this).addClass('state');
        receiver_id=$(this).attr('id');
        c.getMessage(function(message){
		var chat = $('#chatMessageList').empty();
		for(var i = 0; i < message.length; i++){
          if(message[i].sender=='<?php echo $sender?>')
              {
			chat.append(
				'<div class="chatMessage"><div class="floatright">' +
				'		<span class="chatUsername">' +'You' + '</span>' +
				'		<p class="chatText">' + message[i].text + '</p>' +
				'</div></div><br>'
			);
              }
            else{
              chat.append(
				'<div class="chatMessage"><div class="floatleft">' +
				'<span class="chatUsername">' + message[i].user + '</span>' +
				'		<p class="chatText">' + message[i].text + '</p>' +
				'</div></div><br>'
			);  
            }
		}
            $('.chatMessageList').scrollTop($('#chatMessageList')[0].scrollHeight);
      });
    });
    $('#postText').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#postMessage').click();
         }
    });
	$('#formPostChat').submit(function(e){
		e.preventDefault();
		var text = $('#postText');
		var err = $('#postError');
		var sender='<?php echo $sender?>';
		c.postMessage(name,text.val(), function(result){
			if(result){
				text.val('');
			}
			err.html(result.output);
		},sender,receiver_id);
	
		return false;
	});
    $('.messenger-container .messenger').first().trigger('click');
    $('#msgform').submit(function(e){
        e.preventDefault();
        var name=$('.msgto').text();
        var text=$('#msg').val();
        if(name.length!=0 && text.length!=0){
             $('#error').html('');
             $.ajax({
                  url : "infinite_newsfeed.php",
                  method : "POST",
                  dataType : "text",
                  data : {
                        postMessage : 1,
                        username : "<?php echo $name ?>",
                        text : text ,
                        id : msgId
                   },
                   success : function(data){
                    if(data=='error'){
                        $('#msgform').hide();
                        $('#showstatus').show().html("<center style='color:red'>Error Sending Message <i class='fa fa-times'></i></center>");
                        $('#showstatus').delay(1000).hide(0,function(){
                           $('#mwhitebody').hide();
                        $('#msg').val('');
                        $('#msgform .msgto').html('').hide();
                        $('.header input').val('').css('visibility','visible');    
                        });
                    }   
                    else{
                        $('#msgform').hide();
                        $('#showstatus').show().html("<center style='color:green'>Message Sent Successfully <i class='fa fa-check'></i></center>");
                        $('#showstatus').delay(1000).hide(0,function(){
                           $('#mwhitebody').hide(); 
                        });
                        $('#msg').val('');
                        $('#msgform .msgto').html('').hide();
                        $('.header input').val('').css('visibility','visible');
                        $('.messenger-container').html(data);
                        $('.messenger-container .messenger').first().trigger('click');
                    } 
                   }
             });
        }
        else{
          if(name.length==0){
              $('#error').html('* Add Recipient *');
          }   
          if(text.length==0){
              $('#error').html('* Enter some text *');
          }    
        }
        return false;
    });
    $('#delconv').click(function(){
       $('#mwhitebody, #prompt').show();
    });
    $('#canceldelete').click(function(){
       $('#mwhitebody, #prompt').fadeOut(200);
    });
    $('#delete').click(function(){
       deleteConv();
    });
});
    function deleteConv(){
       var a=$('.messenger');
       var id=a[0].id;
       $.ajax({
           url : 'dynamic_page_loader.php',
           method : 'POST',
           data : {
                 deleteid : 1,
                 id : id,
                 userid : "<?php echo $_SESSION['id']?>"
               },
           success : function(data){
                window.location.reload();
             }
       });    
    }    
    </script>
</body>
</html>