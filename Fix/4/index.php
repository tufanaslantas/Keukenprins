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
    <title>Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

        <!-- Blog overzicht -->
        <div class="text-center">
            <?php if ($show === true && is_array($blogging)) : ?>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php foreach ($blogging as $blog) : ?>
                        <a href="detail.php?id=<?= $blog->id; ?>" class="text-decoration-none text-dark">
                            <div class="card" style="width: 18rem;">
                                <img src="images/upload/<?= $blog->image; ?>" class="card-img-top" alt="<?= htmlspecialchars($blog->title); ?>">
                                <div class="card-body">
                                    <p class="card-text"><?= htmlspecialchars($blog->title); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <h3 class="text-muted">Geen blogs gevonden</h3>
            <?php endif; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
