<?php
include "functions.php";
is_loggedin();
$errors = array();

// Check if the formular was filled
if (!empty($_POST)) {

    $sql_titel = escape($_POST["titel"]);

    if (empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        $result = mysqli_query($db, "SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $errors[] = "Zutat is on in list";
        }
    }
    if (empty($_POST["kcal_pro_100"])) {
        $errors[] = "Bitte geben Sie einen KCal/100 für die Zutat an.";
    }
    if (empty($_POST["menge"])) {
        $errors[] = "Bitte geben Sie menge für die Zutat an.";
    }
    if (empty($_POST["einheit"])) {
        $errors[] = "Bitte geben Sie Einheit für die Zutat an.";
    }
}


include "head.php";
?>
    <h1>Neue ingredients</h1>
    <?php 
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $key => $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
    }
    ?>
    <form action="ingredients_new.php" method="post">
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