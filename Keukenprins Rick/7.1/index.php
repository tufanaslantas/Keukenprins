<?php

include "../7.1/classes/database.php";
include "../7.1/classes/blog.php";

$blogss = null;
$blogss = Blogje::ffAlleBlogjesZoekenVoorDeAdminPaginaDinges();
$show = false;


if (!$blogss) {   // deze kijkt dus eerst of er wel een blogje te vinden was, als dat niet zo is krijgt de gebruiker een text te zien
    $show = false;
} else {
    $show = true;
}



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../7.1/css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col text-center">
                <nav class="navbar bg-danger">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">
                            <i class="bi bi-newspaper"></i>
                            BlogerdieBlogBlog(jouw naam)
                        </a>
                    </div>
                </nav>
                <br>
            </div>
        </div>
        <div class="row">

            


                <div class="col text-center"> <!-- werkt beter voor centeren dan css gedoe -->
                    <?php if ($show === true && is_array($blogss)) : ?>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <?php foreach ($blogss as $blog) : ?>


                                <a href="detail.php?id=<?= $blog->id; ?>">
                                    <div class="card" style="width: 18rem;">
                                        <img src="../7.1/images/upload/<?= $blog->image;  ?>" class="card-img-top" alt="...">

                                        <div class="card-body">
                                            <p class="card-text"><?= $blog->title; ?></p>
                                        </div>

                                    </div>
                                </a>

                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <h3 class="phpindexgedoei">Helaas, geen blogs gevonden </h3>
                    <?php endif; ?>
                </div>

            </div>

        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>