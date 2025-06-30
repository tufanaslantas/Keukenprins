<?php


class Database
{

    public static function start()
    {
        $dbServername = "127.0.0.1";
        $dbUsername = "root";
        $dbPassword = "";
        $dbDatabase = "keukenprins";

        //conectie

        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbDatabase);

        if ($conn->connect_error) {
            die("connectie mislukt: " . $conn->connect_error);
        }


        return $conn;
    }





    public function ditdoetniks()
    {
        
        $conn = Database::start();

        // voorbeeld
        $query = "SELECT * FROM";

        $resultaat = $conn->query($query);




    }



}

   









?>