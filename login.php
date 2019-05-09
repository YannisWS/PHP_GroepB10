<?php
    require_once("bootstrap.php");

    try{
        if(!empty($_POST)){
            $user = new User(); 
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            
            if($user->login()){
                $id = $user->getIdByEmail();
                session_start();
				$_SESSION['user'] = (int)$id['id'];
                header('Location: index.php');
            } 
        }
    }
    catch(Exception $e) {
        //$error= $e->getMessage();
    }
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_login">
       <main>
            <form action="" method="post">
                <h1>Login</h1>
                <input type="text" id="email" name="email" placeholder="email" required>
                <input type="password" id="password" name="password" placeholder="password" required>
                <input type="submit" value="Login" class="button">
            </form>
            <a href="register.php">Not registered yet? Create an account</a>
            <div class="error">Something went wrong :/ Please try again</div>
        </main>
    </body>
</html>