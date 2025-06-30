<?php

class Gebruiker
{

    public string $id;
    public string $name;
    public string $password;
    public string $voornaam;
    public string $achternaam;
    public string $admin;

    public string $step_id;
    public string $step_user_id;
    public string $step_date;
    public string $step_total;


    public static function FindInfo($username, $password)
    {
        $conn = Database::start();
        

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        

        $query = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
        $resultaat = $conn->query($query);

        $gebruiker = null;
        if ($resultaat->num_rows > 0) {
            $rij = $resultaat->fetch_assoc();
            

            $gebruiker = new Gebruiker;
            $gebruiker->id = $rij["user_id"];
            $gebruiker->name = $rij["user_username"];
            $gebruiker->password = $rij["user_password"];
            $gebruiker->voornaam = $rij["user_voornaam"];
            $gebruiker->achternaam = $rij["user_achternaam"];
            $gebruiker->admin = $rij["user_admin"];  
            
    
        }
        $conn->close();
        return $gebruiker;
    }

    public static function FindId($user_id)
    {
        
        $conn = Database::start();

        $user_id = mysqli_real_escape_string($conn, $user_id);     
        
        $query = "SELECT * FROM users WHERE user_id = '$user_id' ";
        $resultaat = $conn->query($query);

        $gebruiker = null;
        if ($resultaat->num_rows > 0) {
            $rij = $resultaat->fetch_assoc();
            
            $gebruiker = new Gebruiker;
            $gebruiker->id = $rij["user_id"];
            $gebruiker->name = $rij["user_username"];
            $gebruiker->password = $rij["user_password"];
            $gebruiker->voornaam = $rij["user_voornaam"];
            $gebruiker->achternaam = $rij["user_achternaam"];            
        }
        $conn->close();
        return $gebruiker; 
    }
    public static function findUserStepsInfo($user_id) // poep
    {      

        $conn = Database::start();

        $query="SELECT * FROM steps WHERE";
        $conn->close();
    }

}