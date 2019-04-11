<?php
    ini_set('display_errors',1); error_reporting(E_ALL);//errors

	require_once("classes/User.class.php");

	 if(!empty($_POST)){
		 $user = new User();
		 $user-> setEmail($_POST['email']);
		 $user-> setPassword($_POST['password']);
         $user-> setPasswordConfirmation($_POST['password_confirmation']);
		 $user-> setFirstname($_POST['firstname']);
		 $user-> setLastname($_POST['lastname']);
		 $user-> setAvatar($_POST['avatar']);
		 $user-> setBio($_POST['bio']);
		 $user-> register();
         
         header("Location: index.php");
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
        <div class="Login Login--register">
            <div class="form form--login">
                <form action="" method="post">
                    <h2 form__title>Sign up for an account</h2>

                    <div class="form__error hidden">
                        <p>Some error here</p>
                    </div>

                    <div class="form__field">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form__field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form__field">
                        <label for="password_confirmation">Confirm your password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <div class="form__field">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    
                    <div class="form__field">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                    
                    <div class="form__field">
                        <label for="avatar">Avatar</label>
                        <input type="text" id="avatar" name="avatar" required>
                    </div>
                    
                    <div class="form__field">
                        <label for="bio">Bio</label>
                        <input type="text" id="bio" name="bio" required>
                    </div>

                    <div class="form__field">
                        <input type="submit" value="Sign me up!" class="btn btn--primary">	
                    </div>
                </form>
                <a href="login.php">Already have an account?</a>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script>
        /*	$("#btnSubmit").keyup(function(e){
                var email = $("#email").val();
                console.log(text);*/
            /*	$.ajax({
                    method: "POST",
                    url: "ajax/email.php",
                    data: { email: email },
                    dataType: "JSON"
                })
                .done(function( res ) {
                    if(res.status == "succes"){
                    /*	var li = "<li style='display:none'>" + text + "</li>"; 
                        $("#listupdates").append(li);
                        $("#comment").val("").focus();
                        $("#listupdates li").last().slideDown();*/
                /*	}
                 });
                e.preventDefault();
            });*/
        </script>
    </body>
</html>