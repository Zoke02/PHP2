<?php
include "functions.php";
is_loggedin();

$sql_id = escape($_GET["id"]);
$erfolgt = false;
$errors = array();

// THIS IS HOW WHEN U CLICK SUBMIT U GET DATA LIKE A ONCLICK EFFECT
if (!empty($_POST)) {
    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    // Validate fields
    if (empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        // Check if a ingredient with same title exists AND if the ID is NOT the SAME
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}' AND id != '{$sql_id}'");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $errors[] = "Ingredient is on the list";
        }
    }
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

        query("UPDATE zutaten SET 
        titel = '{$sql_titel}',
        kcal_pro_100 = '{$sql_kcal_pro_100}', 
        menge = '{$sql_menge}',
        einheit = '{$sql_einheit}'
        WHERE id = '{$sql_id}'
        ");
        $erfolgt = true;
    }
}

include "head.php";
?>
<?php 
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $key => $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
    }

    // Next 2 lines are for Inserting Curent Values from DataBank into respecting fields.
    $result = query("SELECT * FROM zutaten WHERE id='{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    // 
    if ($erfolgt) {
        echo "<h1>";
        echo "Ingredient Changed!";
        echo "<br>";
        echo "<a href='ingredients_list.php'><ul>
        <li style='font-size:1rem'>Back to List of Ingredients</li>
        </ul></a>";
        echo "</h1>";
    }   
?>
<a href=""></a>
<h4>Change ingredient</h4>
<form action="ingredients_change.php?id=<?php echo $row["id"] ?>" method="post">
    <div>
        <label for="titel">Ingredient:</label>
        <input type="text" name="titel" id="titel" value="<?php 
        // I think this makes it so that if u write a differit item it says item is on list.
        if ( !$erfolgt && !empty($_POST["titel"])) {
            // in the event of an error - after/wrong value is written back into the field
            echo htmlspecialchars($_POST["titel"]);
        } else {
            // Database value is entered into the field (prefill)
            echo htmlspecialchars($row["titel"]); 
        }?>">
    </div>
    <div>
        <label for="kcal_pro_100">KCal/100</label>
        <input type="number" name="kcal_pro_100" id="kcal_pro_100" value="<?php 
        if ( !$erfolgt && !empty($_POST["kcal_pro_100"])) {
            echo htmlspecialchars($_POST["kcal_pro_100"]);
        } else {
            echo htmlspecialchars($row["kcal_pro_100"]); 
        }?>">
    </div>
    <div>
        <label for="menge">Menge</label>
        <input type="number" name="menge" id="menge" value="<?php 
        if ( !$erfolgt && !empty($_POST["menge"])) {
            echo htmlspecialchars($_POST["menge"]);
        } else {
            echo htmlspecialchars($row["menge"]); 
        }?>">
    </div>
    <div>
        <label for="einheit">Einheit</label>
        <input type="text" name="einheit" id="einheit" value="<?php 
        if ( !$erfolgt && !empty($_POST["einheit"])) {
            echo htmlspecialchars($_POST["einheit"]);
        } else {
            echo htmlspecialchars($row["einheit"]); 
        }?>">
    </div>
    <button type="submit">Zutat Save</button>
</form>

<?php
include "footer.php";
?>