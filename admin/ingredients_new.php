<?php
include "functions.php";
is_loggedin();
$erfolgt = false;
$errors = array();
// Check if the formular was filled
if (!empty($_POST)) {

    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    if (empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        //$result = mysqli_query($db, "SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");

        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $errors[] = "Zutat is on in list";
        }
    }
    // Commented for line 39
    // if (empty($_POST["kcal_pro_100"])) {
    //     $errors[] = "Bitte geben Sie einen KCal/100 für die Zutat an.";
    // }
    // if (empty($_POST["menge"])) {
    //     $errors[] = "Bitte geben Sie menge für die Zutat an.";
    // }
    // if (empty($_POST["einheit"])) {
    //     $errors[] = "Bitte geben Sie Einheit für die Zutat an.";
    // }

    // if no errors save the ingredient in databanking
    if(empty($errors)) {

        if ($sql_kcal_pro_100 == "") {
            $sql_kcal_pro_100 = "NULL";
        };
        if ($sql_einheit == "") {
            $sql_einheit = "NULL";
        };
        if ($sql_menge == "") {
            $sql_menge = "NULL";
        };

        query("INSERT INTO zutaten SET 
        titel = '{$sql_titel}',
        kcal_pro_100 = '{$sql_kcal_pro_100}', 
        menge = '{$sql_menge}',
        einheit = '{$sql_einheit}'
        ");
        // by line kcal_pro_100 = {$sql_kcal_pro_100} i took '' out so its NULL and not 0
        $erfolgt = true;
    }

}


include "head.php";
?>
    <h1>Add new ingredient</h1>
    <?php 
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $key => $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
    }
    if ($erfolgt) {
        echo "<h1>";
        echo "Ingredient Added!";
        echo "<br>";
        echo "<a href='ingredients_list.php'><ul>
        <li style='font-size:1rem'>Back to List of Ingredients</li>
        </ul></a>";
        echo "</h1>";
    } 
    ?>
    <form action="ingredients_new.php?" method="post">
        <div>
            <label for="titel">Ingredient:</label>
            <input type="text" name="titel" id="titel">
        </div>
        <div>
            <label for="kcal_pro_100">KCal/100</label>
            <input type="number" name="kcal_pro_100" id="kcal_pro_100">
        </div>
        <div>
            <label for="menge">Menge</label>
            <input type="number" name="menge" id="menge">
        </div>
        <div>
            <label for="einheit">Einheit</label>
            <input type="text" name="einheit" id="einheit">
        </div>
        <button type="submit">Submit</button>
    </form>
<?php 
include "footer.php";
?>