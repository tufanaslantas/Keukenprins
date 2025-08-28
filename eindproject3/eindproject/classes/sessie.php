<?php
class Sessie
{
    public int $id;
    public int $userId;
    public string $key;
    public string $start;
    public string $end;

public static function findActiveSession(): ?Sessie
{
    if (!isset($_COOKIE["steptember-session"])) {
        return null;
    }

    $conn = Database::start();
    $sessie = null;
    $key = $_COOKIE["steptember-session"];
    $now = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("SELECT * FROM sessions WHERE session_key = ? AND session_end > ?");
    $stmt->bind_param("ss", $key, $now);
    $stmt->execute();
    $resultaat = $stmt->get_result();

    if ($resultaat && $resultaat->num_rows > 0) {
        $rij = $resultaat->fetch_assoc();

        $sessie = new Sessie();
        $sessie->id = (int)$rij["session_id"];
        $sessie->userId = (int)$rij["session_user_id"];
        $sessie->key = $rij["session_key"];
        $sessie->start = $rij["session_start"];
        $sessie->end = $rij["session_end"];
    }

    $stmt->close();
    $conn->close();

    return $sessie;
}

    public function insert(): bool
    {
        $conn = Database::start();
        $success = false;

        $stmt = $conn->prepare("INSERT INTO sessions (
            session_user_id, 
            session_key, 
            session_start, 
            session_end
        ) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("isss", 
            $this->userId, 
            $this->key, 
            $this->start, 
            $this->end
        );

        $success = $stmt->execute();
        $stmt->close();
        $conn->close();

        return $success;
    }
}