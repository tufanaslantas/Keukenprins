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