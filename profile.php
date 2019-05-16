<?php
    require_once("classes/Post.class.php");
    require_once("classes/User.class.php");
    require_once("bootstrap.php");
    Session::check();
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    
    $post = new Post();

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

		}else{
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
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body>
        <?php require_once("includes/nav.inc.php"); ?>
        <div class="container">
			<div class="profileInfo">
			<img class="profilePhoto" src="<?php echo $avatar?>" alt="profile photo">
			<div class="profileDetails">
				<div class="editProfile">
					<p class="userName"><?php echo $username; ?></p>

					<button id="<?php echo $show?>" class="<?php echo $btnClass; ?>"><?php echo $btnText; ?></button>
					<a style="border: 1px solid grey; font-family: Oswald; font-size: small; color: grey;margin-left: 20px; padding: 5px; border-radius:20px; text-decoration: none;" id="<?php echo $unshow?>" href="EditProfile.php">Edit</a>
				</div>
				<ul class="userStats">
					<li><span><?php echo $post->getDescription(); ?></span> posts</li>
            <!--        <li><span><?php echo $follow?></span> followers</li>
					<li><span><?php echo $followers?></span> following</li>  -->
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
		</main>
	</div>
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
<!--	<script src="js/app.js"></script>-->
	</body>
</html>

