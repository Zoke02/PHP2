<?php
include "functions.php";
is_loggedin();
include "head.php";
?>
<main>
    <h2>Ingredients</h2>
    <li style="font-weight:bold;font-size:1rem"><a style="text-decoration:none;color:white" href="ingredients_new.php">Add new ingredients</a></li>
    <?php
    // $result = mysqli_query($db, "SELECT * FROM zutaten");
    $result = query("SELECT * FROM zutaten ORDER BY titel ASC");
    echo "<br>";
    // print_r($result);
    echo "<table border='1'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Ammount</th>";
                echo "<th>Content</th>";
                echo "<th>kcal / 100g</th>";
                echo "<th>Action</th>";
            echo "</tr>";
        echo "</thead>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tbody>";
            echo "<tr>";
                echo "<td>" . $row["titel"] . "</td>";
                echo "<td>" . $row["menge"] . "</td>";
                echo "<td>" . $row["einheit"] . "</td>";
                echo "<td>" . $row["kcal_pro_100"] . "</td>";
                echo "<td>" 
                . "<a href='ingredients_change.php?id={$row["id"]}'>Change</a> "
                . "- <a href='ingredients_delete.php?id={$row["id"]}'>Erase</a>" 
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