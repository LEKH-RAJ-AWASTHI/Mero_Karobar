<?php
include("../config/connection.inc.php");

$sql = "SELECT client_id, name, phone_number, pan_number FROM client";
$result = mysqli_query($con, $sql);
$output = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row; // Append each row to the $output array
    }
} else {
    $output['empty'] = ['empty'];
}

mysqli_close($con);

echo json_encode($output);
?>