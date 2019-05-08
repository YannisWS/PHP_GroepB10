<?php
    class Feed{

        public function SetFeed($feed){
            $this->feed = $feed;
            return $this;
        }

        public function getFeed(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
                SELECT *
                FROM users, friendlist, posts
                
                INNER JOIN friendlist
				ON posts.posts_user_id = users.id
				
				INNER JOIN posts
                ON friendlist.user_id = users.id
                
                WHERE :user = friendlist.user_id
				ORDER BY date DESC
                LIMIT 20
                ");
            $statement->bindValue(":user", $this->getFeed());
            $statement->execute();
			$feed = $statement->fetch(PDO::FETCH_ASSOC);
			//$feed = $statement->fetchAll();
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
//INNER JOIN Customers 
//ON Orders.CustomerID=Customers.CustomerID;