<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Ristorante</title>
</head>
<body>
    <?php
       $ristorante = $_POST["risto"];

       $sql = "SELECT recensione.* FROM recensione LEFT JOIN ristorante ON recensione.codiceristorante = ristorante.codice WHERE ristorante.nome = '" . $ristorante . "'";

       $selezione = $conn->query($sql);

       if($selezione->num_rows >0){
            echo "<table style='text-align: center'>";
             echo "<thead>";
                 echo "<tr>";
                   echo "<th>ID</th>";
                   echo "<th>Voto</th>";
                   echo "<th>Data_inserimento</th>";
                   echo "<th>Codice Utente</th>";
                   
                   echo "<tbody>";
             foreach($selezione as $riga){
            echo "<tr>";
            echo "<td>" . $riga['id']. "</td>";
            echo "<td>" . $riga['voto']. "</td>";
            echo "<td>" . $riga['data']. "</td>";
            echo "<td>" . $riga['idutente']. "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
       }



    ?>
</body>
</html>