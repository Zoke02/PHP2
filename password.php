<?php
$password = "asdf";
$salt = "köakkäkk234";
$db_password = "81dc9bdb52d04dc20036dbd8313ed055";
$db_password_salt = "fdf14c0500a42c37ee6df5648c517548";

//

if ($db_password == md5($password)) {
    echo "Password is corect";
    echo "<br>";
};


echo "<br>";
echo $password;
echo "<br>";
echo md5($password);
echo "<br>";
echo md5($password.$salt);
echo "<br>";
$pw_hash = password_hash($password, PASSWORD_DEFAULT);
echo password_hash($password, PASSWORD_DEFAULT);
echo "<br>";

if (password_verify($password, $pw_hash)) {
echo "Password is corect";
}