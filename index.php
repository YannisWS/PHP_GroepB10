<?php
    require_once("bootstrap.php");
    Session::check();
	
	if(!isset($_SESSION["user"])){
		header("Location: login.php");
	}else{
        $feed = new Feed;
        
    }
    
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body>
        <?php require_once("includes/nav.inc.php"); ?>
        <div class="container">
            <main>
            
                <a href="upload.php"></a> <!-- CREATE NEW POST -->
                <section class="grid">
                <?php foreach($feed->getFeedData() as $p): ?>
                   <a href="post.php?id=<?php echo $p['id']; ?>"><div class="grid-item">
                   <img src="img/post/<?php echo $p['file_location']; ?>" class="<?php echo $p['filter']; ?>" alt="Image">
                    <p><?php echo $p['description']; ?></p>
                   </div></a>
                <?php endforeach; ?>
                  </section>
              </main>
        </div>
    </body>
    <script 
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        })
    </script>
</html>