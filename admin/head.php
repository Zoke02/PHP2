<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepies-Admin</title>
    <style>
    </style>
</head>
<body style="font-family:system-ui;background:lightseagreen;color:white">
    <nav>
        <ul>
            <li style="font-weight:bold;font-size:2rem"><a style="text-decoration:none;color:white" href="index.php">Home</a></li>
            <li style="font-weight:bold;font-size:2rem"><a style="text-decoration:none;color:white" href="ingredients_list.php">Incredients</a></li>
            <li style="font-weight:bold;font-size:2rem"><a style="text-decoration:none;color:white" href="recepies_list.php">Recepies</a></li>
            <!-- <li style="font-weight:bold;font-size:2rem"><a style="text-decoration:none;color:white" href="ingredients_new.php">Add new ingredient</a></li> -->
            <li style="font-weight:bold;font-size:2rem"><a style="text-decoration:none;color:white" href="logout.php">Logout</a></li>
            <li>Logged as: <?php echo $_SESSION["benutzername"] ?></li>
        </ul>
    </nav>

