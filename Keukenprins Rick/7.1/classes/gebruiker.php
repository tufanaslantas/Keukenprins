<?php

class Gebruiker
{

    public string $id;
    public string $name;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $admin;

    public string $step_id;
    public string $step_user_id;
    public string $step_date;
    public string $step_total;


    public static function findByUsernameAndPassword($username, $password) // deze koekeloert of de gebruiker wel besaat aan de hand van de gebruikersnaam en wachtwoord op de vorige pagina
    {
        $conn = Database::start();
        

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        

        $query = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
        $resultaat = $conn->query($query);

        $gebruikertje = null;
        if ($resultaat->num_rows > 0) {
            $rij = $resultaat->fetch_assoc();
            

            $gebruikertje = new Gebruiker;
            $gebruikertje->id = $rij["user_id"];
            $gebruikertje->name = $rij["user_username"];
            $gebruikertje->password = $rij["user_password"];
            $gebruikertje->firstName = $rij["user_firstname"];
            $gebruikertje->lastName = $rij["user_lastname"];
            $gebruikertje->admin = $rij["user_admin"];  
            
    
        }
        $conn->close();
        return $gebruikertje;
    }


    public static function zoekIdeeeee($user_id) // deze haalt het idee op, heeft geen nut aangezien dit niet steptember is (was te lui om weg te halen)
    {
        

        $conn = Database::start();



        $user_id = mysqli_real_escape_string($conn, $user_id);

        
        

        $query = "SELECT * FROM users WHERE user_id = '$user_id' ";
        $resultaat = $conn->query($query);

        $gebruikertje = null;
        if ($resultaat->num_rows > 0) {
            $rij = $resultaat->fetch_assoc();
            

            $gebruikertje = new Gebruiker;
            $gebruikertje->id = $rij["user_id"];
            $gebruikertje->name = $rij["user_username"];
            $gebruikertje->password = $rij["user_password"];
            $gebruikertje->firstName = $rij["user_firstname"];
            $gebruikertje->lastName = $rij["user_lastname"];
            
            
    
        }
        $conn->close();
        return $gebruikertje; 
    }



    public static function findUserStepsInfo($user_id) // doet nog steeds helemaal niks
    {

        

        $conn = Database::start();


        $query="SELECT * FROM steps WHERE";
        $conn->close();



    }
    



}
