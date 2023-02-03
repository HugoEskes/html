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

$basic_array1 = array("10:00" => 30, "10:15" => 30, "10:30" => 30, "10:45" => 30, "11:00" => 30, "11:15" => 30, "11:30" => 30, "11:45" => 30, "12:00" => 30, "12:15" => 30);
$basic_array2 = array("12:30" => 30, "12:45" => 30, "13:00" => 30, "13:15" => 30, "13:30" => 30, "13:45" => 30, "14:00" => 30, "14:15" => 30, "14:30" => 30, "14:45" => 30, );
$basic_array3 = array("15:00" => 30, "15:15" => 30, "15:30" => 30, "15:45" => 30, "16:00" => 30, "16:15" => 30, "16:30" => 30, "16:45" => 30, "17:00" => 30);

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
        border: 1px solid #DA9F5B;
        border-collapse: collapse;
        align-items: center;
        height: 100%;
        color: gainsboro;
        table-layout: fixed;
        float: left;
        width: 166px;
        margin-right: 1%;
      }
      th, td {
        padding: 5px;
        text-align: center;
        width: 82.9px;
        overflow: hidden;
      }


    </style>