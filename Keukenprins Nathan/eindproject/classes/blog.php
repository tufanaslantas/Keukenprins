<?php

class Blogging
{
    public int $id;
    public string $title;
    public string $image;
    public string $content;
    public string $author; 

  public static function BlogAdmin()
{
    $conn = Database::start(); 

    $query = "SELECT * FROM blogs";
    $resultaat = $conn->query($query); 

    $blogging = [];

    if ($resultaat && $resultaat->num_rows > 0) 
    {
        while ($row = $resultaat->fetch_assoc()) 
        {
            $blog = new Blogging();

            $blog->id = $row['blog_id'];
            $blog->title = $row['blog_title'];
            $blog->image = $row["blog_image"];

            $blogging[] = $blog;
        }
    }

    $conn->close();

  
    return $blogging;
}


    public static function BloggingDetail($geto)
    {
        $conn = Database::start(); 

        $query = "SELECT * FROM blogs WHERE blog_id = $geto";

        $resultaat = $conn->query($query);

        $blog = null;
        if ($resultaat->num_rows > 0) 
        {
            while ($row = $resultaat->fetch_assoc()) 
            {
                $blog = new Blogging();

                $blog->id = $row['blog_id'];
                $blog->title = $row['blog_title'];
                $blog->image = $row['blog_image'];
                $blog->content = $row["blog_content"];
                $blog->author = $row["blog_author"];
                
            }
        }
    
        $conn->close();

        return $blog;
    }


    public function NewBlog()
    {


        $conn = Database::start();

        $title = mysqli_real_escape_string($conn, $this->title); 
        $image = mysqli_real_escape_string($conn, $this->image);
        $content = mysqli_real_escape_string($conn, $this->content);
        $author = mysqli_real_escape_string($conn, $this->author);

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

    $title = mysqli_real_escape_string($conn, $this->title);
    $image = mysqli_real_escape_string($conn, $this->image);
    $content = mysqli_real_escape_string($conn, $this->content);
    $author = mysqli_real_escape_string($conn, $this->author);

    $sql = "UPDATE blogs 
            SET 
                blog_title = '$title',
                blog_image = '$image',
                blog_content = '$content',
                blog_author = '$author'
            WHERE blog_id = $this->id";

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