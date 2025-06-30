<table>
    
  <?php

include "database.php";
include "provincies.php";

if (isset($_GET["bericht"])) {
  echo $_GET["bericht"];
}

$vochtneits = Vochtneit::Vochtneit();

foreach ($vochtneits as $vochtneit) { ?>
       <tr>
         <td><?= $vochtneit->Naam; ?></td>
         <td><a href="detail.php?id=<?= $vochtneit->Id; ?>">Bekijk</a></td>
         <td><a href="aanpas.php?id=<?= $vochtneit->Id; ?>">Aanpassen</a></td>
       </tr>
    <?php   
   }

?>

</table>