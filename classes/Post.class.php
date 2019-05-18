<?php
    include_once("Db.class.php");

    class Post {
        private $id;
        private $userId;
        private $description;
        private $imagepath;
        private $imagecolor;
        private $filter;
        private $location;
        private $locationname;
        private $dateAdd;
        private $dateremove;

       // ID
        public function setId($id) {
            $this->id = $id;
        }
		
		public function getId() {
//            return $this->id;
            return (int)$this->id;
        }
		
		// USER ID
        public function setUserId($userId) {
            $this->userId = $userId;
        }
		
		public function getUserId() {
            return $this->userId;
        }

        // DESCRIPTION
        public function setDescription($description) {
            if( empty( $description) ) {
                return false;
            }
            $this->description = $description;
        }
		
		public function getDescription() {
            return $this->description;
        }

        // IMAGE PATH
        public function setImagePath($imagepath) {
            if( empty( $imagepath ) ) {
                return false;
            }
            $this->imagePath = $imagepath;
        }
		
		public function getImagePath() {
            return $this->imagepath;
        }

        // IMAGE COLOR
        public function setImageColor($imagecolor) {
            $this->imagecolor = $imagecolor;
        }
		
		public function getImageColor() {
            return $this->imagecolor;
        }

        // IMAGE FILTER
        public function setImageFilterId($filter) {
            $this->filter = $filter;
        }
		
		public function getImageFilterId() {
            return $this->filter;
        }

        // LOCATION
        public function setLocation($location) {
            $this->location = $location;
        }
		
		public function getLocation() {
            return $this->location;
        }

        // DATE ADDED
        public function setDate($dateAdd) {
            $this->dateAdd = $dateAdd;
        }
		
		public function getDate() {
            return $this->$dateAdd;
        }

        // SELECT POST FROM DATABASE
        public function getPostData() {
            $conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $statement = $conn->prepare("
				SELECT *
                FROM posts
                INNER JOIN users
                ON posts.post_user_id = users.id
                WHERE posts.id = :id
				");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $result = $statement->fetchAll();
			
            return $result;
        }
		
		public function getUsername(){
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $statement = $conn->prepare("
				SELECT firstname, lastname
                FROM users
                WHERE id = :id
				");
            $statement->bindValue(":id", $_SESSION['user']);
            $statement->execute();
            $result = $statement->fetchAll();
			
            return $result;
		}
        
        // SELECT COMMENTS FROM DATABASE
        public function getComments() {
            $conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $statement = $conn->prepare("
				SELECT *
                FROM comments
                INNER JOIN users
                ON comments.comment_user_id = users.id
                WHERE comments.comment_post_id = :id
				");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $result = $statement->fetchAll();
			
            return $result;
        }
		
		// UPLOAD IMAGE
        public function moveImage() {
            $fileName = $_FILES["file"]["name"];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $imagepath = "img/post/" . $_SESSION['user']."-" . time().".jpg";
            $fileExt = explode(".",$fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png');
            if(in_array($fileActualExt,$allowed)){
                move_uploaded_file($fileTmpName, $imagepath);
    
                $this->imagepath = $imagepath;
            }
            else{
                return false;
            }    
        }

        // ADD POST TO DATABASE
        public function add() {
            $conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $statement = $conn->prepare("
                INSERT INTO posts (post_user_id, description, file_location, filter, location, date) 
                VALUES (:userId, :description, :imagepath, :filter, :location, :date)
                ");
            $statement->bindValue(":userId", $this->getUserId());
			$statement->bindValue(":userId", $_SESSION['user']);
            $statement->bindValue(":description", $this->getDescription());
            $statement->bindValue(":imagepath", $this->getImagePath());
            $statement->bindValue(":filter", $this->getImageFilterId());
            $statement->bindValue(":location", $this->getLocation());
            $statement->bindValue(":date", strftime( "%Y-%m-%d %H:%M:%S" ));
            $statement->execute();

            return true;

//			var_dump($_SESSION['user']);
//			var_dump($this->getDescription());
//            var_dump($this->getImagePath());
//            var_dump($this->getImageFilterId());
//            var_dump($this->getLocation());
//            var_dump(strftime( "%Y-%m-%d %H:%M:%S" ));
			
//			$statement->bindValue(":userId", $this->getUserId()); 	NOT WORKING, WHY?
//			$statement->bindValue(":userId", $_SESSION['user']);  	WORKING, WHY?
        }
		
		// UPDATE POST IN DATABASE
        public function update() {
            $conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $statement = $conn->prepare("UPDATE posts SET description = :description WHERE id = :id");
            $statement->bindValue( ":id", $this->getId());
            $statement->bindValue( ":description", $this->getDescription());
            return $statement->execute();
        }

        /** Get all posts info from database */
        public function getAllPosts() {
            $conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // Select all posts from database
            $statement = $conn->prepare("SELECT posts.id as postId, posts.userId, posts.description, posts.imagePath, posts.imageFilterId, posts.location, posts.locationName, posts.dateAdded, users.username, users.firstName, users.lastName, users.avatarPath, ( SELECT filters.class FROM filters WHERE filters.id = posts.imageFilterId ) as imageFilterClass FROM posts, users WHERE posts.userId = users.id AND posts.dateDeleted = '0000-00-00 00:00:00' ORDER BY posts.dateAdded DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }
    }
?>