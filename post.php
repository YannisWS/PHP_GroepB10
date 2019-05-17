<?php
    require_once("bootstrap.php");
    Session::check();
	require_once("includes/checklogin.inc.php");

	$post = new Post;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$post->setId($id);
//        $post->getPostData();


	}
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_post">
		<?php require_once("includes/nav.inc.php"); ?>
       	<div class="container">
			<main>
				<?php foreach($post->getPostData() as $p): ?>  
				<section>
					<img src="<?php echo $p['file_location']; ?>" class="<?php echo $p['filter']; ?>" alt="Image">
					<p><?php echo $p['firstname'] . " " . $p['lastname']; ?>:</p>
					<p class="<bold></bold>">"<?php echo $p['description']; ?>"</p>
					<p class="small">Posted <?php 
						$date = $p['date']; 
						$timestamp = strtotime($date); 
						echo date("j F Y", $timestamp); ?> 
						at <?php echo $p['location']; ?></p>
					<p class="small">filter: <?php if(empty($p['filter'])){echo "none";}else{echo $p['filter'];}; ?></p>
				</section>
       			<?php endforeach; ?>
        	</main>
        	<aside>
        		<article> <!-- COMMENT SECTION -->
        		    <?php foreach($post->getComments() as $c): ?>
        		        <p>
        		        	<span<?php if($c['comment_user_id'] == $_SESSION['user']){echo " class=\"yellow\"";}?>>
							<?php echo $c['firstname'] . " " . $c['lastname']; ?>
     		        		</span>
      		        		
       		        		<?php echo ": " . $c['comment_text']; ?>
        		        </p>
        		    <?php endforeach; ?>
        		</article>
        		<form action="" method="post"> <!-- ADD COMMENT -->
        			<input type="text" id="NewComment" placeholder="add a comment">
        			<input type="submit" value="send">
        		</form>
        	</aside>
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