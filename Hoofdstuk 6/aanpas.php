<?php
include "database.php";
include "provincies.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["id"])) {
        die("Geen ID opgegeven");
    }

    $vochtneit = Vochtneit::find($_POST["id"]);

    if ($vochtneit == null) {
        die("Geen provincie gevonden");
    }

    // Update properties from form
    $vochtneit->Naam = $_POST["naam"];
    $vochtneit->Populatie = $_POST["populatie"];
    $vochtneit->Hoofdstad = $_POST["hoofdstad"];
    $vochtneit->Area = $_POST["area"];
    $vochtneit->Uitgevonden = $_POST["uitgevonden"];

    if ($vochtneit->update()) {
        header("Location: detail.php?id=" . $vochtneit->Id);
        exit;
    }

} else {
    if (!isset($_GET["id"])) {
        die("Geen ID gevonden");
    }

    $vochtneit = Vochtneit::find($_GET["id"]);

    if ($vochtneit == null) {
        die("Geen provincie gevonden");
    }
    ?>

    <h2>Provincie aanpassen</h2>

    <form method="post" action="aanpas.php">
        <input type="hidden" name="id" value="<?= $vochtneit->Id ?>">

        <label>Naam:</label>
        <input type="text" name="naam" value="<?= $vochtneit->Naam ?>"><br>

        <label>Populatie:</label>
        <input type="text" name="populatie" value="<?= $vochtneit->Populatie ?>"><br>

        <label>Hoofdstad:</label>
        <input type="text" name="hoofdstad" value="<?= $vochtneit->Hoofdstad ?>"><br>

        <label>Oppervlakte (km²):</label>
        <input type="text" name="area" value="<?= $vochtneit->Area ?>"><br>

        <label>Gesticht op:</label>
        <input type="date" name="uitgevonden" value="<?= $vochtneit->Uitgevonden ?>"><br><br>

        <button type="submit">Opslaan</button>
    </form>

<?php } ?>
