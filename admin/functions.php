<?php
// Necessary to have access to the $_SESSION.
session_start();

// Connection to a DATA-BANK
$db = mysqli_connect("localhost", "root", "", "php2");
// Tell MySQL that our commands come as UTF8
mysqli_set_charset($db, "utf8");

// Functions

