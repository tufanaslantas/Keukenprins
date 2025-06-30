<?php

class Blogje // classe
{
    public int $id; // id 
    public string $title; // titel
    public string $image; // foto
    public string $content; // inhoud
    public string $ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe;  // auteur




    public static function ffAlleBlogjesZoekenVoorDeAdminPaginaDinges() // dit ding zoekt uhhh, voor de admin pagina de titel en id op zodat wanneer meenertje of mevrouwtje er op klikt die naar de aanpas pagina kan.
    {


        $conn = Database::start(); // start de database

        $query = "SELECT * FROM blogs"; // dit zoekt in de database
        $resultaat = $conn->query($query); 

        $blogss = [];
        if ($resultaat->num_rows > 0) 
        {
            while ($row = $resultaat->fetch_assoc()) 
            {
                $blog = new Blogje();

                $blog->id = $row['blog_id']; // geeft blog->id info mee net als der onder maar dan met titel
                $blog->title = $row['blog_title'];
                $blog->image = $row["blog_image"];


                $blogss[] = $blog;
            }
            $conn->close(); // sluit de verbinding

            return $blogss;
        }
    }

    public static function nuFfAlleenZoekenVoorDetailPagina($geenIdee) //kijk dit zoekt dus voor de ffEenVerbeteringOfzoAanbrengen.php pagina de informatie op van het speciefieke blog.
    {
        $conn = Database::start(); // start de database

        $query = "SELECT * FROM blogs WHERE blog_id = $geenIdee";

        $resultaat = $conn->query($query);

        $blog = null;
        if ($resultaat->num_rows > 0) 
        {
            while ($row = $resultaat->fetch_assoc()) 
            {
                $blog = new Blogje();

                $blog->id = $row['blog_id'];
                $blog->title = $row['blog_title'];
                $blog->image = $row['blog_image'];
                $blog->content = $row["blog_content"];
                $blog->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe = $row["blog_author"];
                
            }
        }
    

        $conn->close();// sluit de verbinding

        return $blog;
    }


    public function ffEenNieuweBlogToevoegenOmdatDeVorigeAlVanGisterenIsEnDatSchijntVolgensDeMarketingNietMeerRelevantTeZijnInDeSnelleContentwereldWaarinWijBlijkbaarNuLeven() // als iets of iemand een nieuwe blog wilt aanmaken kan die persoon dat dus via hier doen, zo worden er ook foto's ge daan :D
    {


        $conn = Database::start(); // start de database

        $title = mysqli_real_escape_string($conn, $this->title); // veiligheid
        $image = mysqli_real_escape_string($conn, $this->image);// veiligheid
        $content = mysqli_real_escape_string($conn, $this->content);// veiligheid
        $author = mysqli_real_escape_string($conn, $this->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe);// veiligheid

        $sql = "INSERT INTO blogs
            (
                blog_title,
                blog_image,
                blog_content,
                blog_author
    
    
    
    
    
            ) VALUES 
            (
                '" . $title . "',
                '" . $image . "',
                '" . $content . "',
                '" . $author . "'
    
            )";


        $conn->query($sql);// sluit de verbinding

        $conn->close();
    }




    public function aanpas() // update de blog of niet licht er aan of de gebruiker dat heeft gedaan
    {
        $conn = Database::start(); // start de database

        $id = mysqli_real_escape_string($conn, $this->id); // veiligheid
        $title = mysqli_real_escape_string($conn, $this->title);// veiligheid
        $image = mysqli_real_escape_string($conn, $this->image);// veiligheid
        $content = mysqli_real_escape_string($conn, $this->content);// veiligheid
        $author = mysqli_real_escape_string($conn, $this->ffDeNaamVanDeAuteurOmdatDeKlantAltijdWilWetenWieDeSchrijverIsZelfsAlsHetAlTienduizendKeerIsGezegdEnWeWillenGeenDiscussiesMeerOverDeCreditsWantDatIsAltijdGedoe);// veiligheid



        $sql = "
        UPDATE 
            blogs 
        SET 
            blog_title = '" . $title . "', 
            blog_image = ' " . $image . "', 
            blog_content = '" . $content . "',
            blog_author = ' " . $author . "'
        
        WHERE 
            blog_id = " . $id . "
        ";


        $conn->query($sql);// sluit de verbinding

        $conn->close();
    }



    public function ffEenBlogVerwijderenOmdatErIetsNietKloptMaarIkWeetNietWatEnDeKlantWilNietDatIemandHetNogZietDusIkGooiHetMaarWegEnDoenAlsofHetErNooitWas() // deze zorgt dat de blog permanent verwijderd word 👍
    {
        $conn = Database::start(); // start de database

        $sql = "
        DELETE FROM 
        blogs
        WHERE 
            blog_id = " . $this->id . "
        ";


        $conn->query($sql);// sluit de verbinding

        $conn->close();
    }
}

