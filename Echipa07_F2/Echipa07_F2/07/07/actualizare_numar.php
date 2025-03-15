<?php
// Configurarea conexiunii la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestionareSaliFitnessDB";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

// Interogarea numărului de clienți
$sql_clienti = "SELECT COUNT(*) AS numarClienti FROM tblClienti";
$result_clienti = $conn->query($sql_clienti);
$numarClienti = $result_clienti->fetch_assoc()['numarClienti'];

// Interogarea numărului de angajați
$sql_angajati = "SELECT COUNT(*) AS numarAngajati FROM tblAngajati";
$result_angajati = $conn->query($sql_angajati);
$numarAngajati = $result_angajati->fetch_assoc()['numarAngajati'];

echo json_encode(array("numarClienti" => $numarClienti, "numarAngajati" => $numarAngajati));

$conn->close();
?>
