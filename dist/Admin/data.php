<?php
header('Content-Type: application/json');
require_once "../libs/database.php";

$sqlQuery = "SELECT * FROM merit INNER JOIN attendance ON attendance.meritID = merit.meritID ORDER BY merit.meritID";


$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

print_r($data);
exit();

echo json_encode($data);
?>