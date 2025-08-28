<?php
include "../classes/database.php";
include "../classes/blog.php";
include "../classes/sessie.php";

$sessie = Sessie::FindActiveSession();
if ($sessie == null) {
    header("location: ../index.php");
    exit;
}

$user_id = $sessie->userId;
$showToast = false;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$blog_id = (int)$_GET['id'];
$blog = Blogging::BloggingDetail($blog_id);

if ($blog == null) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $blog->image;
    
    if (!empty($_FILES["bestand"]["name"])) {
        $image = basename($_FILES["bestand"]["name"]);
        $target = "../images/upload/" . $image;
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed");
        }
        
        if (!move_uploaded_file($_FILES["bestand"]["tmp_name"], $target)) {
            die("Failed to upload image");
        }
    }

    $blog->title = trim($_POST["title"]);
    $blog->image = $image;
    $blog->content = trim($_POST["content"]);
    $blog->auteurnaam = trim($_POST["author"]);
    $blog->aanpassen();
    
    $showToast = true;
    $message = "Blog updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            border-radius: 6px;
        }

        .form-label i {
            margin-right: 5px;
        }

        .img-thumbnail {
            border: 2px solid #dee2e6;
        }

        .toast {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <nav class="navbar bg-danger p-3 mb-4 rounded">
            <div class="container-fluid d-flex justify-content-between">
                <div>
                    <a href="../index.php" class="btn btn-warning me-2"><i class="bi bi-house-door"></i> Home</a>
                    <a href="insert.php" class="btn btn-warning me-2"><i class="bi bi-plus-circle"></i> Blog toevoegen</a>
                    <a href="admin.php" class="btn btn-warning"><i class="bi bi-tools"></i> Admin</a>
                </div>
            </div>
        </nav>

        <div class="card p-4">
            <h2 class="mb-4"><i class="bi bi-pencil-square"></i> Bewerk blog</h2>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="bi bi-type"></i> Titel</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($blog->title) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="bestand" class="form-label"><i class="bi bi-image"></i> Afbeelding</label>
                    <input type="file" id="bestand" name="bestand" class="form-control">
                    <?php if (!empty($blog->image)) : ?>
                        <div class="mt-3">
                            <img src="../images/upload/<?= htmlspecialchars($blog->image) ?>" alt="Huidige afbeelding" class="img-thumbnail" style="max-width: 200px;">
                            <small class="text-muted d-block mt-1">Huidige afbeelding: <?= htmlspecialchars($blog->image) ?></small>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label"><i class="bi bi-card-text"></i> Inhoud</label>
                    <textarea id="content" name="content" class="form-control jqte" required><?= htmlspecialchars($blog->content) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label"><i class="bi bi-person-circle"></i> Auteur</label>
                    <input type="text" id="author" name="author" class="form-control" value="<?= htmlspecialchars($blog->author) ?>" required>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Opslaan</button>
                    <a href="admin.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Annuleer</a>
                </div>
            </form>
        </div>

        <?php if ($showToast): ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
                <div id="liveToast" class="toast show text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success text-white">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong class="me-auto">Succes</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Sluiten"></button>
                    </div>
                    <div class="toast-body">
                        <?= htmlspecialchars($message) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-te-1.4.0.min.js"></script>
    <script>
        $('.jqte').jqte();
    </script>
</body>

</html>

