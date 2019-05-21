<?php
    require_once("bootstrap.php");
    Session::check();
	require_once("includes/checklogin.inc.php");
	
	$postId = $_GET['id'];

	if(isset($_GET['id'])){
		$post = new Post;
		$post->setId($postId);
	}
	
	if(!empty($_POST)){
        try{
			$comment = new Comment();
			
            $newComment = $_POST['NewComment'];

            $comment->setPostId($postId);
			$comment->setText($newComment);
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
        		<form method="post" action=""> <!-- ADD COMMENT -->
        			<input type="text" id="NewComment" name="NewComment" placeholder="add a comment" required>
        			<input type="submit" id="submit" value="send">
        		</form>
        	</aside>
        </div>
    </body>
</html>