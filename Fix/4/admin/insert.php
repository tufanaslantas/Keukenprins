<?php

session_start();
include "../classes/database.php";
include "../classes/sessie.php";

$sessie = Sessie::findActiveSession();
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichTextEditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
</head>

<body>
    <div class="container">

  
        <nav class="navbar bg-danger mb-4">
            <div class="container-fluid justify-content-start gap-2">
                <a href="../index.php" class="btn btn-warning">Homepage</a>
                <a href="insert.php" class="btn btn-warning">Voeg blog toe</a>
                <a href="admin.php" class="btn btn-warning">Admin</a>
            </div>
        </nav>

       
        <a href="admin.php" class="btn btn-primary mb-4">Keer terug</a>

  
        <h2>Blog editor</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Geef blog title</label>
                <input type="text" id="title" name="title" class="form-control" value="">
            </div>

            <div class="mb-3">
                <label for="bestand" class="form-label">Bestand</label>
                <input type="file" id="bestand" name="bestand" class="form-control">
            </div>

            <?php if (!empty($blog->image)) : ?>
                <div class="mb-3">
                    <img src="../images/upload/<?= htmlspecialchars($blog->image); ?>" alt="Afbeelding" style="max-width: 200px;">
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="jqte form-control" id="content" name="content" required></textarea>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Geef auteur</label>
                <input type="text" id="author" name="author" class="form-control" value="">
            </div>

            <button type="submit" name="submit" value="doen" id="liveToastBtn" class="btn btn-primary">Verzenden</button>
        </form>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= isset($message) ? htmlspecialchars($message) : ''; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
    <script src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
    <script>
        $('.jqte').jqte();

        <?php if (!empty($showToast)) : ?>
            const toastLive = document.getElementById('liveToast');
            const toast = new bootstrap.Toast(toastLive, { delay: 5000 });
            toast.show();
        <?php endif; ?>
    </script>
</body>

</html>
