<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";

echo "<h1>Rezept entfernen</h1>";
$sql_id = escape($_GET["id"]);

if ( !empty($_GET["doit"]) ) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    query("DELETE FROM rezepte WHERE id = '{$sql_id}'");
    echo "<p>Rezept wurde erfolgreich entfernt.<br>
    <a href='rezepte_liste.php'>Zurück zur Liste</a>
    </p>";

} else {
    //Benutzer fragen, ob die Zutate wirklich entfernt werden soll
    $result = query("SELECT * FROM rezepte WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    if ( empty( $row ) ) {
        //Zutat existiert nicht
        echo "<p>Rezept existiert nicht (mehr).
        <br /><a href='rezepte_liste.php'>Zurück zur Liste</a>
        </p>";
    } else {
        echo "<p>Sind Sie sicher, dass sie die Zutat <strong>".htmlspecialchars($row["titel"])
            ."</strong> entfernen möchten?"
            ."</p>";
        echo "<p>"
            . "<a href='rezepte_liste.php'>Nein, abbrechen.</a>
            <a href='rezepte_entfernen.php?id={$row['id']}&amp;doit=1'>Ja, sicher.</a>"
            ."</p>";
    }
}
include "fuss.php";