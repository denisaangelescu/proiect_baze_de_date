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

// Inițializare mesaj pentru rezultat
$message = '';

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
    $message = 'Client updated';
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
    $message = 'Client added';
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Operation</title>
    <style>
        .checkmark {
            width: 100px;
            height: 100px;
            display: block;
            margin: 20px auto;
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1200px-Flat_tick_icon.svg.png') no-repeat center center;
            background-size: contain;
        }
    </style>
</head>
<body>
    <div class="checkmark"></div>
    <p style="text-align: center;"><?php echo $message; ?></p>
</body>
</html>
