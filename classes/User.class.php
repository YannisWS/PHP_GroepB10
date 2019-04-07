<?php
 
    class User {
        private $email;
        private $password;
        private $passwordConfirmation;
 
 
        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }
 
        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail($email)
        {
                $this->email = $email;
 
                return $this;
        }
 
        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }
 
        /**
         * Set the value of password
         *
         * @return  self
         */
        public function setPassword($password)
        {
                $this->password = $password;
 
                return $this;
        }
 
        /**
         * Get the value of passwordConfirmation
         */
        public function getPasswordConfirmation()
        {
                return $this->passwordConfirmation;
        }
 
        /**
         * Set the value of passwordConfirmation
         *
         * @return  self
         */
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;
 
                return $this;
        }

        public function register()
        {
          $options = [
          'cost' => 14, //als je het leeg laat dus geen salt , dan gaat php een random salt meegeven per gebruiker -> veiliger
          //cost => 12 geet 12 md5s rond een md5. (of 2^12 keer iets hashen) cost=> 16 geeft 16 md5s rond een md5 (of2 ^16 x iets hashen),enzovoort...
          ];
          $password = password_hash($this->password , PASSWORD_DEFAULT , $options); //vraag voor het examen = leg bcrypt uit
          try{
             $conn = new PDO("mysql:host=localhost;dbname=netflix;","root","root", NULL);
             $statement = $conn->prepare("INSERT into users (email,  password) VALUES (:email,:password)");
             $statement->bindParam(":email", $this->email);
             $statement->bindParam(":password",$password); //geen this hier omdat je de gehashte passwoord wilt gebruiken
             $result = $statement->execute();
             return $result;
          } catch (Throwable $t) {
            return false;
           }
        }
    }