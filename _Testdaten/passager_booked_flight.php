<?php
include "funktionen.php";
include "kopf.php";
$user_id = escape($_GET["user_id"]);
$sql_id = escape($_GET["id"]);
query("UPDATE passagiere SET
    fluege_id = '{$sql_id}'
    WHERE id = '{$user_id}'
")
?>

<h1>Flight Booked</h1>


<?php
include "fuss.php";
?>