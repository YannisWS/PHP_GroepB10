<?php
    require_once("bootstrap.php");
    Session::check();
	require_once("includes/checklogin.inc.php");
	
	$postId = (int)$_GET['id'];

	if(isset($_GET['id'])){
		$post = new Post;
		$post->setId($postId);
	}
	
	if(!empty($_POST)){
        try{
			$comment = new Comment();
            $comment->setUserId($_SESSION['user']);
            $comment->setPostId($postId);
			$comment->setText($_POST['NewComment']);
			$comment->save();
        }catch(Exception $e) {
            //Catch Statement
        }
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
					<img src="<?php echo htmlspecialchars($p['file_location']); ?>" class="<?php echo $p['filter']; ?>" alt="Image">
					<a href="profile.php?id=<?php echo htmlspecialchars($p['id']); ?>"><p><?php echo htmlspecialchars($p['firstname'] . " " . $p['lastname']); ?>:</p></a>
					<p class="bold">"<?php echo htmlspecialchars($p['description']); ?>"</p>
					<p class="small">Posted <?php 
						$date = $p['date']; 
						$timestamp = strtotime($date); 
						echo date("j F Y", $timestamp); ?> 
						at <?php echo htmlspecialchars($p['location']); ?></p>
					<p class="small">filter: <?php if(empty($p['filter'])){echo "none";}else{echo htmlspecialchars($p['filter']);}; ?></p>
				</section>
       			<?php endforeach; ?>
        	</main>
        	<aside>
        		<article id="commentList"> <!-- COMMENT SECTION -->
        		    <?php foreach($post->getComments() as $c): ?>
        		        <p>
        		        	<img src="<?php echo htmlspecialchars($c['avatar']); ?>" alt="profilepic">
        		        	<span class="comment">
								<span <?php if($c['comment_user_id'] == $_SESSION['user']){echo 'style="color:#F3B54A"';}?>>
								<?php echo htmlspecialchars($c['firstname'] . " " . $c['lastname']); ?>
								</span>

								<?php echo htmlspecialchars(": " . $c['comment_text']); ?>
       		        		</span>
        		        </p>
        		    <?php endforeach; ?>
        		</article>
        		<form method="post" action=""> <!-- ADD COMMENT -->
        			<input type="text" id="NewComment" name="NewComment" placeholder="add a comment" required>
        			<input type="submit" id="submit" value="send">
        		</form>
        	</aside>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
		$(document).ready(function(){ 
			$("#submit").on("click", function(e){		
				var userId = <?php echo $_SESSION['user'] ?>;
				var postId = <?php echo $_GET['id'] ?>;
				var text = $("#NewComment").val();
				
				e.preventDefault();
				
				$.ajax({
					method: "POST",
					url: "ajax/postcomment.php",
					data: {userId: userId, postId: postId, text: text},
					dataType: "json"
				})
				.done(function(res) {
					if(res.status == "success") {
						<?php foreach($post->getUsername() as $u): ?>
						var p = 
							"<p><img src=" + <?php echo htmlspecialchars($c['avatar']); ?> + " alt=\"profilepic\"><span class=\"comment\"><span style=\"color:#F3B54A\"><?php echo htmlspecialchars($u['firstname'] . ' ' . $u['lastname']); ?></span>: " + text + "</span></p>";
						<?php endforeach; ?>
						$("#commentList").append(p);
						$("#NewComment").val("").focus();
					}else{
						console.log(res.status);
					}
				})
				
			});
		});
	</script>
</html>