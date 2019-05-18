<?php
    if(!empty($_POST)){
        //qvar_dump($_POST);
        
        $text = $_POST['text'];
        
        include("../bootstrap.php");
        
        try{
            $comment = new Comment();
            $comment->setText($text);
            $comment->save();
            
            $result = [
                "status" => "success",
                "message" => "Comment Saved"
            ];
        }catch(Throwable $t){
            $result = [
                "status" => "error",
                "message" => "Plz try again"
            ];
        }
  
        $result = [
            "status" => "success",
            "message" => ">Comment has been saved"
        ];
        
        echo json_encode($result);
    };
?>