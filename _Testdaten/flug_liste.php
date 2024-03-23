<?php
include "funktionen.php";
include "kopf.php";

$result = query("SELECT * FROM fluege ORDER BY abflug ASC");
?>
    <h1>Alle Flüge</h1>



    <div class='row font-weight-bold border-bottom text-center'>
      <div class='col-2'>Flugnummer</div>
      <div class='col-3'>Abflug</div>
      <div class='col-3'>Ankunft</div>
      <div class='col-2'>Startflughafen</div>
      <div class='col-2'>Zielflughafen</div>
    </div>

    <?php
    // $result = query("SELECT * FROM fluege ORDER BY abflug ASC");
    $date = date("Y-m-d H:m:s");
    // echo $date;

      while ($row = mysqli_fetch_assoc($result)){
        if ( $row["ankunft"] >= $date) {
        echo "<div class='row text-center'>";
          echo "<div class='col-2'>". $row["flugnr"] ."</div>";
          echo "<div class='col-3'>". $row["abflug"] ."</div>";
          echo "<div class='col-3'>". $row["ankunft"] ."</div>";
          echo "<div class='col-2'>". $row["start_flgh"] ."</div>";
          echo "<div class='col-2'>". $row["ziel_flgh"] ."</div>";
        echo"</div>";
        }
      }
    ?>
<?php
include "fuss.php";
?>
