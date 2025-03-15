<?php

$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestionareSaliFitnessDB";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificare conexiune
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
// Fetch data from the database
$sql = "SELECT * FROM tblclienti"; // Replace your_table with your actual table name
$result = $conn->query($sql);

// Start HTML output
echo "<html><body>";

// Display table
echo "<table border='1'>";
echo "tblClienti";
echo "<tr><th>idClient</th><th>numeClient</th><th>prenumeClient</th><th>telefonClient</th><th>scopClient</th><th>codAbonament</th><th>dataCumparareAbonament</th></tr>";

// Loop through fetched data and apply conditional row coloring based on date

while ($row = $result->fetch_assoc()) {
    // Convert the date from the table to a PHP DateTime object
    $currentDate = new DateTime();
    $tableDate = new DateTime($row['dataCumparareAbonament']); // Assuming 'dataCumparareAbonament' is the column name containing the date
    
    // Get the current date as a PHP DateTime object
    $interval = $currentDate->diff($tableDate);
    $daysDifference = $interval->days;

    // Compare the dates
    
    $tipabon = $row['codAbonament'];
    if ($tipabon ==1 ) {$rowColor = ($daysDifference <= 1) ? 'green' : 'red';}
    elseif ($tipabon ==2 ) {$rowColor = ($daysDifference <= 30) ? 'green' : 'red';}
   elseif ($tipabon == 3 ) {$rowColor = ($daysDifference <= 365) ? 'green' : 'red';}
    // Output table row with conditional coloring
    echo "<tr>";
    echo "<td>" . $row['idClient'] . "</td>";
    echo "<td>" . $row['numeClient'] . "</td>";
    echo "<td>" . $row['prenumeClient'] . "</td>";
    echo "<td>" . $row['telefonClient'] . "</td>";
    echo "<td>" . $row['scopClient'] . "</td>";
    echo "<td>" . $row['codAbonament'] . "</td>";
    echo "<td style='color: $rowColor;'>" . $row['dataCumparareAbonament'] . "</td>"; // Apply color based on the date comparison
    echo "</tr>";
}

// Close table and HTML
echo "</table>";
echo "</body></html>";
$conn->close();










        ?>