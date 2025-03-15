<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestionareSaliFitnessDB";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Debugging: Check the received phone number
    // Uncomment the line below to print the received phone number for debugging
    // echo "Received phone number: " . htmlspecialchars($phone) . "<br>";

    $sql = "SELECT telefonClient FROM tblClienti WHERE telefonClient = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();

    // Debugging: Check the number of rows found
    // Uncomment the line below to print the number of rows for debugging
    // echo "Number of rows found: " . $stmt->num_rows . "<br>";

    if ($stmt->num_rows > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
