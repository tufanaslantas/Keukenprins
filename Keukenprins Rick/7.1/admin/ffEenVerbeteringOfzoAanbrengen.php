<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichTextEditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
</head>


<?php




include "../classes/database.php";
include "../classes/blog.php";
include "../classes/sessie.php";



$sessie = Sessie::vindActieveSessie(); // kijkt eerst of er een sessie is :)
if ($sessie == null) {
    header("location: index.php");
    exit;
}
$user_id = $sessie->userId;

$showToast = false;

$image = "";

if (!empty($_FILES["bestand"]["name"])) {
    $image = $_FILES["bestand"]["name"];
    $target = "../images/upload/" . basename($image);
    move_uploaded_file($_FILES["bestand"]["tmp_name"], $target); // foto upload gedoe
}





$geenIdee = $_GET["id"];
$blog = Blogje::nuFfAlleenZoekenVoorDetailPagina($geenIdee);



if ($geenIdee == null) {
    header("Location: admin.php");
    exit;
}




if (isset($_POST["title"])) {
    $blog->title = $_POST["title"];
    $blog->image = $image;
    $blog->content = $_POST["content"];
    $blog->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe = $_POST["author"];
    $blog->aanpas();
}


?>


<div class="container">
    <div class="row">
        <div class="col">

        <nav class="navbar bg-danger">
                    <div class="container-fluid">


                        <a href="../index.php"><button type="button" class="btn btn-warning" id="adminzooi">Homepage</button></a> <a></a><a href="insert.php"><button type="button" class="btn btn-warning" id="adminzooi">Voeg blog toe</button></a> <a></a><a href="admin.php"><button type="button" class="btn btn-warning" id="adminzooi">Admin</button></a>
                        </a>
                    </div>
                </nav>
                <br>
                <br>
            <br>
            <br>
 
            <br>
            <br>
            <table>
                <tr>
                    <form method="POST" enctype="multipart/form-data">




                        <label for="title">Title veranderen:</label>
                        <input type="text" id="title" name="title" value="<?= $blog->title; ?>"> <br>
                        <br>


                        <label for="image">Foto veranderen:</label>
                        <input type="file" id="bestand" name="bestand">
                        <br>
                        <br>
                        <?php if (!empty($blog->image)) { ?>
                            <img src="../images/upload/<?= $blog->image; ?>" alt="Afbeelding" style="max-width: 200px;">
                        <?php } ?>

                        <br><br />


                        <br>
                        <label for="content"> Content veranderen:</label>
                        <textarea class="jqte" id="content" name="content" required> <?= $blog->content; ?></textarea>


                        <br>
                        <label for="author">Auteur veranderen:</label>
                        <input type="text" id="author" name="author" value="<?= $blog->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe; ?>"> <br>
                        <br>
                        <button type="submit" name="submit" value="doen" id="liveToastBtn" class="btn btn-outline-danger">update</button>
                        <br>
                        <br>



                    </form>


                </tr>


            </table>
        </div>
    </div>

</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
    $('.jqte').jqte();

    <?php if ($showToast): //toast zodat je een melding krijgt dat je het hebt geupdate als het zou werken... 
    ?>
        const toastLive = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastLive, {
            delay: 5000
        });
        toast.show();
    <?php endif; ?>
</script>

</html>