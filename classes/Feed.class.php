<?php
    class Project{
        public function getFeed(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("
                SELECT posts.id, posts.file_location 
                FROM posts
                INNER JOIN
                ON 
                ");
        
//SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
//FROM Orders
//INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;
        
            $statement->execute();
            $project = $statement->fetchAll();
            return $feed;
        }
    }