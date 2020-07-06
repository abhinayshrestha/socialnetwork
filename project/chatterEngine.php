<?php
     ob_flush();
	class Chatter{
		//change this according to your database setup
		protected $server = 'localhost';
		protected $username = 'root';
		protected $password = '';
		protected $database = 'myproject';
		//leave this as our database connection later
		protected $connection = null;
	
		public function __construct(){
			$this->connection = @mysql_connect($this->server, $this->username, $this->password);
			if($this->connection){
				if(!mysql_select_db($this->database)) die('database not found');
			}
			else die('database connection failed. Check your setup');
			
			$mode = $this->fetch('mode');
			
			switch($mode){
				case 'get':
					$this->getMessage();
					break;
				case 'post':
					$this->postMessage();
					break;
				default:
					$this->output(false, 'Wrong mode.');
					break;
			}
			
			return;
		}
				
		protected function getMessage(){
			$endtime = time() + 20;
			$lasttime = $this->fetch('lastTime');
			$sender = $this->fetch('sender');
			$receiver = $this->fetch('receiver');
			$curtime = null;
					
			while(time() <= $endtime){
				$rs = mysql_query("
					SELECT cht_chat.* 
					FROM cht_chat where cht_chat.sender_id='$sender' 
					and cht_chat.receiver_id='$receiver' or cht_chat.sender_id='$receiver' and cht_chat.receiver_id='$sender'
					
					ORDER BY insertDate desc
					LIMIT 0, 30
				");
				
				if($rs){
					$messages = array();
					
					while($row = mysql_fetch_array($rs)){
						$messages[] = array(
							'user' => $row['username'],
							'text' => $row['text'],
							'time' => $row['insertDate'],
							'sender' => $row['sender_id'],
							'receiver' => $row['receiver_id']
						);
					}
					
					$curtime = strtotime($messages[0]['time']);
				}
				
				if(!empty($messages) && $curtime != $lasttime){
					$this->output(true, '', array_reverse($messages), $curtime);
					break;
				}
				else{
					sleep(3);
				}
			}
		}
		
		protected function postMessage(){
			$user = $this->fetch('user');
			$text = $this->fetch('text');
			$sender = $this->fetch('sender');
			$receiver = $this->fetch('receiver');
			if(empty($user) || empty($text)){
				$this->output(false, 'Username and Chat Text must be inputted.');
			}
			else{
				$rs = mysql_query("
					INSERT INTO cht_chat(
						messageId,
						username,
						text,
						insertDate,
						sender_id,
						receiver_id
					)
					VALUES(
						uuid(),
						'$user',
						'$text',
						CURRENT_TIMESTAMP,
						'$sender',
						'$receiver'
					)
				");
				
				if($rs){
					$this->output(true, '');
				}
				else{
					$this->output(false, 'Chat posting failed. Please try again.');
				}
			}
		}
		
		protected function fetch($name){
			$val = isset($_POST[$name]) ? $_POST[$name] : '';
			return mysql_real_escape_string($val, $this->connection);
		}
		
		protected function output($result, $output, $message = null, $latest = null){
			echo json_encode(array(
				'result' => $result,
				'message' => $message,
				'output' => $output,
				'latest' => $latest
			));
		}
	}
	
	new Chatter();