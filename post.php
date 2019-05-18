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

	if(!empty($_POST)){
		try{	
			$postId = $_GET['id'];
			
			$comment = new Comment();
			$comment->getUserId($userId);
			$comment->setPostId($postId);
			$comment->setText($_POST['NewComment']);
		}catch (\Throwable $th) {
			//throw $th;
		}
	}
//	$comments = Comment::getComments();
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
					<p class="bold">"<?php echo $p['description']; ?>"</p>
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
        		<article id="commentList"> <!-- COMMENT SECTION -->
        		    <?php foreach($post->getComments() as $c): ?>
        		        <p>
        		        	<span <?php if($c['comment_user_id'] == $_SESSION['user']){echo "class=\"yellow\"";}?>>
							<?php echo $c['firstname'] . " " . $c['lastname']; ?>
     		        		</span>
      		        		
       		        		<?php echo ": " . $c['comment_text']; ?>
        		        </p>
        		    <?php endforeach; ?>
        		</article>
        		<form action="" method="post"> <!-- ADD COMMENT -->
        			<input type="text" id="NewComment" name="NewComment" placeholder="add a comment" required>
        			<input type="submit" id="submit" value="send">
        		</form>
        	</aside>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
		$("#submit").on("click", function(e){
            var text = $("#NewComment").val();
            
			$.ajax({
				method: "POST",
				url: "ajax/comment.php",
				data: {text: text},
				dataType: "json"
			})
			.done(function( res ) {
				if(res.status == "success") {
					<?php foreach($post->getUsername() as $u): ?>
					var p = 
						"<p style=\"display:none;\"><span class=\"yellow\"><?php echo $u['firstname'] . ' ' . $u['lastname']; ?></span>: " + text + "</p>";
					<?php endforeach; ?>
					$("#commentList").append(p);
					$("#comment").val("").focus();
					$("#commentList p").last().slideDown();
				}
			});
            
			e.preventDefault();
		});
	</script>
</html>