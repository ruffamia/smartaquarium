<?php
require 'database.php';

$sql = "SELECT * FROM data_sensor";
$result = $db->query($sql);
if (!$result) {
  { echo "Error: " . $sql . "<br>" . $db->error; }
}

$row = $result->fetch_assoc();

//$rows = $result -> fetch_all(MYSQLI_ASSOC);
//print_r($row);

//header('Content-Type: application/json');
 
//$table=array(0=>array('Label','Value'),1=>array('Temperature',$row));


echo json_encode($row);


?>