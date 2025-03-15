<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestionareSaliFitnessDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexiunea a esuat: " . $conn->connect_error);
    }

    // Preluarea datelor din formular
    $telefon = $_POST['telefon'];

    // Interogarea bazei de date
    $sql = "SELECT sf.numeSala, csf.dataIntrarii 
            FROM tblClienti c 
            JOIN tblClientSaliFitness csf ON c.idClient = csf.codClient 
            JOIN tblSaliFitness sf ON sf.idSala = csf.codSala 
            WHERE c.telefonClient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $telefon);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generarea și afișarea tabelului
    echo "<!DOCTYPE html>
          <html lang='ro'>
          <head>
              <meta charset='UTF-8'>
              <title>Istoric Client</title>
              <style>
                  body {
                      font-family: Arial, sans-serif;
                      background-color: #f8f9fa;
                      margin: 0;
                      padding: 20px;
                      display: flex;
                      justify-content: center;
                      align-items: center;
                      height: 100vh;
                  }

                  table {
                      width: 80%;
                      margin: 20px auto;
                      border-collapse: collapse;
                      text-align: left;
                  }

                  table, th, td {
                      border: 1px solid #ddd;
                  }

                  th, td {
                      padding: 12px;
                      text-align: center;
                  }

                  th {
                      background-color: #f8d7da; /* Rozaliu deschis */
                      color: black;
                  }

                  tr:nth-child(even) {
                      background-color: #fdeef1; /* Rozaliu */
                  }

                  tr:nth-child(odd) {
                      background-color: #fdeef1; /* Rozaliu */
                  }

                  tr:hover {
                      background-color: #f5c6cb; /* Rozaliu mai închis */
                  }
              </style>
          </head>
          <body>";

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Nume Sala</th>
                    <th>Data Intrarii</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["numeSala"] . "</td>
                    <td>" . $row["dataIntrarii"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>Nu s-au găsit înregistrări pentru numărul de telefon furnizat.</p>";
    }

    echo "</body>
          </html>";

    $stmt->close();
    $conn->close();
}
?>
