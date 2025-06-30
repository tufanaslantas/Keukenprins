<?php

// geleend van me steptember bestand ^_^
class Kasabalar
{
    public string $Id;
    public string $Naam;
    public string $Populatie;
    public string $Provincie;
    public string $Burgemeester;
    public string $Uitgevonden;

    public static function Kasabalar()
    {
        $conn = Database::start();        
    
        $query = "SELECT * FROM `cities`";
        $resultaat = $conn->query($query);
    
        $kasabalarlar = [];
    
        if ($resultaat->num_rows > 0)
        {
            while($row = $resultaat->fetch_assoc())
            {
                $kasabalar = new Kasabalar();
                
                $kasabalar->Id = $row['city_id'];
                $kasabalar->Naam = $row['city_name'];
                $kasabalar->Populatie = $row['city_population'];
                $kasabalar->Provincie = $row['city_province'];
                $kasabalar->Burgemeester = $row['city_mayor'];
                $kasabalar->Uitgevonden = $row['city_foundation_date'];
                $kasabalarlar[] = $kasabalar;
            }
        }

        $conn->close();

        return $kasabalarlar;
    }

    public static function find($Id)
    {
        $conn = Database::start();        
    
        $query = "SELECT * FROM `cities` WHERE city_id = ". $Id;
        $resultaat = $conn->query($query);  
            
        $kasabalar = null;

        if ($resultaat->num_rows > 0)
        {
            while($row = $resultaat->fetch_assoc())
            {
                $kasabalar = new Kasabalar();
                
                $kasabalar->Id = $row['city_id'];
                $kasabalar->Naam = $row['city_name'];
                $kasabalar->Populatie = $row['city_population'];
                $kasabalar->Provincie = $row['city_province'];
                $kasabalar->Burgemeester = $row['city_mayor'];
                $kasabalar->Uitgevonden = $row['city_foundation_date'];
            }
        }

        $conn->close();

        return $kasabalar;
    }

}

?>