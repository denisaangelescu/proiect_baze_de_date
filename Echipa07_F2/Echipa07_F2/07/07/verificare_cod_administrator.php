
<?php
$admin_code = "0000000000";  // Codul prestabilit al administratorului

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_code = $_POST['cod_administrator'];

    // Verifică dacă codul introdus este exact 0000000000
    if ($input_code === $admin_code) {
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

        // Adaugă butoanele de sortare în partea de sus a paginii
        echo "<form method='post' action='formularinserare.html' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<button type='submit'>Inserare în tblclientsalifitness</button>";
        echo "</form>";
        
        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by' value='salariu'>";
        echo "<button type='submit'>Sort by salariuAngajat</button>";
        echo "</form>";

        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by' value='nume'>";
        echo "<button type='submit'>Sort by numeAngajat</button>";
        echo "</form>";

        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by' value='id'>";
        echo "<button type='submit'>Sort by idAngajat</button>";
        echo "</form>";

        // Adaugă butoanele de sortare pentru tblClienti
        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by_client' value='nume'>";
        echo "<button type='submit'>Sort by numeClient</button>";
        echo "</form>";

        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by_client' value='id'>";
        echo "<button type='submit'>Sort by idClient</button>";
        echo "</form>";

        echo "<form method='post' action='' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='hidden' name='sort_by_client' value='dataCumparareAbonament'>";
        echo "<button type='submit'>Sort by dataCumparareAbonament</button>";
        echo "</form>";

        // Adaugă butonul Abonament Activ/Inactiv
        echo "<form method='post' action='verderosu.php' style='display:inline-block; margin-bottom: 20px;'>";
        echo "<button type='submit'>Abonament Activ/Inactiv</button>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "</form>";
        // Adaugă bara de căutare pentru tblClienti
        echo "<form method='post' action='' style='margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='text' name='telefon_client' placeholder='Caută după telefonClient'>";
        echo "<button type='submit' name='search_client'>Caută</button>";
        echo "</form>";

        // Adaugă bara de căutare pentru tblAngajati
        echo "<form method='post' action='' style='margin-bottom: 20px;'>";
        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
        echo "<input type='text' name='telefon_angajat' placeholder='Caută după telefonAngajat'>";
        echo "<button type='submit' name='search_angajat'>Caută</button>";
        echo "</form>";

        if (isset($_POST['update'])) {
            // Actualizează datele
            $table_name = $_POST['table_name'];
            $columns = $_POST['columns'];
            $values = $_POST['values'];
            $conditions = $_POST['conditions'];

            $set_clause = [];
            foreach ($columns as $key => $column) {
                $value = $conn->real_escape_string($values[$key]);
                $set_clause[] = "$column='$value'";
            }

            $where_clause = [];
            foreach ($conditions as $key => $condition) {
                $where_clause[] = "$key='$condition'";
            }

            $sql_update = "UPDATE $table_name SET " . implode(", ", $set_clause) . " WHERE " . implode(" AND ", $where_clause);

            if ($conn->query($sql_update) === TRUE) {
                echo "Înregistrarea a fost actualizată cu succes.";
            } else {
                echo "Eroare la actualizarea înregistrării: " . $conn->error;
            }
        }

        if (isset($_POST['delete'])) {
            // Șterge datele
            $table_name = $_POST['table_name'];
            $conditions = $_POST['conditions'];

            $where_clause = [];
            foreach ($conditions as $key => $condition) {
                $where_clause[] = "$key='$condition'";
            }

            $sql_delete = "DELETE FROM $table_name WHERE " . implode(" AND ", $where_clause);

            if ($conn->query($sql_delete) === TRUE) {
                echo "Înregistrarea a fost ștearsă cu succes.";

                // Realocă ID-urile
                $realocate_sql = "SET @new_id = 0; UPDATE $table_name SET idClient = (@new_id := @new_id + 1) ORDER BY idClient;";
                // Utilizează multi_query și consumă toate rezultatele
                if ($conn->multi_query($realocate_sql)) {
                    do {
                        // Stai în buclă până când se consumă toate rezultatele
                    } while ($conn->next_result());
                } else {
                    echo "Eroare la realocarea ID-urilor: " . $conn->error;
                }
            } else {
                echo "Eroare la ștergerea înregistrării: " . $conn->error;
            }
        }

        // Obține lista de tabele
        $sql = "SHOW TABLES FROM $dbname";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $table_name = $row[0];
                echo "<h2>$table_name</h2>";

                // Verifică dacă sortarea este solicitată pentru tblAngajat
                if (isset($_POST['sort_by']) && $table_name == 'tblangajati') {
                    if ($_POST['sort_by'] == 'salariu') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY salariuAngajat ASC";
                    } elseif ($_POST['sort_by'] == 'nume') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY numeAngajat ASC";
                    } elseif ($_POST['sort_by'] == 'id') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY idAngajat ASC";
                    }
                }
                // Verifică dacă sortarea sau căutarea este solicitată pentru tblClienti
                elseif (isset($_POST['sort_by_client']) && $table_name == 'tblclienti') {
                    if ($_POST['sort_by_client'] == 'nume') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY numeClient ASC";
                    } elseif ($_POST['sort_by_client'] == 'id') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY idClient ASC";
                    } elseif ($_POST['sort_by_client'] == 'dataCumparareAbonament') {
                        $table_sql = "SELECT * FROM $table_name ORDER BY dataCumparareAbonament ASC";
                    }
                } elseif (isset($_POST['search_client']) && $table_name == 'tblclienti') {
                    $telefon_client = $conn->real_escape_string($_POST['telefon_client']);
                    $table_sql = "SELECT * FROM $table_name WHERE telefonClient = '$telefon_client'";
                } elseif (isset($_POST['search_angajat']) && $table_name == 'tblangajati') {
                    $telefon_angajat = $conn->real_escape_string($_POST['telefon_angajat']);
                    $table_sql = "SELECT * FROM $table_name WHERE telefonAngajat = '$telefon_angajat'";
                } else {
                    $table_sql = "SELECT * FROM $table_name";
                }

                $table_result = $conn->query($table_sql);

                if ($table_result->num_rows > 0) {
                    // Afișează antetele tabelului
                    echo "<table border='1'>";
                    echo "<tr>";
                    $columns = [];
                    while ($field = $table_result->fetch_field()) {
                        $columns[] = $field->name;
                        echo "<th>" . $field->name . "</th>";
                    }
                    echo "<th>Acțiuni</th>";
                    echo "</tr>";

                    // Afișează datele tabelului
                    while ($table_row = $table_result->fetch_assoc()) {
                        echo "<tr>";
                       
    
                        foreach ($table_row as $key => $cell) {
                            echo "<td>" . $cell . "</td>";
                        }
                        echo "<td>";
                        echo "<form method='post' action='' style='display:inline-block;'>";
                        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
                        echo "<input type='hidden' name='table_name' value='$table_name'>";
                        foreach ($columns as $key => $column) {
                            echo "<input type='hidden' name='columns[]' value='$column'>";
                            echo "<input type='hidden' name='values[]' value='" . $table_row[$column] . "'>";
                            echo "<input type='hidden' name='conditions[$column]' value='" . $table_row[$column] . "'>";
                        }
                        echo "<button type='submit' name='edit'>Editează</button>";
                        echo "</form>";

                        echo "<form method='post' action='' style='display:inline-block;' onsubmit='return confirm(\"Ești sigur că vrei să ștergi această înregistrare?\");'>";
                        echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
                        echo "<input type='hidden' name='table_name' value='$table_name'>";
                        foreach ($columns as $key => $column) {
                            echo "<input type='hidden' name='conditions[$column]' value='" . $table_row[$column] . "'>";
                        }
                        echo "<button type='submit' name='delete'>Șterge</button>";
                        echo "</form>";

                        echo "</td>";
                        echo "</tr>";

                        // Afișează formularul de editare pentru rândul selectat
                        if (isset($_POST['edit']) && $_POST['table_name'] == $table_name && $table_row[$columns[0]] == $_POST['conditions'][$columns[0]]) {
                            echo "<tr>";
                            echo "<td colspan='" . (count($columns) + 1) . "'>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='cod_administrator' value='$admin_code'>";
                            echo "<input type='hidden' name='table_name' value='$table_name'>";
                            foreach ($columns as $key => $column) {
                                $value = $table_row[$column];
                                $condition = $_POST['conditions'][$column];
                                echo "<div>";
                                echo "<label for='$column'>$column:</label>";
                                echo "<input type='text' name='values[]' value='$value'>";
                                echo "<input type='hidden' name='columns[]' value='$column'>";
                                echo "<input type='hidden' name='conditions[$column]' value='$condition'>";
                                echo "</div>";
                            }
                            echo "<button type='submit' name='update'>Actualizează</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                  
                    echo "</table>";
                } else {
                    echo "Nu există date în tabelul $table_name.";
                }
            }
        } else {
            echo "Nu există tabele în baza de date.";
        }
       
        $conn->close();
    } else {
        echo "<h1>Codul de administrator este incorect.</h1>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>

