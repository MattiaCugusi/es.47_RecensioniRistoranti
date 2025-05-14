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
        
        echo "<table style='text-align: center'> <thead>";
       
        echo "<tr>";
        foreach($c as $colonne){
            echo "<th>" . $colonne["Field"] . "</th>";
        }
        echo "<th>Num recensioni</th>";
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
        echo "</table>";

        echo "<br>
        <form action='inserisciristorante.php' method='post'>
        <h1>Inserisci nuovo ristorante:</h1>
        <br>
        <label>Nome Ristorante:</label>
        <br>
        <input type='text' name='nome'>
        <br>
        <label>Indirizzo:</label>
        <br>
        <input type='text' name='indirizzo'>
        <br>
        <label>Citta':</label>
        <br>
        <input type='text' name='citta'>
        <br>
        <br>
        <button type='submit'>Aggiungi</button>
        </form>";

        if(isset($_SESSION["errore"])){
           echo "<p style = 'color: red; background-color: black; text-align: center'>" . $_SESSION["errore"] . "</p>"; 
          unset($_SESSION["errore"]);
        }

        if (isset($_SESSION["ok"])){
           echo "<p style = 'color: green; background-color: black; text-align: center'>" . $_SESSION["ok"] . "</p>"; 
           unset($_SESSION["ok"]);
}




      }
    }


    
    ?>

    


</body>
</html>