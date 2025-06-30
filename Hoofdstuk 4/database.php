<?php

class Database
{
    public static function start()
    {
        $dbServername = "127.0.0.1";
        $dbUsername = "root";
        $dbPassword = "";
        $dbDatabase = "keukenprins";

        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbDatabase);

        if ($conn->connect_error) {
            die("Connectie mislukt: " . $conn->connect_error);
        }

        return $conn;

    }
}

?>

<?php
$image = null;

if (isset($_POST["submit"])) {

    if (!empty($_FILES["bestand"]["name"])) {
        $image = $_FILES["bestand"]["name"];

        $target = "upload/" . basename($image);

        move_uploaded_file($_FILES["bestand"]["tmp_name"], $target);
        header("Location: weergeven.php?image=" . urlencode($image));
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="bestand">Bestand:</label>
        <br />
        <input type="file" id="bestand" name="bestand" />
        <br/><br />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <?php if (!empty($image)) { ?>
        <img src="upload/<?= $image; ?>" alt="Afbeelding" />
    <?php } ?>
</body>
</html>
