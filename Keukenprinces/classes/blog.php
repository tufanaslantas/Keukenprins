<?php

class BloggingOng
{
    public int $id;
    public string $title;
    public string $image;
    public string $content;
    public string $auteurnaam; 

    public static function BloggingAdminFr()
    {


        $conn = Database::start(); 

        $query = "SELECT * FROM blogs";
        $resultaat = $conn->query($query); 

        $blogging = [];
        if ($resultaat->num_rows > 0) 
        {
            while ($row = $resultaat->fetch_assoc()) 
            {
                $blog = new BloggingOng();

                $blog->id = $row['blog_id'];
                $blog->title = $row['blog_title'];
                $blog->image = $row["blog_image"];


                $blogging[] = $blog;
            }
            $conn->close();

            return $blogging;
        }
    }

    public static function BloggingDetailFr($geto)
    {
        $conn = Database::start(); 

        $query = "SELECT * FROM blogs WHERE blog_id = $geto";

        $resultaat = $conn->query($query);

        $blog = null;
        if ($resultaat->num_rows > 0) 
        {
            while ($row = $resultaat->fetch_assoc()) 
            {
                $blog = new BloggingOng();

                $blog->id = $row['blog_id'];
                $blog->title = $row['blog_title'];
                $blog->image = $row['blog_image'];
                $blog->content = $row["blog_content"];
                $blog->auteurnaam = $row["blog_author"];
                
            }
        }
    
        $conn->close();

        return $blog;
    }


    public function NieuwBlog()
    {


        $conn = Database::start();

        $title = mysqli_real_escape_string($conn, $this->title); 
        $image = mysqli_real_escape_string($conn, $this->image);
        $content = mysqli_real_escape_string($conn, $this->content);
        $author = mysqli_real_escape_string($conn, $this->auteurnaam);

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


        $conn->query($sql);

        $conn->close();
    }




    public function aanpassen()
    {
        $conn = Database::start();

        $id = mysqli_real_escape_string($conn, $this->id);
        $title = mysqli_real_escape_string($conn, $this->title);
        $image = mysqli_real_escape_string($conn, $this->image);
        $content = mysqli_real_escape_string($conn, $this->content);
        $author = mysqli_real_escape_string($conn, $this->auteurnaam);

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


        $conn->query($sql);

        $conn->close();
    }

    public function VerwijderBlog() 
    {
        $conn = Database::start();

        $sql = "
        DELETE FROM 
        blogs
        WHERE 
            blog_id = " . $this->id . "
        ";

        $conn->query($sql);

        $conn->close();
    }
}