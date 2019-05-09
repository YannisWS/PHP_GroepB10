<?php
    require_once("bootstrap.php");
    Session::check();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum scale=1.0, minimum-scale=1.0">
        <title></title>
    </head>
    <body>
        <nav>
            <a href="#">logo</a>
            <a href="profile.php">profile</a>
            <a href="logout.php">logout</a>
            <a href="imgUpload.php">Upload</a>
        </nav>
        <main>

        </main>
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
