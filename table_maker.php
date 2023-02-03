<?php
require_once 'php/connection.php';

// Check connection
if (!$connection) {
   die("Connection failed: " . mysqli_connect_error());
}
// Select query
if (isset($_GET['availability_date'])){
    $select_query = "SELECT * 
                    FROM tijden 
                    WHERE datum='".$_GET['availability_date']."'";
}
else {
    $select_query = "SELECT * 
                    FROM tijden 
                    ORDER BY tijden.tijd ASC";
}
$result = mysqli_query($connection, $select_query);

echo('<script>alert("Test")</script>');

$sql_skiliftseats = "SELECT max_personen FROM Skiliften WHERE naam = '".$_GET['skilift']."'";
$seats_result = $connection->query($sql_skiliftseats);
$seats_row = $seats_result->fetch_assoc();
$seats = $seats_row['max_personen'];


$basic_array1 = array("10:00" => $seats, "10:15" => $seats, "10:30" => $seats, "10:45" => $seats, "11:00" => $seats, "11:15" => $seats, "11:30" => $seats, "11:45" => $seats, "12:00" => $seats, "12:15" => $seats);
$basic_array2 = array("12:30" => $seats, "12:45" => $seats, "13:00" => $seats, "13:15" => $seats, "13:30" => $seats, "13:45" => $seats, "14:00" => $seats, "14:15" => $seats, "14:30" => $seats, "14:45" => $seats, );
$basic_array3 = array("15:00" => $seats, "15:15" => $seats, "15:30" => $seats, "15:45" => $seats, "16:00" => $seats, "16:15" => $seats, "16:30" => $seats, "16:45" => $seats, "17:00" => $seats);

function insert_availability($basic_array, $data){
    while ($row = mysqli_fetch_assoc($data)) {
        if (array_key_exists(date("H:i", strtotime($row['tijd'])), $basic_array)) {
            $basic_array[date("H:i", strtotime($row['tijd']))] = $row['beschikbare_plekken'];
        }
    }
    return $basic_array;
}

$basic_array1 = insert_availability($basic_array1, $result);

if (isset($_GET['availability_date'])) {
    echo "<table id='availability-table'>";
    echo "<tr><th>Time</th><th>Places</th></tr>";

    $counter = 0;
    // Loop through the result set
    foreach ($basic_array1 as $tijdslot => $beschikbare_plekken) {
    echo "<tr>";
    echo "<td>" . $tijdslot . "</td>";
    echo "<td>" . $beschikbare_plekken . "</td>";
    echo "</tr>";
    }

    echo "</table>";
}

$basic_array2 = insert_availability($basic_array2, $result);

if (isset($_GET['availability_date'])) {
    echo "<table id='availability-table'>";
    echo "<tr><th>Time</th><th>Places</th></tr>";

    $counter = 0;
    // Loop through the result set
    foreach ($basic_array2 as $tijdslot => $beschikbare_plekken) {
    echo "<tr>";
    echo "<td>" . $tijdslot . "</td>";
    echo "<td>" . $beschikbare_plekken . "</td>";
    echo "</tr>";
    }

    echo "</table>";
}

$basic_array3 = insert_availability($basic_array3, $result);

if (isset($_GET['availability_date'])) {
    echo "<table id='availability-table'>";
    echo "<tr><th>Time</th><th>Places</th></tr>";

    $counter = 0;
    // Loop through the result set
    foreach ($basic_array3 as $tijdslot => $beschikbare_plekken) {
    echo "<tr>";
    echo "<td>" . $tijdslot . "</td>";
    echo "<td>" . $beschikbare_plekken . "</td>";
    echo "</tr>";
    }

    echo "</table>";
}

?>
    <style>
      table, th, td {
        background-color: #382424;
        align-items: center;
        height: 100%;
        color: gainsboro;
        table-layout: fixed;
        float: left;
        width: 32%;
        margin-right: 1%;
      }
      th, td {
        padding: 5px;
        text-align: center;
        width: 49%;
        overflow: hidden;
        border: 1px solid #DA9F5B;
        border-collapse: collapse;
      }


    </style>