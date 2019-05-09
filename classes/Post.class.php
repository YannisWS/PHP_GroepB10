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
        private $dateadd;
        private $dateremove;

       // ID
        public function setId($id) {
            $this->id = $id;
        }
		
		public function getId() {
            return $this->id;
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
                throw new Exception( "Please fill in a description about your post." );
            }
            $this->description = $description;
        }
		
		public function getDescription() {
            return $this->description;
        }

        // IMAGE PATH
        public function setImagePath($imagepath) {
            if( empty( $imagepath ) ) {
                throw new Exception( "Please choose a photo to upload." );
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

        // LOCATION NAME ??????????????????????????????????????????????????????????
        public function setLocationName($locationname) {
            $this->locationname = $locationname;
        }
		
		public function getLocationName() {
            return $this->locationname;
        }

        // DATE ADDED
        public function setDateAdded($dateadd) {
            $this->dateadd = $dateadd;
        }
		
		public function getDateAdded() {
            return $this->dateadd;
        }

        // DATE DELETED
        public function setDateDeleted($dateremove) {
            $this->dateremove = $dateremove;
        }
		
		public function getDateDeleted() {
            return $this->dateremove;
        }

        // SELECT FROM DATABASE
        public function getPostData() {
            $conn = Db::getInstance();

            $statement = $conn->prepare("SELECT posts.id as postId, posts.userId, posts.description, posts.imagePath, posts.imageFilterId, posts.location, posts.locationName, posts.dateAdded, posts.dateDeleted, users.username, users.firstName, users.lastName, users.avatarPath, ( SELECT filters.class FROM filters WHERE filters.id = posts.imageFilterId ) as imageFilterClass FROM posts, users WHERE posts.id = :id OR posts.imagePath = :imagePath");
            $statement->bindValue(":id", $this->getId() );
            $statement->bindValue(":imagePath", $this->getImagePath() );
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);

            return $result;
        }

        public function moveImage(){
            $fileName=$_FILES["file"]["name"];
            $fileTmpName=$_FILES["file"]["tmp_name"];
            $imagepath= "img/post/" . $_SESSION['user']."-" . time().".jpg";
            $fileExt=explode(".",$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('jpg','jpeg','png');
            if(in_array($fileActualExt,$allowed)){
                move_uploaded_file($fileTmpName, $imagepath);
                $this->cropimage($imagepath,"400");
    
                $this->imagepath=$imagepath;
    
    
            }
            else{
                throw new exception("Oops you can't upload that file type");
    
            }    
    
        }

        private function cropimage($file,$maxresolution){

            if(file_exists($file)){
                $originalimage=imagecreatefromjpeg($file);
                $originalwidth=imagesx($originalimage);
                $originalheight=imagesy($originalimage);
    
                //try max width
                if($originalheight>$originalwidth) {
                    $ratio = $maxresolution / $originalwidth;
                    $newwidth = $maxresolution;
                    $newheight = $originalheight * $ratio;
    
                    $verschil=$newheight-$newwidth;
    
                    $x=0;
                    $y= round($verschil/2);
                }
    
                else
    
                //als da ni werkt
                {
                    $ratio=$maxresolution/$originalheight;
                    $newheight=$maxresolution;
                    $newwidth=$originalwidth*$ratio;
    
                    $verschil=$newwidth-$newheight;
    
                    $x=round($verschil/2);
                    $y= 0;
                }
    
                if($originalimage){
                    $newimage=imagecreatetruecolor($newwidth,$newheight);
                    imagecopyresampled($newimage,$originalimage,0,0,0,0,$newwidth,$newheight,$originalwidth,$originalheight);
    
                    $newcropimage=imagecreatetruecolor($maxresolution,$maxresolution);
                    imagecopyresampled($newcropimage,$newimage,0,0,$x,$y,$maxresolution,$maxresolution,$maxresolution,$maxresolution);
    
                    imagejpeg($newcropimage,$file,90);
                }
            }
    
        }


        // ADD POST TO DATABASE
        public function add() {
            $conn = Db::getInstance();

            $statement = $conn->prepare("
                INSERT INTO posts (post_user_id, description, file_location, filter, location, date) 
                VALUES (:userId, :description, :imagepath, :filter, :location, :date)
                ");
            $statement->bindValue(":userId", $this->getUserId());
            $statement->bindValue(":description", $this->getDescription());
            $statement->bindValue(":imagepath", $this->getImagePath());
            $statement->bindValue(":filter", $this->getImageFilterId());
            $statement->bindValue(":location", $this->getLocation());
            $statement->bindValue(":date", strftime( "%Y-%m-%d %H:%M:%S" ));
            $statement->execute();

            return $conn->lastInsertId();
        }
		
		// UPDATE POST IN DATABASE
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
		
		//DELETE POST FROM DATABASE
        public function deletePost(){
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