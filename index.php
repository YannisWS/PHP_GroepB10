<?php
    require_once("bootstrap.php");

    Session::check();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Welcome to Imdflix</title>
    </head>
    <body>
        <nav>
            <a href="#">logo</a>
            <a href="#">profile</a>
            <a href="logout.php">logout</a>
        </nav>
        <div class="container">
            <main>
                <a href="upload.php"></a> <!-- CREATE NEW POST -->
                <section class="grid">
                    <div class="grid-item"></div>
                    <?php foreach(Feed::getFeed() as $f): ?>                        
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