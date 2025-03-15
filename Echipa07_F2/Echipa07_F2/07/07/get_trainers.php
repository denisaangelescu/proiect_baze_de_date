<?php
include 'db_connection.php';

$sql = "SELECT prenumeAngajat, numeAngajat FROM tblAngajati WHERE tipMeserie = 'Antrenor' LIMIT 4";
$result = $conn->query($sql);

$trainers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trainers[] = $row;
    }
}

$conn->close();

echo json_encode($trainers);
?>
