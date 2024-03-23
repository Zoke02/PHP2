<?php
include "funktionen.php";
include "kopf.php";
$result2 = query("SELECT * FROM passagiere ORDER BY first_name ASC");
?>
<h1>List of Passagers</h1>
<?php
echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Fear of Flights</th>";
            echo "<th>Flight ID</th>";
            echo "<th>Departure Time</th>";
            echo "<th>Arrival</th>";
            echo "<th>Departure Place</th>";
            echo "<th>Destination</th>";

        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result2)) {
            if ($row["fear_of_flights"] == 0) {
                $fear_of_flight = "No";
            } elseif ($row["fear_of_flights"] == 1) {
                $fear_of_flight = "Yes";
            }
            // $result3 = query("SELECT * FROM fluege");
            // $row3= mysqli_fetch_assoc($result3);
            
            echo "<tr>";
                echo "<td>". $row["first_name"] ."</td>";
                echo "<td>". $row["last_name"] ."</td>";
                echo "<td>". $row["date_of_birth"] ."</td>";
                echo "<td>". $fear_of_flight ."</td>";
                echo "<td>". $row["fluege_id"] ."</td>";
                $result3 = query("SELECT * FROM fluege WHERE id = '{$row["fluege_id"]}'");
                $row3= mysqli_fetch_assoc($result3);
                if ($row3["id"] = $row["fluege_id"]) {
                    echo "<td>". $row3["abflug"] ."</td>";
                    echo "<td>". $row3["ankunft"] ."</td>";
                    echo "<td>". $row3["start_flgh"] ."</td>";
                    echo "<td>". $row3["ziel_flgh"] ."</td>";
                }
            echo "<tr>";
        }
    echo "</tbody>";
echo "</table>";
echo "<br>";
?>
<?php
include "fuss.php";
?>