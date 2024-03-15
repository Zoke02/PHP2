<?php
include "functions.php";
is_loggedin();
include "head.php";
?>
<main>
    <h2>Ingredients</h2>
    <?php
    $result = mysqli_query($db, "SELECT * FROM zutaten");

    // print_r($result);
    echo "<table border='1'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Ammount</th>";
                echo "<th>Content</th>";
                echo "<th>kcal / 100g</th>";
            echo "</tr>";
        echo "</thead>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tbody>";
            echo "<tr>";
                echo "<td>" . $row["titel"] . "</td>";
                echo "<td>" . $row["menge"] . "</td>";
                echo "<td>" . $row["einheit"] . "</td>";
                echo "<td>" . $row["kcal_pro_100"] . "</td>";
            echo "</tr>";
        echo "</tbody>";
    };
    echo "</table>";

    ?>
</main>

<?php
include "footer.php";
?>