<?php

include "classes/database.php";
include "classes/blog.php";

$blogging = null;
$blogging = BloggingOng::BloggingAdminFr();
$show = false;


if (!$blogging) {  
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
    <title>GatoGram</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col text-center">
                <nav class="navbar bg-danger">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">
                            GatoGram <!-- Credits naar Furkan -->
                        </a>
                    </div>
                </nav>
                <br>
            </div>
        </div>
        <div class="row">

                <div class="col text-center">
                    <?php if ($show === true && is_array($blogging)) : ?>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <?php foreach ($blogging as $blog) : ?>

                                <a href="detail.php?id=<?= $blog->id; ?>">
                                    <div class="card" style="width: 18rem;">
                                        <img src="images/upload/<?= $blog->image;  ?>" class="card-img-top" alt="...">

                                        <div class="card-body">
                                            <p class="card-text"><?= $blog->title; ?></p>
                                        </div>

                                    </div>
                                </a>

                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <h3 class="php">Geen blogs gevonden</h3>
                    <?php endif; ?>
                </div>

            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>