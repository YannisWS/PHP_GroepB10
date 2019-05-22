<?php
    require_once("bootstrap.php");
    Session::check();
	
	if(!isset($_SESSION["user"])){
		header("Location: login.php");
	}else{
        
        $feed = new Feed;
        //$f = $feed->getFriendData();
    }
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_index">
        <?php require_once("includes/nav.inc.php"); ?>
        <div id="container">
            <main class="grid">
            	<div class="grid-sizer"></div>
				<?php foreach($feed->getFeedData() as $p): ?>
					<a href="post.php?id=<?php echo htmlspecialchars($p['id']); ?>" class="grid-item">
						<img src="<?php echo htmlspecialchars($p['file_location']); ?>" class="<?php echo htmlspecialchars($p['filter']); ?>" alt="Image">
						<p class="bold"><?php echo htmlspecialchars($p['description']); ?></p>
					</a>
                <?php endforeach; ?>
        	</main>
        </div>
    </body>
    <script 
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4.1.4/imagesloaded.pkgd.min.js"></script>
    <script>
		var $grid = $('.grid').masonry({
			itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
			gutter: 10
		});
		$grid.imagesLoaded().progress( function() {
			$grid.masonry('layout');
		});
    </script>
</html>