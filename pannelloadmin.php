<?php
include ('connessione.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello admin</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
      echo "<h1> <a href='scriptlogout.php' ><i style='color: red'; class='bi bi-box-arrow-left'></i></a></h1>";
    
      $campi = "SHOW COLUMNS FROM ristorante";

      $righe = "SELECT ristorante.*, COUNT(recensione.id) AS numero_recensioni FROM ristorante LEFT JOIN recensione ON ristorante.codice = recensione.codiceristorante GROUP BY ristorante.nome;";

      $c = $conn->query($campi);
      $r = $conn->query($righe);
      if($c->num_rows > 0){
        if ($r->num_rows > 0){
        
        echo "<table> <thead>";
       
        echo "<tr>";
        foreach($c as $colonne){
            echo "<th>" . $colonne["Field"] . "</th>";
        }
        echo "<tr>  </thead>";

        echo "<tbody>";
             foreach($r as $riga){
            echo "<tr>";
            echo "<td>" . $riga['codice']. "</td>";
            echo "<td>" . $riga['nome']. "</td>";
            echo "<td>" . $riga['indirizzo']. "</td>";
            echo "<td>" . $riga['citta']. "</td>";
            echo "<td>" . $riga['numero_recensioni']. "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
      }
    }


    
    ?>

    


</body>
</html>