<?php
class Vochtneit
{
    public string $Id;
    public string $Naam;
    public string $Hoofdstad;
    public string $Populatie;
    public string $Area;
    public string $Uitgevonden;

    public static function Vochtneit()
    {
        $conn = Database::start();        

        $query = "SELECT * FROM `provinces`";
        $resultaat = $conn->query($query);

        $vochtneits = [];

        if ($resultaat->num_rows > 0)
        {
            while($row = $resultaat->fetch_assoc())
            {
                $vochtneit = new Vochtneit();

                $vochtneit->Id = $row['province_id'];
                $vochtneit->Naam = $row['province_name'];
                $vochtneit->Hoofdstad = $row['province_capital'];
                $vochtneit->Populatie = $row['province_population'];
                $vochtneit->Area = $row['province_area_km2'];
                $vochtneit->Uitgevonden = $row['province_foundation_date'];
                $vochtneits[] = $vochtneit;
            }
        }

        $conn->close();

        return $vochtneits;
    }

    public static function find($Id)
    {
        $conn = Database::start();        

        $query = "SELECT * FROM `provinces` WHERE province_id = ". $Id;
        $resultaat = $conn->query($query);  

        $vochtneit = null;

        if ($resultaat->num_rows > 0)
        {
            while($row = $resultaat->fetch_assoc())
            {
                $vochtneit = new Vochtneit();

                $vochtneit->Id = $row['province_id'];
                $vochtneit->Naam = $row['province_name'];
                $vochtneit->Hoofdstad = $row['province_capital'];
                $vochtneit->Populatie = $row['province_population'];
                $vochtneit->Area = $row['province_area_km2'];
                $vochtneit->Uitgevonden = $row['province_foundation_date'];
            }
        }

        $conn->close();

        return $vochtneit;
    }

    public function update(): bool
    {
        $conn = Database::start();

        $id = $conn->real_escape_string($this->Id);
        $naam = $conn->real_escape_string($this->Naam);
        $hoofdstad = $conn->real_escape_string($this->Hoofdstad);
        $populatie = $conn->real_escape_string($this->Populatie);
        $area = $conn->real_escape_string($this->Area);
        $uitgevonden = $conn->real_escape_string($this->Uitgevonden);

        $query = "
            UPDATE provinces SET
            province_name = '$naam',
            province_capital = '$hoofdstad',
            province_population = '$populatie',
            province_area_km2 = '$area',
            province_foundation_date = '$uitgevonden'
            WHERE province_id = $id
        ";

        $result = $conn->query($query);
        $conn->close();

        return $result === TRUE;
    }
}


?>