<?php
    class Feed{
        
        public function getFeed(){
            return $this->feed;
        }

        public function SetFeed($feed){
            $this->feed = $feed;
            return $this;
        }

        public function createFeed(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
                SELECT friendlist.user_id, friendlist.friend_id, posts.id, posts.posts_user_id, posts.file_location, posts.date
                FROM posts, friendlist
                
                INNER JOIN friendlist
                ON posts.posts_user_id=friendlist.user_id
                
                WHERE friendlist.:user = friendlist.user_id
                LIMIT 20
                ORDER BY date DESC
                ");
            
            $statement->bindValue(":user", $this->getFeed());
            $statement->execute();
            $feed = $statement->fetchAll();
            return $feed;
        }
    }

/*
- user id van session nemen
- vrienden uit 'friedlist' halen
- 20 laatste posts nemen van alle vrienden
- 'file_location' + 'id' van posts terugsturen naar index.php
*/


//SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
//FROM Orders
//INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;