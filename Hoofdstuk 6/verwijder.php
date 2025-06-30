<?php

include "database.php";
include "provincies.php";

if (!isset($_GET['id'])) {
    die("geen ID gevonden");
}

$vochtneit = Vochtneit::find($_GET['id']);

if ($vochtneit == null) {
    die("geen provincie niet gevonden");
}

if ($vochtneit->delete()) {
    header("Location: overzicht.php?bericht=Provincie verwijderd");
    exit;
} else {
    echo "verwijderen lukt niet";
}

?>
