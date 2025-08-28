<?php

include "classes/database.php";
include "classes/blog.php";

$image = "";

$geto = $_GET["id"];
$blog = Blogging::BloggingDetail($geto); // Blogje = Blogging

if ($geto == null) { 
    header("Location: admin.php");
    exit;
}

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .blog-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #212529;
        }

        .blog-content {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #343a40;
            max-width: 700px;
            margin: auto;
        }

        .blog-author {
            color: #6c757d;
            font-size: 1rem;
        }

        .blog-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .btn-back {
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">

        <!-- Navbar -->
        <nav class="navbar bg-danger rounded mb-5">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand text-white fw-bold" href="index.php">
                    Test <!-- Credits naar Furkan -->
                </a>
            </div>
        </nav>

        <!-- Blog detail -->
        <div class="text-center">
            <h1 class="blog-title mb-4"><?= htmlspecialchars($blog->title); ?></h1>

            <?php if (!empty($blog->image)) : ?>
                <img src="images/upload/<?= htmlspecialchars($blog->image); ?>" alt="Afbeelding" class="blog-image img-fluid shadow">
            <?php endif; ?>

            <div class="blog-content mb-4">
                <?= nl2br(htmlspecialchars($blog->content)); ?>
            </div>

            <div class="blog-author mb-4">
                <strong>Auteur:</strong> <?= htmlspecialchars($blog->author); ?>
            </div>

            <a href="index.php" class="btn btn-outline-primary btn-back"><i class="bi bi-arrow-left"></i> Terug naar overzicht</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
