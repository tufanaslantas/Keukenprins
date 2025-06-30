<?php

include "../classes/database.php";
include "../classes/sessie.php";

$sessie = Sessie::vindActieveSessie();
if ($sessie == null) {
    header("location: index.php");
    exit;
}
$user_id = $sessie->userId; 

$showToast = false;

$voegennope = "Gefaald om erbij te voegen.";
$voegenyep = "Geslaagd om erbij te voegen.";

$message;

$image = "";
if (!empty($_FILES["bestand"]["name"])) {
    $image = $_FILES["bestand"]["name"];

    $target = "../images/upload/" . basename($image);


    move_uploaded_file($_FILES["bestand"]["tmp_name"], $target);
}

if (isset($_POST["title"])) {
    include_once "../classes/blog.php";

    $NewBlog1 = new BloggingOng();
    $NewBlog1->title = $_POST["title"];
    $NewBlog1->image = $image;
    $NewBlog1->content = $_POST["content"];
    $NewBlog1->auteurnaam = $_POST["author"];
    $NewBlog1->NieuwBlog();

    $showToast = true;

    $message = $voegenyep;
} else {
    $message = $voegennope;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichTextEditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col ml-8">
            <nav class="navbar bg-danger">
                    <div class="container-fluid">

                        <a href="../index.php"><button type="button" class="btn btn-warning" id="adminzooi">Homepage</button></a> <a></a><a href="insert.php"><button type="button" class="btn btn-warning" id="adminzooi">Voeg blog toe</button></a> <a></a><a href="admin.php"><button type="button" class="btn btn-warning" id="adminzooi">Admin</button></a>
                        </a>
                    </div>
                </nav>
                <br>
                <br>
                <br>
                <a href="admin.php"><button class="btn btn-primary">Keer terug</button></a>
                <br>

                <h2> Blog editor</h2>
                <form method="POST" enctype="multipart/form-data">
                    <br />
                    Geef blog title <br />
                    <input type="text" name="title" value="" /><br />

                    <label for="bestand">
                        Bestand:
                    </label>
                    <br />
                    <input type="file" id="bestand" name="bestand">
                    <br><br />

                    <?php if (!empty($blog->image)) { ?>
                        <img src="../images/upload/<?= $blog->image; ?>" alt="Afbeelding" style="max-width: 200px;">
                    <?php } ?>
                    <div class="form-group">
                        <label for="content"> Content:</label>
                        <textarea class="jqte" id="content" name="content" required></textarea>
                    </div>
                    Geef auteur <br />
                    <input type="text" name="author" value="" /><br />
                    <br>
                    <button type="submit" name="submit" value="doen" id="liveToastBtn" class="btn btn-primary">Verzenden</button>
                </form>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <a><?php echo $message ?></a>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
    <script>
        $('.jqte').jqte();

        <?php if ($showToast): ?>
            const toastLive = document.getElementById('liveToast');
            const toast = new bootstrap.Toast(toastLive, {
                delay: 5000
            });
            toast.show();
        <?php endif; ?>
    </script>
</body>

</html>