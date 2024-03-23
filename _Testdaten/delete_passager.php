<?php
include "funktionen.php";
include "kopf.php";
$sql_id = escape($_GET["id"]);
query("DELETE FROM passagiere WHERE id = '{$sql_id}'")
?>
<!-- Sorry i didnt have time to make a question. -->
<h1>Passager Delete</h1>


<?php
include "fuss.php";
?>