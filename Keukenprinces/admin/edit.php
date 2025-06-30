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
$blog = BloggingOng::BloggingDetailFr($blog_id);

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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar bg-danger">
                    <div class="container-fluid">
                        <a href="../index.php" class="btn btn-warning">Home</a>
                        <a href="insert.php" class="btn btn-warning">Create Blog</a>
                        <a href="admin.php" class="btn btn-warning">Admin</a>
                    </div>
                </nav>
                
                <h2 class="my-4">Edit Blog</h2>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($blog->title) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bestand" class="form-label">Image</label>
                        <input type="file" class="form-control" id="bestand" name="bestand">
                        <?php if (!empty($blog->image)): ?>
                            <div class="mt-2">
                                <img src="../images/upload/<?= htmlspecialchars($blog->image) ?>" alt="Current Image" style="max-width: 200px;" class="img-thumbnail">
                                <p class="text-muted mt-1">Current image: <?= htmlspecialchars($blog->image) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="jqte form-control" id="content" name="content" required><?= htmlspecialchars($blog->content) ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($blog->auteurnaam) ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                    <a href="admin.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <?php if ($showToast): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= htmlspecialchars($message) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-te-1.4.0.min.js"></script>
    <script>
        $('.jqte').jqte();
    </script>
</body>
</html>