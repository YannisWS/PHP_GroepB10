<?php
    class Feed{

        public function getFriendData(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
				SELECT *
                FROM posts
                LEFT JOIN friendlist ON friend_id = post_user_id
                WHERE user_id = :user
                ");
            $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);   
            $statement->execute();
            $result = $statement->fetchAll();
            
            return $result;

        }
        
        public function getFeedData() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("
				SELECT *
                FROM posts
				");
            $statement->execute();
            $result = $statement->fetchAll();
            
            return $result;

        }


        public function getOwnFeed(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
				SELECT *
                FROM posts
                WHERE post_user_id = :user
                ");
            $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);    
            $statement->execute();
            $result = $statement->fetchAll();
            
            return $result;


        }

    
        
    } 

/*
- user id van session nemen
- vrienden uit 'friedlist' halen
- 20 laatste posts nemen van alle vrienden
- 'file_location' + 'id' van posts terugsturen naar index.php
*/

//SELECT *
//FROM users, friendlist, posts
//WHERE posts.post_user_id = users.id && friendlist.user_id = users.id && friendlist.user_id = :user
//ORDER BY date DESC
//LIMIT 20