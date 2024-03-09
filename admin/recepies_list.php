<?php
include "functions.php";
include "head.php";
?>
<main>
    <h2>Ingredients</h2>
    <?php
    $result = mysqli_query($db, "SELECT * FROM ingredients");

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
                echo "<td>" . $row["TITLE"] . "</td>";
                echo "<td>" . $row["AMMOUNT"] . "</td>";
                echo "<td>" . $row["CONTENT"] . "</td>";
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