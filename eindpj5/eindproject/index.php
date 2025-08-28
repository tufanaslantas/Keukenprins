<?php

include "classes/database.php";
include "classes/blog.php";

$blogging = null;
$blogging = Blogging::BlogAdmin();
$show = false;


if (!$blogging) {  
    $show = false;
} else {
    $show = true;
}

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .blog-card {
            width: 20rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .blog-card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
        }

        .card-text {
            font-weight: 500;
            font-size: 1.1rem;
            color: #212529;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container py-4">

        <!-- Navbar -->
        <nav class="navbar bg-danger rounded mb-5">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand text-white fw-bold" href="index.php">
                    Frinkandel!
                </a>
            </div>
        </nav>

        <!-- Blog overzicht -->
        <div class="text-center">
            <?php if ($show === true && is_array($blogging)) : ?>
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <?php foreach ($blogging as $blog) : ?>
                        <a href="detail.php?id=<?= $blog->id; ?>" class="text-decoration-none text-dark">
                            <div class="card blog-card shadow-sm">
                                <img src="images/upload/<?= htmlspecialchars($blog->image); ?>" class="card-img-top" alt="<?= htmlspecialchars($blog->title); ?>">
                                <div class="card-body text-center">
                                    <p class="card-text"><?= htmlspecialchars($blog->title); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <h3 class="text-muted mt-5">Geen blogs gevonden</h3>
            <?php endif; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>

