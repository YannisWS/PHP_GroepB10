<?php
    require_once("bootstrap.php");
    Session::check();

	if(empty($_SESSION['user'])){
		header('Location: login.php');
	}else{
		$id = $_GET['id'];
		//echo $post_id;
		$post = new Post();
		$post->setId($id);
        $post->getPostData();
	}
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body>
		<?php require_once("includes/nav.inc.php"); ?>
       	<div class="container">
			<main>
				<?php foreach($post as $p): ?>  
				<section>
					<img src="<?php echo $p['file_location']; ?>" alt="Image">
					<p><?php echo $p['description']; ?></p>
				</section>
       			<?php endforeach; ?>
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