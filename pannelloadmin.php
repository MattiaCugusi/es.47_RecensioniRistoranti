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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="crossorigin=""/>
    <link rel="stylesheet" href="./css/stylesAdmin.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>
<body>
    <?php
      echo "<h1> <a href='scriptlogout.php' ><i style='color: red'; class='bi bi-box-arrow-left'></i></a></h1>";
    
      

      $campi = "SHOW COLUMNS FROM ristorante";

      $righe = "SELECT ristorante.*, COUNT(recensione.id) AS numero_recensioni FROM ristorante LEFT JOIN recensione ON ristorante.codice = recensione.codiceristorante GROUP BY ristorante.codice;";

  



      $c = $conn->query($campi);
      $r = $conn->query($righe);
      if($c->num_rows > 0){
        if ($r->num_rows > 0){
        
      
        echo "<div style = 'width: 100%'>";
        echo "<table class='table' style='text-align: center' width:'50%'> <thead>";
       
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
            echo "<td>" . $riga['latitudine']. "</td>";
            echo "<td>" . $riga['longitudine']. "</td>";
            echo "<td>" . $riga['numero_recensioni']. "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        echo "<br>
       <div class='form-container'  style = 'width: 70%'; text-align: center>>
    <form action='inserisciristorante.php' method='post'>
        <h1>Inserisci nuovo ristorante</h1>
        
        <label>Nome Ristorante:</label>
        <input type='text' name='nome' required>
        
        <label>Indirizzo:</label>
        <input type='text' name='indirizzo' required>
        
        <label>Città:</label>
        <input type='text' name='citta' required>
        
        <label>Latitudine:</label>
        <input type='text' name='latitudine' value='43.7800127'>
        
        <label>Longitudine:</label>
        <input type='text' name='longitudine' value='11.1997685'>
        
        <button type='submit'>Aggiungi</button>
    </form>
</div>";


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