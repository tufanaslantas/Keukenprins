<?php
include "../classes/database.php";
include "../classes/blog.php";
include "../classes/sessie.php";

$sessie = Sessie::FindActiveSession();
if ($sessie == null) {
    header("location: ../index.php");
    exit;
}

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
    $blog->VerwijderBlog();
    header("Location: admin.php?deleted=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verwijder Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <nav class="navbar bg-danger mb-4">
            <div class="container-fluid">
                <a href="../index.php" class="btn btn-warning">Home</a>
                <a href="insert.php" class="btn btn-warning">Blog toevoegen</a>
                <a href="admin.php" class="btn btn-warning">Admin</a>
            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger text-center p-4">
                    <h4 class="mb-3">Weet je zeker dat je deze blog wilt verwijderen?</h4>
                    <p class="fw-bold"><?= htmlspecialchars($blog->title) ?></p>

                    <form method="POST" class="d-flex justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn btn-danger">Ja, verwijderen</button>
                        <a href="admin.php" class="btn btn-secondary">Annuleer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
