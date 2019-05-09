<?php
    require_once("bootstrap.php");
    Session::check();
		
	if(empty($_SESSION['user'])){
		header('Location: login.php');
	}
	else{
		$user_feed = $_SESSION['user'];
		$feed = new Feed();
		$feed->setFeed($user_feed);
        $feed->createFeed();
	}

    require_once("includes/header.inc.php");
?>
    <body>
        <nav>
            <a href="#">logo</a>
            <a href="profile.php">profile</a>
            <a href="imgUpload.php">Upload</a>
            <a href="logout.php">logout</a>
            <a href="imgUpload.php">upload</a>
        </nav>
        <div class="container">
            <main>
                <a href="upload.php"></a> <!-- CREATE NEW POST -->
                <section class="grid">
                    <div class="grid-item"></div>
                    <?php foreach($createFeed as $f): ?>                        
                        <a href="post.php?p=<?php echo $f['posts.id']; ?>" class="grid-item"> <!-- VISIT POST -->
                          <img src="img/post/<?php echo $f['posts.file_location']; ?>" alt="post">
                        </a>
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