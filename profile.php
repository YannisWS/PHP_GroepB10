<?php
    require_once("bootstrap.php");

    if(!empty($_GET)) {

        $userID = $_GET['userID'];
        $_SESSION['targetUserID'] = $_GET['userID'];

        $profile = new User();
        $r=$profile->getProfile($userID);
        $followers=$profile->getFollowCount($userID);
        $follow=$profile->getFollowerCount($userID);
        $postcount=$profile->getPostCount($userID);



        $username = $r['email'];
        $bioText = $r['bio'];
        $avatar = $r['avatar'];
        $userID = $r['id'];

    if($_SESSION['userid']===$_SESSION['targetUserID']){
            $show="show";
            $unshow="";
            $btnClass="";
            $btnText="";
            $feed = new User();
            $res = $feed->getProfileFeed($userID);

    }else   {
            $show="";
            $unshow="unshow";
            if ($profile->followCheck()) {
                $btnClass = "btnUnfollow";
                $btnText = "FOLLOWING";
                $feed = new User();
                $res = $feed->getProfileFeed($userID);

            } else {
                // als hij nog niet gevolgd wordt, geen feed, wel boodschap.
                $btnClass = "btnFollow";
                $btnText = "Follow";
                $feed = new User();
                $res = $feed->getProfileFeed($userID);
            }

    }
}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/cssgram.min.css">
    <title>Profile</title>
</head>
<body>


<div  style="padding-top: 120px; id="box">
<div class="profileInfo">
    <img class="profilePhoto" src="<?php echo $avatar?>" alt="profile photo">
    <div class="profileDetails">
        <div class="editProfile">
            <p class="userName"><?php echo $username; ?></p>

            <button id="<?php echo $show?>" class="<?php echo $btnClass; ?>"><?php echo $btnText; ?></button>
            <a style="border: 1px solid grey; font-family: Oswald; font-size: small; color: grey;margin-left: 20px; padding: 5px; border-radius:20px; text-decoration: none;" id="<?php echo $unshow?>" href="Accountsettings.php">Edit</a>
        </div>

        <p class="userDescription"><?php $b=new Post(); $b->beschHastag(htmlspecialchars($bioText)); ?></p>

        <ul class="userStats">
            <li><span><?php echo $postcount; ?></span> posts</li>
            <li><span><?php echo $follow?></span> followers</li>
            <li><span><?php echo $followers?></span> following</li>
        </ul>

    </div>

</div>

<main class="feedContainer">

    <div class="profileFeed">

        <?php foreach($res as $post): ?>
            <a href="postDetail.php?imageID=<?php echo $post['id']; ?>">
                <div class="feedBox">

                        <img class="<?php echo $post['filter']?>" src="<?php echo $post['filelocation']; ?>" alt="">

                    <div class="overlay">
                        <div class="likes">
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
    <a href="imageupload.php" id="floatingBtn">+</a>
</main>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</body>
</html>