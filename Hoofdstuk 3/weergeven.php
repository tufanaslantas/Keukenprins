<?php
$content = $_POST['content'] ?? 'Geen content ontvangen.';
?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Weergeven</title>
</head>
<body>
    <?= $content ?>
</body>
</html>