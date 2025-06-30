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
$blog = BloggingOng::BloggingDetailFr($blog_id);

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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <nav class="navbar bg-danger">
                    <div class="container-fluid">
                        <a href="../index.php" class="btn btn-warning">Home</a>
                        <a href="insert.php" class="btn btn-warning">Create Blog</a>
                        <a href="admin.php" class="btn btn-warning">Admin</a>
                    </div>
                </nav>
                
                <div class="alert alert-danger mt-4">
                    <h4>Are you sure you want to delete this blog?</h4>
                    <p><strong><?= htmlspecialchars($blog->title) ?></strong></p>
                    
                    <form method="POST">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        <a href="admin.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>