<?php
    require_once("bootstrap.php");
	Session::check();

    if(!isset($_SESSION["user"])) {
		header("Location: login.php");
	}else{
		$profile = new User();
		$p = $profile->getDetails();
		
		$username = $p[0]["email"];
		$firstname = $p[0]["firstname"];
		$lastname = $p[0]["lastname"];
		$bio = $p[0]["bio"];
		$avatar = $p[0]["avatar"];
	

		/*
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
		*/

	}
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_profile">
        <?php require_once("includes/nav.inc.php"); ?>
        <div id="container">
			<div class="profileInfo">
			<img class="profilePhoto" src="<?php echo $avatar ;?>" alt="profile photo">
			<div class="profileDetails">
				<div class="editProfile">
					<p><?php echo $username; ?></p>
					<p><?php echo $firstname; ?></p>	
					<p><?php echo $lastname; ?></p>	
					<p><?php echo $bio; ?></p>			
				</div>
		</div>
	</div>

	</body>
</html>