<?php
// Necessary to have access to the $_SESSION.
session_start();

// Connection to a DATA-BANK
$db = mysqli_connect("localhost", "root", "", "php2");
// Tell MySQL that our commands come as UTF8
mysqli_set_charset($db, "utf8");


// Funktion für mysql_query

function query($sql_befehl) {
    global $db;
    $result = mysqli_query($db, $sql_befehl);
    return $result;
}


// Functions

function escape($text) {
    global $db;
    return mysqli_real_escape_string($db, $text);
}

function is_loggedin(){
    if (empty($_SESSION["eingeloggt"])){
        header("Location: login.php");
        exit; // So that the data does not get resend to Browser.
    }
}