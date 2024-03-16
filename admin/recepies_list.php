<?php
include "functions.php";
is_loggedin();
include "head.php";
?>
<main>
    <h2>Recepes</h2>
    <li style="font-weight:bold;font-size:1rem"><a style="text-decoration:none;color:white" href="ingredients_new.php">List of Recepies</a></li>
    <?php
    // $result = mysqli_query($db, "SELECT * FROM zutaten");
    $result = query("SELECT * FROM rezepte");
    echo "<br>";
    // print_r($result);
    echo "<table border='1'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>beschreibung</th>";
                echo "<th>User ID</th>";
                echo "<th>Action</th>";
            echo "</tr>";
        echo "</thead>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tbody>";
            echo "<tr>";
                echo "<td>" . $row["titel"] . "</td>";
                echo "<td>" . $row["beschreibung"] . "</td>";
                echo "<td>" . $row["benutzer_id"] . "</td>";
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