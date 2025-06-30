<?php

include "classes/database.php";
include "classes/blog.php";

$image = "";

$geto = $_GET["id"];
$blog = BloggingOng::BloggingDetailFr($geto); // Blogje = BloggingOng

if ($geto == null) { 
    header("Location: admin.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">

        <!-- Navbar -->
        <nav class="navbar bg-danger mb-4">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand text-white fw-bold" href="index.php">
                    Test <!-- Credits naar Furkan -->
                </a>
            </div>
        </nav>

        <!-- Blog detail -->
        <div class="text-center">
            <h1 class="cssTitletje mb-4"><?= htmlspecialchars($blog->title); ?></h1>

            <?php if (!empty($blog->image)) : ?>
                <img src="images/upload/<?= htmlspecialchars($blog->image); ?>" alt="Afbeelding" class="img-fluid mb-4" style="max-width: 200px;">
            <?php endif; ?>

            <div class="blogerdieblogcssdingescontent mb-4">
                <?= nl2br(htmlspecialchars($blog->content)); ?>
            </div>

            <div class="langeonodigelaptextauthor mb-5">
                <strong>Auteur:</strong> <?= htmlspecialchars($blog->auteurnaam); ?>
            </div>

            <a href="index.php" class="btn btn-outline-primary">Terug naar het Overzicht</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
