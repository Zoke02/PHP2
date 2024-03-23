<?php
include "funktionen.php";
include "kopf.php";
$sql_id = escape($_GET["id"]);

if (!empty($_POST) ) {
    $sql_first_name = escape($_POST["first_name"]);
    $sql_last_name = escape($_POST["last_name"]);
    $sql_date_of_birth = escape($_POST["date_of_birth"]);
    if (empty($_POST["fear_of_flights"])) {
        $sql_fear_of_flights = 0;
    } else {
        $sql_fear_of_flights = 1;
    }
    $sql_fluege_id = escape($_POST["fluege_id"]);
    query("UPDATE passagiere SET 
            first_name = '{$sql_first_name}', 
            last_name = '{$sql_last_name}', 
            date_of_birth = '{$sql_date_of_birth }', 
            fear_of_flights = '{$sql_fear_of_flights}',
            fluege_id =  '{$sql_fluege_id}'
            WHERE id = '{$sql_id}'
        ");
}
?>
<h1>All fields MUST be filled (*Fear of Flights optional)</h1>
<form action="change_passager.php?id=<?php echo $sql_id;?> " method="post">
    <div>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name"/>
    </div>
    <div>
        <label for="last_name">First Name:</label>
        <input type="text" name="last_name" id="last_name"/>
    </div>
    <div>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth"/>
    </div>
    <div>
        <label for="fear_of_flights">Fear of Flights:</label>
        <input type="checkbox" name="fear_of_flights" id="fear_of_flights"/>
    </div>
    <div>
        <label for="fluege_id">Flight ID:</label>
        <input type="number" name="fluege_id" id="fluege_id"/>
    </div>
    <div>
        <button type="submit">Change Data</button>
    </div>
    </form>
    <h1>Available Flights</h1>

<div class='row font-weight-bold border-bottom text-center'>
<div class='col-2'>Flugnummer</div>
<div class='col-2'>Abflug</div>
<div class='col-2'>Ankunft</div>
<div class='col-2'>Startflughafen</div>
<div class='col-2'>Zielflughafen</div>
<div class='col-2'>Flight ID</div>
</div>
<a href=""></a>
<?php
$result = query("SELECT * FROM fluege ORDER BY abflug ASC");
$date = date("Y-m-d H:m:s");
// echo $date;

while ($row = mysqli_fetch_assoc($result)){
    if ( $row["ankunft"] >= $date) {
        echo "<div class='row text-center'>";
        echo "<div class='col-2'>". $row["flugnr"] ."</div>";
        echo "<div class='col-2'>". $row["abflug"] ."</div>";
        echo "<div class='col-2'>". $row["ankunft"] ."</div>";
        echo "<div class='col-2'>". $row["start_flgh"] ."</div>";
        echo "<div class='col-2'>". $row["ziel_flgh"] ."</div>";
        echo "<div class='col-2'>". $row["id"] ."</div>";
        echo"</div>";
    }
}
echo "<br>";

?>
<?php
include "fuss.php";
?>