<?php
    include_once("Db.php");

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
        // REGISTER
        
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
        // LOGIN
        
        // GET ID BY EMAIL
        public function getIdByEmail(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $statement->bindValue(":email", $this->getEmail());
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
        // GET ID BY EMAIL
    }
?>