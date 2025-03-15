<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestionareSaliFitnessDB";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Selectarea datelor din tabelă
$sql = "SELECT idAbonament, descriereAbonament, pretAbonament FROM tblTiparAbonamente";
$result = $conn->query($sql);

// Stocarea datelor într-un array
$abonamente = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $abonamente[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

// Convertirea array-ului în format JSON
echo json_encode($abonamente);
?>
