<?php
include "funktionen.php";
include "kopf.php";

$result2 = query("SELECT * FROM passagiere ORDER BY first_name ASC");
?>
<h1>Book a Flight</h1>
<?php
echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Fear of Flights</th>";
            echo "<th>Sellect Flight by ID</th>";
            echo "<th>Remove Passager</th>";
            echo "<th>Change Data</th>";

        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result2)) {
            if ($row["fear_of_flights"] == 0) {
                $fear_of_flight = "No";
            } elseif ($row["fear_of_flights"] == 1) {
                $fear_of_flight = "Yes";
            }
            $result3 = query("SELECT * FROM fluege");
            
            echo "<tr>";
                echo "<td>". $row["first_name"] ."</td>";
                echo "<td>". $row["last_name"] ."</td>";
                echo "<td>". $row["date_of_birth"] ."</td>";
                echo "<td>". $fear_of_flight ."</td>";
                echo "<td>";
                while ($row3 = mysqli_fetch_assoc($result3)) {
                    $date = date("Y-m-d H:m:s");
                    if ($row3["ankunft"] >= $date) {
                        echo '<a href="passager_booked_flight.php?user_id=' . $row["id"] . '&id='. $row3["id"] . '"> ' . $row3["id"] . ' </a>';
                    }
                }
                echo "</td>";
                echo "<td>". '<a href="delete_passager.php?id='. $row["id"] . '">Remove</a>' ."</td>";
                echo "<td>". '<a href="change_passager.php?id='. $row["id"] . '">Change</a>' ."</td>";
                
            echo "<tr>";
        }
    echo "</tbody>";
echo "</table>";
echo "<br>";
?>
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