<?php

include "database.php";
include "kasabalar.php";

if (!isset($_GET["id"])) {
    header("location: overzicht.php?bericht=Geen id gevonden");
    exit;
}

$kasabalar = Kasabalar::find($_GET["id"]);

if ($kasabalar == null) {
    header("location: overzicht.php?bericht=Geen stad gevonden");
    exit;
}
?>
<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Populatie</th>
            <th>Provincie</th>
            <th>Burgemeester</th>
            <th>Uitgevonden</th>
        </tr>
    </thead>
</table>

       <tr>
         <td><?= $kasabalar->Naam; ?></td>
         <td><?= $kasabalar->Populatie; ?></td>
         <td><?= $kasabalar->Provincie; ?></td>
         <td><?= $kasabalar->Burgemeester; ?></td>
         <td><?= $kasabalar->Uitgevonden; ?></td>
       </tr>

</tbody>
    </table>