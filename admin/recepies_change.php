<?php
include "functions.php";
is_loggedin();
$erfolgt = false;
$errors = array();

// $sql_id = escape($_GET["id"]);
// Check if the formular was filled
if (!empty($_POST)) {

    $sql_titel = escape($_POST["titel"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_benutzer_id = escape($_POST["benutzer_id"]);

    if (empty($sql_titel)) {
        $errors[] = "Please enter a name for your recepie";
    }
    // If no errors save the ingredient in databanking
    if(empty($errors)) {
        query("UPDATE rezepte SET 
        titel = '{$sql_titel}',
        beschreibung = '{$sql_beschreibung}', 
        benutzer_id = '{$sql_benutzer_id}'
        WHERE id = '{$sql_id}'
        ");

        // Alle ZUtaten-Zuordnung löschen und neu anlegen
        query("DELETE FROM zutaten_zu_rezepte WHERE rezepte_id = '{$sql_id}'");

        $neue_rezept_id =  mysqli_insert_id($db);

        foreach ($_POST["zutaten_id"] as $zutatNr ) {
            // Zuordnung zu Zutaten anlagen
            $sql_ingredients_id = escape($zutatNr);

            if (empty($zutatNr)) continue;
    
            query("INSERT INTO zutaten_zu_rezepte SET
                    zutaten_id = '{$sql_ingredients_id}',
                    rezepte_id = '{$neue_rezept_id}'
                    ");
            $erfolgt = true;

        }

    }
}

// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";



include "head.php";
?>
    <h1>Change Recepie</h1>
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
        echo "Recepie Added!";
        echo "<br>";
        echo "<a href='recepies_list.php'><ul>
        <li style='font-size:1rem'>Back to List of Recepies</li>
        </ul></a>";
        echo "</h1>";
    }
    $sql_id = escape($_GET["id"]);
    $result = query("SELECT * FROM rezepte WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    ?>
    <form action="recepies_change.php?id=<?php echo $row["id"]?>" method="post">
        <div>
            <label for="benutzer_id">User</label>
            <select name="benutzer_id" id="benutzer_id">
                <?php 
                    $result2 = query("SELECT id, benutzername FROM benutzer ORDER BY benutzername ASC");
                    while ($user = mysqli_fetch_assoc($result2)) {
                        echo "<option value='{$user["id"]}'";
                        // If $_POST has been send then if user input == id u are checking for then print selected
                        if ( !empty($_POST["benutzer_id"]) && !$erfolgt && $_POST["benutzer_id"] == $user["id"] ) {
                            echo " selected ";
                        } 
                        // If $_POST has NOT been send yet(first load of page) then print selected on the option where the row u check = used_id from logedin session
                        elseif (empty($_POST["benutzer_id"]) &&  $user["id"] == $_SESSION["benutzer_id"] ) {
                            echo " selected ";
                        }

                        echo ">{$user["benutzername"]}</option>";
                    }
                 ?>
            </select>
        <div>
        <div>
            <label for="titel">Recepie Name:</label>
            <input type="text" name="titel" id="titel" 
            <?php if (!empty($_POST["titel"]) && !$erfolgt) {
                echo htmlspecialchars($_POST["titel"]);
            } else {
                echo htmlspecialchars($row["titel"]);
            }
            ?> />
        </div>
        <div>
            <label for="beschreibung">Beschreibung</label>
            <textarea type="text" name="beschreibung" id="beschreibung"><?php if (!empty($_POST["beschreibung"]) && !$erfolgt) echo htmlspecialchars($_POST["beschreibung"]);?></textarea>
        </div>
        <div class="ingredientslist">
            <?php 
            // Ermitteln, wieviele Zutaten-blöcke wir benotigen
            // (zum Vorausfüllen)
            $bloecke = 1;
            $result = query("SELECT * FROM zutaten_zu_rezepte WHERE rezepte_id = '{$sql_id}' ORDER BY id ASC");
            $bloecke = mysqli_num_rows($result);
            $zutaten_zuordnung = array();
            while ($zuordnung = mysqli_fetch_assoc($result)) {
                $zutaten_zuordnung[] = $zuordnung;
            }
            if($bloecke < 1 ) $bloecke = 1;
            for ($i=0; $i < $bloecke ; $i++) { 
            ?>
            <div class="ingredientsblock">
                <div>
                    <label for="zutaten_id">Ingredient:</label>
                    <select name="zutaten_id[]" id="zutaten_id">
                        <?php 
                        $ingredients_result = query("SELECT * FROM zutaten ORDER BY titel ASC");
                        while ($ingredient = mysqli_fetch_assoc($ingredients_result)) {
                            echo "<option value='{$ingredient["id"]}'";
                            if ( (empty($_POST["zutaten_id"]) || $erfolgt)  && !empty($zutaten_zuordnung[$i])
                            && $zutaten_zuordnung[$i]["zutaten_id"] == $ingredient["id"])  {
                                echo " selected";
                            }
                            echo ">{$ingredient["titel"]}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            } 
            ?>
        </div>
        <!-- <a class="ingredient-new" href="#" onclick="newIngredient()" >New ingredient</a> -->
        <button class="ingredient-new2">New ingredient</button>
        <div>
            <button type="submit">Change recepie</button>
        </div>
    </form>
<?php 

include "footer.php";
?>
