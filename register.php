<?php
    require_once("bootstrap.php");

	if(!empty($_POST)){
		try{
			$user = new User();
			$user-> setEmail($_POST['email']);
			$user-> setPassword($_POST['password']);
			$user-> setPasswordConfirmation($_POST['password_confirmation']);
			$user-> setFirstname($_POST['firstname']);
			$user-> setLastname($_POST['lastname']);
			$user-> setBio($_POST['bio']);
			$user-> checkPassword();
			$user-> uploadAvatar();
			$user-> register();
		}catch(Exception $e) {
            //Catch Statement
        }
		
		$id = $user->getIdByEmail();
        session_start();
		$_SESSION['user'] = (int)$id['id'];
        header('Location: index.php');
	}
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_login">
        <main>
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Sign Up</h1>
                <input type="text" id="email" name="email" placeholder="email" required>
                <input type="password" id="password" name="password" placeholder="password" required>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="confirm password" required>
                <input type="text" id="firstname" name="firstname" placeholder="firstname" required>
                <input type="text" id="lastname" name="lastname" placeholder="lastname" required>
                <input type="file" id="avatar" name="file" accept="image/*" required>
<!--                <input type="text" id="avatar" name="avatar" placeholder="avatar" required>-->
                <input type="text" id="bio" name="bio" placeholder="short description" required>
                <input type="submit" value="Sign Up">
            </form>
            <a href="login.php">Already have an account? <span class="yellow">Log in</span></a>
            <div class="error">Something went wrong :/ Please try again</div>
        </main>
    </body>
</html>