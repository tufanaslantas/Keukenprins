<?php

//Test om te zien of dit goede bestand is of niet nummer: 2

include "../classes/sessie.php";
include "../classes/gebruiker.php";
include "../classes/database.php";
include "../classes/blog.php";

$sessie = Sessie::FindActiveSession();
if ($sessie == null) {
    header("location: index.php");
    exit;
}
$user_id = $sessie->userId;

$blogging = Blogging::BlogAdmin();

$show = is_array($blogging) && count($blogging) > 0;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogoverzicht - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <!-- Navigatiebalk -->
        <nav class="navbar navbar-expand-lg bg-danger rounded mb-4 px-4">
            <div class="container-fluid justify-content-center gap-3">
                <a href="../index.php" class="btn btn-warning">Home</a>
                <a href="insert.php" class="btn btn-warning">Blog Maken</a>
                <a href="admin.php" class="btn btn-warning">Admin</a>
            </div>
        </nav>

        <!-- Content -->
        <div class="text-center">
            <?php if ($show) : ?>
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <?php foreach ($blogging as $blog) : ?>
                        <div class="card shadow-sm border-0" style="width: 20rem;">
                            <img src="../images/upload/<?= $blog->image; ?>" class="card-img-top rounded-top" alt="Blog afbeelding">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($blog->title); ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-around">
                                    <a href="bewerk_blog.php?id=<?= $blog->id; ?>" class="btn btn-outline-primary btn-sm" title="Bewerk blog">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $blog->id; ?>" class="btn btn-outline-danger btn-sm" title="Verwijder blog" onclick="return confirm('Weet je zeker dat je deze blog wilt verwijderen?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <h3 class="text-muted">Geen blogs gevonden</h3>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


