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
    <title>Geen blogs </title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col text-center">
                <nav class="navbar bg-danger">
                    <div class="container-fluid">
                        <a href="../index.php"><button type="button" class="btn btn-warning" id="adminzooi">Home</button></a>
                        <a href="insert.php"><button type="button" class="btn btn-warning" id="adminzooi">Blog Aanmaken</button></a>
                        <a href="admin.php"><button type="button" class="btn btn-warning" id="adminzooi">Admin</button></a>
                    </div>
                </nav>
                <br>
                <div class="row">
                    <div class="col text-center">
                        <?php if ($show) : ?>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <?php foreach ($blogging as $blog) : ?>           
                                    <div class="card border-danger mb-3" style="width: 18rem;">
                                        <img src="../images/upload/<?= $blog->image; ?>" class="card-img-top" alt="...">
                                        <p class="card-text"><?= $blog->title; ?></p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <a href="ffEenVerbeteringOfzoAanbrengen.php?id=<?= $blog->id; ?>">Bewerken</a>
                                                <a href="ffEenVerbeteringOfzoAanbrengen.php?id=<?= $blog->id; ?>"><i class="bi bi-pencil"></i></a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="delete.php?id=<?= $blog->id; ?>">Verwijderen</a>
                                                <a href="delete.php?id=<?= $blog->id; ?>"><i class="bi bi-trash"></i></a>
                                            </li>         
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <h3 class="phpindexgedoei">Geen Blogs gevonden</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>

