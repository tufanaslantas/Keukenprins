<?php




include "../7.1/classes/database.php";
include "../7.1/classes/blog.php";

$image = "";







$geenIdee = $_GET["id"];
$blog = Blogje::nuFfAlleenZoekenVoorDetailPagina($geenIdee); // deze haalt de blog op met geenidee



if ($geenIdee == null) { // als de gebruiker geen idee heeft wordt die terug gestuurd
    header("Location: admin.php");
    exit;
}







?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
            <div class="col text-center">
                <h1 class="cssTitletje"><?= $blog->title; ?></h1>
                <br>
                <?php if (!empty($blog->image)) { ?>
                    <img src="../7.1/images/upload/<?= $blog->image; ?>" alt="Afbeelding" style="max-width: 200px;"> <!-- vervelende maniet dit van comments, maar die laat de foto zien en zorgt dat die foto niet te groot wordt.  -->
                <?php } ?>
                <br>
                <div class="blogerdieblogcssdingescontent"><?= $blog->content; ?></div>
                <br>
                <div class="langeonodigelaptextauthor"><strong>Auteur:</strong> <?= $blog->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe; ?></div>

                <br>
                <br>
                <a href="index.php">
                    <button type="button" class="btn btn-outline-primary">Keer terug naar het overzicht</button> <!-- knopje -->
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>