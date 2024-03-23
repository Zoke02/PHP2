<?php
include "funktionen.php";
include "kopf.php";
$errors = array();
$erfolg = false;


if (!empty($_POST)) {
    $sql_first_name = escape($_POST["first_name"]);
    $sql_last_name = escape($_POST["last_name"]);
    $sql_date_of_birth = escape($_POST["date_of_birth"]);
    // $sql_fluege_id = $row["id"];
    if(count($_POST) <= 3 ) {
        $sql_fear_of_flights = 0;
    } else {
        $sql_fear_of_flights = 1;
    }



    if (empty($sql_first_name) || empty($sql_last_name)) {
        $errors[] = "Please enter a First and Last name.";
    }

    if (empty($errors)) {
        query("INSERT INTO passagiere SET
        first_name = '{$sql_first_name}',
        last_name = '{$sql_last_name}',
        date_of_birth = '{$sql_date_of_birth}',
        fear_of_flights = {$sql_fear_of_flights}
        ");

        // if ($_POST["fear_of_flights"]) {
        //     query("INSERT INTO passagiere SET
        //         fear_of_flights = 1
        //     ");
        // }

        $erfolg = true;
    }

}

?>

<?php
if(!empty($errors)) {
    echo "<ul>";
    foreach ($errors as $key => $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
}
if ( $erfolg) {
    echo "<p>Passager inserted into database.<br>
    <a href='booking.php'>Back to booking</a>
    </p>";
} else {

?>
<h1>Booking Passager</h1>
<form action="booking.php" method="post">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php 
                if ( !empty($_POST["first_name"])) {
                    echo htmlspecialchars($_POST["first_name"]);
                }
            ?>"/>
        </div>
        <div>
            <label for="last_name">First Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php 
                if ( !empty($_POST["last_name"])) {
                    echo htmlspecialchars($_POST["last_name"]);
                }
            ?>"/>
        </div>
        <div>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth"/>
        </div>
        <div>
            <label for="fear_of_flights">Fear of Flights:</label>
            <input type="checkbox" name="fear_of_flights" id="fear_of_flights"/>
        </div>
        <!-- <h1>Available Flights</h1>



        <div class='row font-weight-bold border-bottom text-center'>
        <div class='col-2'>Flugnummer</div>
        <div class='col-3'>Abflug</div>
        <div class='col-3'>Ankunft</div>
        <div class='col-2'>Startflughafen</div>
        <div class='col-2'>Zielflughafen</div>
        <div class='col-2'>Book</div>
        </div> -->

        <?php
        // $result = query("SELECT * FROM fluege ORDER BY abflug ASC");
        // $date = date("Y-m-d H:m:s");
        // // echo $date;

        // while ($row = mysqli_fetch_assoc($result)){
        //     if ( $row["ankunft"] >= $date) {
        //     echo "<div class='row text-center'>";
        //     echo "<div class='col-2'>". $row["flugnr"] ."</div>";
        //     echo "<div class='col-3'>". $row["abflug"] ."</div>";
        //     echo "<div class='col-3'>". $row["ankunft"] ."</div>";
        //     echo "<div class='col-2'>". $row["start_flgh"] ."</div>";
        //     echo "<div class='col-2'>". $row["ziel_flgh"] ."</div>";
        //     // echo "<div class='col-2'>". '<input type="checkbox" name="fluege_id'. $row["id"] . '" id="fluege_id">' ."</div>";
        //     echo"</div>";
        //     }
        // }
        ?>
    
        <div>
            <button type="submit">Submit Passager</button>
        </div>
    </form>



<?php
}
print_r($_POST);
include "fuss.php";
?>