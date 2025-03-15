<?php
// Conexiunea la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestionareSaliFitnessDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preia datele din formular
$numeClient = $_POST['nume'];
$prenumeClient = $_POST['prenume'];
$telefonClient = $_POST['telefon'];
$scopClient = $_POST['scop'];
$codAbonament = (int)$_POST['cod_abonament'];
$dataCumparareAbonament = date('Y-m-d');

$sql = "SELECT idClient FROM tblClienti WHERE telefonClient = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $telefonClient);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Clientul există, actualizează atributele
    $update_sql = "UPDATE tblClienti SET numeClient = ?, prenumeClient = ?, scopClient = ?, codAbonament = ? WHERE telefonClient = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $numeClient, $prenumeClient, $scopClient, $codAbonament, $telefonClient);
    $update_stmt->execute();
    $message = 'Client updated successfully';
} else {
    // Clientul nu există, obține cel mai mare idClient existent
    $max_id_sql = "SELECT MAX(idClient) AS max_id FROM tblClienti";
    $max_id_result = $conn->query($max_id_sql);
    $max_id_row = $max_id_result->fetch_assoc();
    $next_idClient = $max_id_row['max_id'] + 1;

    // Adaugă un nou client
    $insert_sql = "INSERT INTO tblClienti (idClient, numeClient, prenumeClient, telefonClient, scopClient, codAbonament, dataCumparareAbonament) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("issssis", $next_idClient, $numeClient, $prenumeClient, $telefonClient, $scopClient, $codAbonament, $dataCumparareAbonament);
    $insert_stmt->execute();
    $message = 'Client added successfully';
}

$stmt->close();
$conn->close();

// Redirecționează către pagina de rezultat
header("Location: display_result.php?message=" . urlencode($message));
exit();
?>
