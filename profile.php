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

		$o = new feed();



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

		<main class="feedContainer">
			<div class="profileFeed">
				<?php foreach($o->getOwnFeed() as $p): ?>
				<a href="post.php?id=<?php echo $p['id']; ?>" class="grid-item">
						<img src="<?php echo $p['file_location']; ?>" class="<?php echo $p['filter']; ?>" alt="Image">
						<p class="bold"><?php echo $p['description']; ?></p>
					</a>
                <?php endforeach; ?>
			</div>
		</main>
	</div>

	</body>
</html>