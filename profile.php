<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("classes/User.class.php");
include_once("classes/Post.class.php");

$post = new Post();
$user = new User();

if(isset($_GET['user'])){
    $id=$_GET['user'];
}
else{
    
}


?><!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
 
 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<title>Instavibes</title>
</head>
<body>   

  <div class="profile_user" id="user_<?php echo $_GET['user'];?>">
              <div class="blue_container"></div>
            
    
              
             
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="lib/js/follow.js"></script>

<script src="lib/js/like.js"></script>
</body>
</html>