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
        <main>
            <div class="container">
                <section class="grid">
                    <div class="grid-item"></div>
                    <?php foreach(Project::getProjects() as $p): ?>
                        <a href="<?php echo $p['id']; ?>" class="grid-item">
                          <img src="files/post/<?php echo $p['id']; ?>" alt="">
                        </a>
                      <?php endforeach; ?>
                  </section>
              </div>
        </main>
    </body>
    <script>
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        })
    </script>
</html>