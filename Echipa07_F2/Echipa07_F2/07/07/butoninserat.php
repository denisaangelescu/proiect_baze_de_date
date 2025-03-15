<?php
$admin_code = "0000000000";  // Codul prestabilit al administratorului

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_code = $_POST['cod_administrator'];

    if ($input_code == $admin_code) {
        // Conectare la baza de date
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestionareSaliFitnessDB";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificare conexiune
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idClientSaliFitness = $_POST['idClientSaliFitness'];
            $codClient = $_POST['codClient'];
            $codSala = $_POST['codSala'];
            $dataIntrarii = $_POST['dataIntrarii'];

            // Verifică dacă există deja o înregistrare cu același idClientSaliFitness
            $check_sql = "SELECT COUNT(*) AS count FROM tblclientsalifitness WHERE idClientSaliFitness = '$idClientSaliFitness'";
            $check_result = $conn->query($check_sql);
            $row = $check_result->fetch_assoc();
            $existing_count = $row['count'];

            if ($existing_count > 0) {
                echo "Eroare: ID-ul clientului fitness introdus deja există în bază de date.";
            } else {
                // Interogare de inserare
                $sql = "INSERT INTO tblclientsalifitness (idClientSaliFitness, codClient, codSala, dataIntrarii) VALUES ('$idClientSaliFitness', '$codClient', '$codSala', '$dataIntrarii')";

                if ($conn->query($sql) === TRUE) {
                    echo "Înregistrare adăugată cu succes!";
                } else {
                    echo "Eroare: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }
    } else {
        echo "<h1>Codul de administrator este incorect.</h1>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
