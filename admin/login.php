<?php

include "functions.php";

// print_r($_POST);
if (!empty($_POST)) {
    if(empty($_POST["benutzername"]) || empty($_POST["passwort"])){
        $error = "Benutzername oder Passwort ist leer";
    } else {
        //
        // $sql_benutzername = mysqli_real_escape_string($db, $_POST["benutzername"]);
        $sql_benutzername = escape($_POST["benutzername"]);

        // Get all usernames
        // $result = mysqli_query($db, "SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
        $result = query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");


        // print_r($result);
        // Make a associative array from $results
        $row = mysqli_fetch_assoc($result);
        // print_r($row);
        if ($row) {
            // User exists -> check password.
            if(password_verify($_POST["passwort"], $row["passwort"])) {
                // echo "ist eingeloggt";
                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];
                $_SESSION["benutzer_id"] = $row["id"];
                
                // Anzahl Logins in DB speichern
                // query is mz own function!
                query("UPDATE benutzer SET anzahl_login = anzahl_login + 1, last_login = NOW() WHERE id = {$row["id"]}");
                // mysqli_query($db, "UPDATE benutzer SET anzahl_login = anzahl_login + 1, last_login = NOW() WHERE id = {$row["id"]}");
                // mysqli_query($db, "UPDATE benutzer SET last_login = NOW() WHERE id = {$row["id"]}");

                // Go to main Page
                header("Location: index.php");
                exit;

            } else {
                // Wrong Password
                $error = "Username or Password is false";
            }
        } else {
            // Username not found in Database
            $error = "Username or Password is false";
        }
    }
}
// print_r($_SESSION);

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>
<body style="font-family:system-ui;background:lightseagreen;color:white">
    <h1 style="text-align:center">Login</h1>

    <?php
    if (!empty($error)) {
        echo "<p>".$error."</p>";
    }
     ?>
    <form action="login.php" method="post">
        <div>
            <label for="benutzername">Username</label>
            <input type="text" name="benutzername" id="benutzername">
        </div>
        <div>
            <label for="passwort">Password</label>
            <input type="password" name="passwort" id="passwort">
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php
include "footer.php";
?>