<?php
    class Feed{
        private $feed;
        private $f;
        private $friends;

        public function getFeed(){
            return $this->email;
        }
        
        public function setFeed($feed){
            $this->feed = $feed;
            return $this;
        }
        
        public function GetFriends(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
                SELECT friend_id
                FROM friendlist
                WHERE friendlist.user_id = :user
                ");
//            $statement->bindValue(":user", $this->feed);
			$statement->bindValue(":user", $_SESSION['user']);
            $statement->execute();
//			$friends = $statement->fetch(PDO::FETCH_ASSOC);;
			$friends = $statement->fetchAll();
			
            return $friends;
        }

        public function createFeed(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
                SELECT *
                FROM posts
                WHERE posts.post_user_id = :friends
                ORDER BY date DESC
                LIMIT 20
                ");
            $statement->bindValue(":friends", $this->GetFriends()); //LOOP ???
            $statement->execute();
			$f = $statement->fetch(PDO::FETCH_ASSOC);
			//$feed = $statement->fetchAll();
            return $f;
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