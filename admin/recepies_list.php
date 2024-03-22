<?php
include "functions.php";
is_loggedin();
include "head.php";
?>
<main>
    <h2>Recepies</h2>
    <li style="font-weight:bold;font-size:1rem"><a style="text-decoration:none;color:white" href="recepies_new.php">Add new Recepie</a></li>
    <?php
    // $result = mysqli_query($db, "SELECT * FROM zutaten");
    // $result = query("SELECT * FROM rezepte ORDER BY titel ASC");
    // Select 1 and 2 FROM 1 JOIN 2 ON (What column)(wher) 1.UserID = 1.ID ORDER blahblah
    $result = query("SELECT rezepte.*, benutzer.benutzername FROM rezepte LEFT JOIN benutzer ON rezepte.benutzer_id = benutzer.id ORDER BY rezepte.titel ASC");

    echo "<br>";
    // print_r($result);
    // die();
    echo "<table border='1'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>beschreibung</th>";
                echo "<th>User</th>";
                echo "<th>Action</th>";
            echo "</tr>";
        echo "</thead>";
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row);
        // die();
        echo "<tbody>";
            echo "<tr>";
                echo "<td>" . $row["titel"] . "</td>";
                echo "<td>" . $row["beschreibung"] . "</td>";
                echo "<td>" . $row["benutzername"] . "</td>";
                echo "<td>" 
                . "<a href='recepies_change.php?id={$row["id"]}'>Change</a> "
                . "- <a href='recepies_delete.php?id={$row["id"]}'>Erase</a>" 
                . "</td>";
            echo "</tr>";
        echo "</tbody>";
    };
    echo "</table>";

    ?>
</main>

<?php
include "footer.php";
?>
<a href=""></a>