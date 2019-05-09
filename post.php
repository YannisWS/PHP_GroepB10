<?php
    require_once("bootstrap.php");
    Session::check();
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body>
		<?php require_once("includes/nav.inc.php"); ?>
       	<div class="container">
			<main>

        	</main>
       </div>
    </body>
    <script 
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>
//		$("#btnSubmit").keyup(function(e){
//			var email = $("#email").val();
//            console.log(text);
//            $.ajax({
//            	method: "POST",
//            	url: "ajax/email.php",
//            	data: { email: email },
//            	dataType: "JSON"
// 			})
//            .done(function( res ) {
//            	if(res.status == "succes"){
//            	var li = "<li style='display:none'>" + text + "</li>"; 
//                	$("#listupdates").append(li);
//                	$("#comment").val("").focus();
//                	$("#listupdates li").last().slideDown();
//				}
//			});
//			e.preventDefault();
//    	});
	</script>
</html>
