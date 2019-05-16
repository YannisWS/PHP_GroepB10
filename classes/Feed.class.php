<?php
    class Feed{

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