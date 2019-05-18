<?php
	class Comment{		
		
		private $postId;
		private $text;
		
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
			$statement->bindValue(":post_id", $this->getPostId());
			$statement->bindValue(":user_id", $_SESSION['user']);
			$statement->bindValue(":text", $this->getText());
			$statement->bindValue(":date", strftime("%Y-%m-%d %H:%M:%S"));
			$statement->execute();

            return true;    
		}
	}
?>