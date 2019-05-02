<?php

spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

session_start(); 
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Instavibes</title>
</head>
<body>
<?php include('includes/header.inc.php') ?>
<div class="item clearfix">
         <div class="user">
             <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><img src="<?php echo htmlspecialchars($c['picture']); ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>" class="username"><?php echo htmlspecialchars($c['username']); ?></a>
         </div>
         
            <a href="detail.php?post=<?php echo $c['id'] ?>">
                <figure class="<?php echo ($c['filter']);?> figure_index">
                <img src="<?php echo htmlspecialchars($c['image']); ?> " alt="image" class="picture_index">
                </figure>
            </a>
        
         <div class="feed_flex">
         <div class="date"><?php echo(Post::timeAgo($c['created']));?></div>
         <div class="likes"><span><?php echo Like::countLikes($c['id']) ;?></span> likes</div>

         <?php if (Like::userLiked($c['id'])==0):?>
         <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn" id="post_<?php echo $c['id'];?>"></a>
         
         <?php else:?>    
         <a href="#"><img src="images/liked_btn.png" alt="like button" class="like_btn" id="post_<?php echo $c['id'];?>"></a>
         <?php endif; ?>   
         </div>
      </div>
      
</body>
</html>
