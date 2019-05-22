<?php
	if(!empty($_POST)){
        
        $userId = $_POST['userId'];
        $postId = $_POST['postId'];
		$text = $_POST['text'];
		
		//include("../bootstrap.php"); //Deze jongen doet ambetant :(
        
        try{
            $comment = new Comment();
            $comment->setUserId($userId);
            $comment->setPostId($postId);
			$comment->setText($text);
            $comment->save();
            
            $result = [
                "status" => "success",
                "message" => "Comment Saved"
            ];
        }
		catch(Throwable $t){
            $result = [
                "status" => "error",
                "message" => "Plz try again"
            ];
        }
		finally{
            $result = [
				"status" => "success",
				"message" => ">Comment has been saved"
			];
			echo json_encode($result);
        }
    };