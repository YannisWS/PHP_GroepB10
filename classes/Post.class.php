<?php

    include_once("Db.php");
    include_once("Hashtag.class.php");

    class Post {
        private $id;
        private $userId;
        private $description;
        private $imagepath;
        private $imagecolor;
        private $filter;
        private $location;
        private $locationname;
        private $dateadd;
        private $dateremove;

        /**
         * @param mixed $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * @param mixed $userId
         */
        public function setUserId($userId) {
            $this->userId = $userId;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description) {
            if( empty( $description ) ) {
                throw new Exception( "Please fill in a description about your post." );
            }

            $this->description = $description;
        }

        /**
         * @param mixed $imagePath
         */
        public function setImagePath($imagepath) {
            if( empty( $imagepath ) ) {
                throw new Exception( "Please choose a photo to upload." );
            }

            $this->imagePath = $imagepath;
        }

        /**
         * @param mixed $imageColor
         */
        public function setImageColor($imagecolor) {
            $this->imagecolor = $imagecolor;
        }

        /**
         * @param mixed $filter
         */
        public function setImageFilterId($filter) {
            $this->filter = $filter;
        }

        /**
         * @param mixed $location
         */
        public function setLocation($lat,$lng) {
            $this->location = $lat . "," . $lng;
        }

        /**
         * @param mixed $locationName
         */
        public function setLocationName($locationname) {
            $this->locationname = $locationname;
        }

        /**
         * @param mixed $dateAdded
         */
        public function setDateAdded($dateadd) {
            $this->dateadd = $dateadd;
        }

        /**
         * @param mixed $dateDeleted
         */
        public function setDateDeleted($dateremove) {
            $this->dateremove = $dateremove;
        }

        /**
         * @return mixed
         */
        public function getUserId() {
            return $this->userId;
        }

        /**
         * @return mixed
         */
        public function getDescription() {
            return $this->description;
        }

        /**
         * @return mixed
         */
        public function getImagePath() {
            return $this->imagepath;
        }

        /**
         * @return mixed
         */
        public function getImageColor() {
            return $this->imagecolor;
        }

        /**
         * @return mixed
         */
        public function getImageFilterId() {
            return $this->filter;
        }

        /**
         * @return mixed
         */
        public function getLocation() {
            return $this->location;
        }

        /**
         * @return mixed
         */
        public function getLocationName() {
            return $this->locationname;
        }

        /**
         * @return mixed
         */
        public function getDateAdded() {
            return $this->dateadd;
        }

        /**
         * @return mixed
         */
        public function getDateDeleted() {
            return $this->dateremove;
        }

        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }


        /** Get post info from database */
        public function getPostData() {
            $conn = Db::getInstance();

            // Select from database
            $statement = $conn->prepare("SELECT posts.id as postId, posts.userId, posts.description, posts.imagePath, posts.imageFilterId, posts.location, posts.locationName, posts.dateAdded, posts.dateDeleted, users.username, users.firstName, users.lastName, users.avatarPath, ( SELECT filters.class FROM filters WHERE filters.id = posts.imageFilterId ) as imageFilterClass FROM posts, users WHERE posts.id = :id OR posts.imagePath = :imagePath");
            $statement->bindValue(":id", $this->getId() );
            $statement->bindValue(":imagePath", $this->getImagePath() );
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);

            return $result;
        }



        /** Add post to database */
        public function add() {
            $conn = Db::getInstance();

            // Add to database
            $statement = $conn->prepare("INSERT INTO posts (userId, description, imagePath, imageFilterId, location, locationName) VALUES (:userId, :description, :imagePath, :imageFilterId, :location, :locationName)");
            $statement->bindValue(":userId", $this->getUserId());
            $statement->bindValue(":description", $this->getDescription());
            $statement->bindValue(":imagepath", $this->getImagePath());
            $statement->bindValue(":filter", $this->getImageFilterId());
            $statement->bindValue(":location", $this->getLocation());
            $statement->bindValue(":locationname", $this->getLocationName());
            $statement->execute();

            return $conn->lastInsertId();
        }

        public function update() {
            $conn = Db::getInstance();

            $statement = $conn->prepare("UPDATE posts SET description = :description WHERE id = :id");
            $statement->bindValue( ":id", $this->getId());
            $statement->bindValue( ":description", $this->getDescription());
            return $statement->execute();
        }

        /** Get all posts info from database */
        public function getAllPostData($offset = 0) {
            $conn = Db::getInstance();

            if( empty( $offset ) || $offset < 0 ) {
                $offset = 0;
            }

        }


        /** Get all posts info from database */
        public function getAllPosts() {
            $conn = Db::getInstance();

            // Select all posts from database
            $statement = $conn->prepare("SELECT posts.id as postId, posts.userId, posts.description, posts.imagePath, posts.imageFilterId, posts.location, posts.locationName, posts.dateAdded, users.username, users.firstName, users.lastName, users.avatarPath, ( SELECT filters.class FROM filters WHERE filters.id = posts.imageFilterId ) as imageFilterClass FROM posts, users WHERE posts.userId = users.id AND posts.dateDeleted = '0000-00-00 00:00:00' ORDER BY posts.dateAdded DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }

        public function deletePost()
        {
            $conn = Db::getInstance();

            // Delete from database
            $statement = $conn->prepare("UPDATE posts SET dateDeleted = :dateDeleted WHERE id = :id");
            $statement->bindValue(":dateDeleted", strftime( "%Y-%m-%d %H:%M:%S" ));
            $statement->bindValue(":id", $this->getId());
            $result = $statement->execute();

            //$statement = $conn->prepare("SELECT imagePath FROM posts WHERE id = :id");
            //$statement->bindValue(":id", $this->getId());
            //$result = $statement->fetchAll(PDO::FETCH_OBJ);

            //$postImage = new PostImage();
            //$postImage->delete($result);

            return $result;
        }


    }

?>