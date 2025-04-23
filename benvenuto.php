<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Benvenuto</title>
</head>
<body>
    

    <?php
        echo "<h1>Benvenuto " . $_SESSION["utente"] . " </h1>";

        $sql2 = "SELECT * FROM utente WHERE username = '" . $_SESSION["utente"] . "';";
;
        $ris2 = $conn->query($sql2);

        if ($ris2->num_rows >0){
            foreach($ris2 as $utente){
                echo "<ul>";
                echo "<li>ID = " . $utente['id'] . "</li>";
                echo "<li>Username = " . $utente['username'] . "</li>";
                echo "<li>Nome = " . $utente['nome'] . "</li>";
                echo "<li>Cognome = " . $utente['cognome'] . "</li>";
                echo "<li>E-mail = " . $utente['email'] . "</li>";
                echo "<li>Data Registrazione = " . $utente['dataregistrazione'] . "</li>";
                echo "</ul>";

                $id = $utente['id'];
            }
            
        }

    

        echo "<p>" . $id . "</p>";

        $numRec = "SELECT COUNT(*) AS tot FROM recensione LEFT JOIN utente ON recensione.idutente = utente.id WHERE recensione. idutente = " . $id . ";";


        $n = $conn->query($numRec);

        $row = $n->fetch_assoc();
        if ($row['tot']>0){
        echo "<h3>Numero recensioni effettuate: " . $row['tot'] . "</h3>";
        echo "<br>";
        $info = "SELECT ristorante.nome, ristorante.indirizzo, recensione.voto, recensione.data  FROM ristorante LEFT JOIN recensione ON ristorante.codice = recensione.codiceristorante WHERE recensione.idutente =  " . $id . ";";
       
        $res = $conn->query($info);


        if ($res->num_rows > 0) {
        echo "<table class='table'>
  <thead>
    <tr>
      <th scope='col'>Nome Ristorante</th>
      <th scope='col'>Indirizzo</th>
      <th scope='col'>Voto</th>
      <th scope='col'>Data</th>
    </tr>
  </thead>
  <tbody>";

  while ($row = $res->fetch_assoc()) {
    echo "<tr>
      <td>" . $row['nome'] . "</td>
      <td>" . $row['indirizzo'] . "</td>
      <td>" . $row['voto'] . "</td>
      <td>" . $row['data'] . "</td>
    </tr>";
  }
  echo "</tbody>
</table>";

        
        }


        }else{
        echo "<h3>Nessuna recensione effettuata</h3>";
        }

 ?>

 <form action="inseriscirecensione.php" method="post">
 <?php

echo "<h1>DICCI LA TUA... </h1>";
echo "<br>";
 echo "<select name='nomi'>";
 $nomi = "SELECT ristorante.nome FROM ristorante";
 $q = $conn->query($nomi);
    if ($q->num_rows >0){
        $id = 0;
     foreach($q as $o){
        echo "<option value ='id" . $id . "'>" . $o['nome'] . "</option>;";
     }

     echo "</select>";

    }

    ?>
<br>
<br>
<label>Voto:</label><br>

<input type="radio" id="voto1" name="voto" value="1">
<label for="voto1">1</label>

<input type="radio" id="voto2" name="voto" value="2">
<label for="voto2">2</label>

<input type="radio" id="voto3" name="voto" value="3">
<label for="voto3">3</label>

<input type="radio" id="voto4" name="voto" value="4">
<label for="voto4">4</label>

<input type="radio" id="voto5" name="voto" value="5">
<label for="voto5">5</label>
<br>
<br>
<input type="submit">
</form>


<?php
echo "<br><br>";
 echo "<a href='scriptlogout.php' >Log-out</a>";
 ?>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>