<?php
    require_once("classes/User.class.php");
    try{
        if(!empty($_POST)){
            $user = new User(); 
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            
            $user->login();
            $id = $user->getIdByEmail();
            session_start();
            $_SESSION['user'] = $id['id'];
            header('Location: index.php');
        }
    }
    catch(Exception $e) {
        echo'<div class="form__error"><p>Something went wrong</p></div>';
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>IMDFlix</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
       <main>
            <h1>Login</h1>
            <form action="" method="post">
                <div class="form__field">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" placeholder="email" required>
                </div>
                <div class="form__field">
                    <label for="password">password</label>
                    <input type="password" id="password" name="password" placeholder="password" required>
                </div>
                <div class="form__field">
                    <input type="submit" value="Login" class="button">
                </div>
            </form>
            <a href="register.php">Not registered yet?</a>
        </main>
    </body>
</html>