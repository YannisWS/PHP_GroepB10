<?php
    include_once("Db.class.php");

    class User {
        private $email;
        private $password;
        private $passwordConfirmation;
        private $firstname;
        private $lastname;
        private $avatar;
        private $bio;
        
        // EMAIL
        public function getEmail(){
            return $this->email;
        }
        
        public function setEmail($email){
            $this->email = $email;
            return $this;
        }
        
        // PASSWORD
        public function getPassword(){
            return $this->password;
        }
        
        public function setPassword($password){
            $this->password = $password;
            return $this;
        }
        
        // PASSWORD CONFIRM
        public function getPasswordConfirmation(){
            return $this->passwordConfirmation;
        }
 
        public function setPasswordConfirmation($passwordConfirmation){
            $this->passwordConfirmation = $passwordConfirmation;
            return $this;
        }
        
        // FIRST NAME
        public function setFirstname($firstname){
            $this->firstname = $firstname;
            return $this;
        }
 
        public function getFirstname(){
            return $this->firstname;
        }
        
        // LAST NAME
        public function setLastname($lastname){
            $this->lastname = $lastname;
            return $this;
        }
 
        public function getLastname(){
            return $this->lastname;
        }
        
        // AVATAR
        public function setAvatar($avatar){
            $this->avatar = $avatar;
            return $this;
        }
 
        public function getAvatar(){
            return $this->avatar;
        }
        
        // BIO
        public function setBio($bio){
            $this->bio = $bio;
            return $this;
        }
 
        public function getBio(){
            return $this->bio;
        }

        public function setId($id)
        {
                $this->id = $id;
    
                return $this;
        }
        
        public function getId()
        {
                return $this->id;
        }
        
        // REGISTER
        public function register(){
            $options = ['cost' => 14,];
            $password = password_hash($this->password , PASSWORD_DEFAULT , $options);

            try{
                $conn = Db::getInstance();
                $statement = $conn->prepare("INSERT INTO users (email,  password, firstname, lastname, avatar, bio) VALUES (:email,:password,:firstname,:lastname,:avatar,:bio)");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password",$password);
                $statement->bindParam(":firstname",$this->firstname);
                $statement->bindParam(":lastname",$this->lastname);
                $statement->bindParam(":avatar",$this->avatar);
                $statement->bindParam(":bio",$this->bio);
                $result = $statement->execute();
                return true;
                
            }catch (Throwable $t){
                return false;
            }
        }
        
        // LOGIN
        public function login(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $this->getEmail());
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            if($result){
                if(password_verify($this->password, $result->password)){
                    return true;
                }
                else{
                    //return false;
                    throw new Exception("Password incorrect");
                 }
            }
            else{
                throw new Exception("This username does not exist");
                return false;
            }
        
        }
        
        // GET ID BY EMAIL
        public function getIdByEmail(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $statement->bindValue(":email", $this->getEmail());
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

		
		// Merge TestAmelie - Master
        
		public function getDetails(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE id = :id");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            
            return $result;
    
        }
    
        public function Followers(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `followers` WHERE follower_id = :id AND status=1");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            
            return $statement;
        }
    
        public function GetFollowers(){
            $statement = $this->Followers();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result;
        }
    
        public function getFollowersAmount(){
            $statement = $this->Followers();
            $amount=$statement->rowCount();
            return $amount;
            
        }
    
        public function loggedInUser(){
            $id = $_SESSION["user"];
            return $id;
        }
    
        //wanneer op follow-btn wordt geklikt-> nieuwe rij in tabel followers
        public function newFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO followers(user_id,follower_id,status) VALUES (:userId, :followerId, 1)");
            $statement->bindValue(":followerId", $this->loggedInUser());
            $statement->bindValue(":userId", $this->getId());
            $statement->execute();
            
            return $statement;
        }
    
        public function editFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE followers SET status = :status WHERE user_id=:userId AND follower_id=:followerId ");
            $statement->bindValue(":followerId", $this->loggedInUser());
            $statement->bindValue(":userId", $this->getId());
            $statement->bindValue(":status",$this->getFollowStatus());
            $statement->execute();
            return $statement;
        }
        
        
    
        //kijken of je de user al volgt, geeft aantal rijen terug. Als het geen rijen terug geeft -> volg je de user nog niet
        public function checkFollower(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM followers WHERE user_id=:id AND follower_id= :id2 AND status=1");
            $statement->bindValue(":id2", $this->loggedInUser());
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $amount=$statement->rowCount();;
            return $amount;
        }
    
        public function existFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM followers WHERE user_id=:id AND follower_id= :id2");
            $statement->bindValue(":id2", $this->loggedInUser());
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $amount=$statement->rowCount();
            return $amount;
        }
        
    
    
        public function editUser(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, avatar = :avatar, bio = :bio WHERE id = :id");
            $statement->bindValue(":firstname", $this->getFirstName());
            $statement->bindValue(":lastname", $this->getLastName());
            $statement->bindValue(":avatar", $this->getAvatar());
            $statement->bindValue(":bio", $this->getBio());
            $statement->bindValue(":id", $this->loggedInUser());
            $result = $statement->execute();
            return $result;
        }
        
        public function editSecurity(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
            $statement->bindValue(":email", $this->getEmail());
            $statement->bindValue(":password", $this->getPassword());
            $statement->bindValue(":id", $this->loggedInUser());
            $result = $statement->execute();
            return $result;
        }
    
    	/* find friends name to live tag them*/   
        public function findUser(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT users.username FROM users, followers WHERE users.id= followers.user_id AND followers.follower_id=7 AND followers.user_id IN( SELECT users.id FROM users WHERE username LIKE :search)");
            $statement->bindValue(":search", $this->getSearch());
            
            $statement->execute();
            $result =$statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        
}
?>