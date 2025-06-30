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

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichTextEditor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-te-1.4.0.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>RichTextEditor</h2>
            <form method="POST" action="weergeven.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="jqte" id="content" name="content" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('.jqte').jqte();
</script>
</body>
</html>
