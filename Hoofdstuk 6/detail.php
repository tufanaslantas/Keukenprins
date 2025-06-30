<?php

include "database.php";
include "provincies.php";

if (!isset($_GET["id"])) {
    header("location: overzicht.php?bericht=Geen id gevonden");
    exit;
}

$vochtneit = Vochtneit::find($_GET["id"]);

if ($vochtneit == null) {
    header("location: overzicht.php?bericht=Geen provincie gevonden");
    exit;
}
?>
<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Populatie</th>
            <th>Hoofdstad</th>
            <th>Area</th>
            <th>Uitgevonden</th>
        </tr>
    </thead>
</table>

       <tr>
         <td><?= $vochtneit->Naam; ?></td>
         <td><?= $vochtneit->Populatie; ?></td>
         <td><?= $vochtneit->Hoofdstad; ?></td>
         <td><?= $vochtneit->Area; ?></td>
         <td><?= $vochtneit->Uitgevonden; ?></td>
       </tr>

</tbody>
    </table>