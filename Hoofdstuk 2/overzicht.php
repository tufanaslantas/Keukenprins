<table>
  <?php

include "database.php";
include "kasabalar.php";

if (isset($_GET["bericht"])) {
  echo $_GET["bericht"];
}

$kasabalarlar = Kasabalar::Kasabalar();

foreach ($kasabalarlar as $kasabalar) { ?>
       <tr>
         <td><?= $kasabalar->Naam; ?></td>
         <td><a href="detail.php?id=<?= $kasabalar->Id; ?>">Bekijk</a></td>
       </tr>
    <?php   
   }

?>
</table>