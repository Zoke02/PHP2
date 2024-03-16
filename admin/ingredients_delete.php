<?php
include "functions.php";
is_loggedin();
include "head.php";


echo "<h1>Ingredient DELETED</h1>";


$sql_id = escape($_GET["id"]);

if (!empty($_GET["doit"])) {
    query("DELETE FROM zutaten WHERE id='{$sql_id}'");
    echo "<p> Ingredient DELETED </p>";
    echo "<a href='ingredients_list.php'><ul>
    <li style='font-size:1rem'>Back to List of Ingredients</li>
    </ul></a>";

} else {
    // Benutzer Fragen, ob die Zutate wirklich entfern werder soll
    $result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    // Prüfen ob die Zutat noch in einem Rezept vorkommt 
    $result2 = query("SELECT * FROM zutaten_zu_rezepte WHERE zutaten_id = '{$sql_id}'");
    $ist_mit_rezepte_verknüpft = mysqli_fetch_assoc($result2);


    if (empty($row)) {
        // Zutat existiert nicht
        echo "<p>Zutat existiert nicht(mehr).</p>";
        echo "<a href='ingredients_list.php'><ul>
            <li style='font-size:1rem'>Back to List of Ingredients</li>
            </ul></a>";
    } else if ($ist_mit_rezepte_verknüpft) {
        echo "U cant delete " . htmlspecialchars($row["titel"])  . " because a recepie uses that ingredient";
    }
    else {
        echo "<p>Are you sure u want to delete the ingredient ". htmlspecialchars($row["titel"]) . "?</p>";
        echo "<p>"
        . "<a href='ingredients_list.php'>No</a>"
        . " "
        . "<a href='ingredients_delete.php?id={$row['id']}&amp;doit=1'>Yes</a>"
        . "</p>";
    };
};


include "footer.php";
?>
<a href=""></a>