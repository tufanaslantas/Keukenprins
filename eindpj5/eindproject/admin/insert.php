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

    $NewBlog1 = new Blogging();
    $NewBlog1->title = $_POST["title"];
    $NewBlog1->image = $image;
    $NewBlog1->content = $_POST["content"];
    $NewBlog1->auteurnaam = $_POST["author"];
    $NewBlog1->NewBlog();

    $showToast = true;

    $message = $voegenyep;
} else {
    $message = $voegennope;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichTextEditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        }

        .form-label i {
            margin-right: 6px;
        }

        .toast {
            border-radius: 10px;
        }

        .img-preview {
            max-width: 200px;
            border: 2px solid #dee2e6;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <nav class="navbar bg-danger p-3 rounded mb-4">
            <div class="container-fluid gap-2">
                <a href="../index.php" class="btn btn-warning"><i class="bi bi-house-door"></i> Homepage</a>
                <a href="insert.php" class="btn btn-warning"><i class="bi bi-plus-circle"></i> Voeg blog toe</a>
                <a href="admin.php" class="btn btn-warning"><i class="bi bi-tools"></i> Admin</a>
            </div>
        </nav>

        <a href="admin.php" class="btn btn-outline-primary mb-4"><i class="bi bi-arrow-left"></i> Keer terug</a>

        <div class="card p-4">
            <h2 class="mb-4"><i class="bi bi-pencil-square"></i> Blog Editor</h2>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="bi bi-type"></i> Titel</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= isset($blog->title) ? htmlspecialchars($blog->title) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="bestand" class="form-label"><i class="bi bi-image"></i> Afbeelding uploaden</label>
                    <input type="file" id="bestand" name="bestand" class="form-control">
                </div>

                <?php if (!empty($blog->image)) : ?>
                    <div class="mb-3">
                        <img src="../images/upload/<?= htmlspecialchars($blog->image); ?>" alt="Afbeelding" class="img-preview">
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="content" class="form-label"><i class="bi bi-card-text"></i> Inhoud</label>
                    <textarea class="jqte form-control" id="content" name="content" required><?= isset($blog->content) ? htmlspecialchars($blog->content) : '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label"><i class="bi bi-person-circle"></i> Auteur</label>
                    <input type="text" id="author" name="author" class="form-control" value="<?= isset($blog->author) ? htmlspecialchars($blog->author) : '' ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success"><i class="bi bi-send"></i> Verzenden</button>
            </form>
        </div>

        <?php if (!empty($showToast)) : ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
                <div id="liveToast" class="toast show text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success text-white">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong class="me-auto">Succes</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Sluiten"></button>
                    </div>
                    <div class="toast-body">
                        <?= isset($message) ? htmlspecialchars($message) : 'Bewerking voltooid.' ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" charset="utf-8"></script>
    <script src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
    <script>
        $('.jqte').jqte();
    </script>
</body>

</html>

