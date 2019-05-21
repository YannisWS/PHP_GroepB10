<?php
	class Comment{		
		
		private $userId;
		private $postId;
		private $text;
		
		// USER ID
		public function getUserId(){
			return $this->userId;
		}
		
		public function setUserId($userId){
			$this->userId = $userId;
			return $this;
		}
		
		// POST ID
		public function getPostId(){
			return $this->postId;
		}
		
		public function setPostId($postId){
			$this->postId = $postId;
			return $this;
		}
		
		// COMMENT
		public function getText(){
			return $this->text;
		}
		
		public function setText($text){
			$this->text = $text;
			return $this;
		}
		
		// ADD COMMENT TO DB
		public function save(){
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$statement = $conn->prepare("
				INSERT INTO comments (comment_user_id, comment_text, comment_post_id, comment_date) 
				VALUES (:user_id, :text, :post_id, :date)
				");
			$statement->bindValue(":user_id", $this->getUserId());
			$statement->bindValue(":post_id", $this->getPostId());
			$statement->bindValue(":text", $this->getText());
			$statement->bindValue(":date", strftime("%Y-%m-%d %H:%M:%S"));
			
//			var_dump($this->getUserId());
//			var_dump($this->getPostId());
//			var_dump($this->getText());
			
			return $statement->execute();
		}
	}
?>