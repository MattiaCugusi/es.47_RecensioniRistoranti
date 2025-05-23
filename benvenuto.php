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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    

    <?php

    if($_SESSION["utente"] == "admin"){
      header("Location: pannelloadmin.php");
      exit;
    }

            echo "<h1> <a href='scriptlogout.php' ><i style='color: red'; class='bi bi-box-arrow-left'></i></a></h1>";
        echo "<h1 style='text-align: center; color: red'>Benvenuto " . $_SESSION["utente"] . " </h1>";

        $sql2 = "SELECT * FROM utente WHERE username = '" . $_SESSION["utente"] . "';";
;
        $ris2 = $conn->query($sql2);

        if ($ris2->num_rows >0){
            foreach($ris2 as $utente){
                echo "<ul>";
                echo "<p><i class='bi bi-info-circle'></i> ID = " . $utente['id'] . "</p>";
                echo "<hr>";
                echo "<p><i class='bi bi-person-circle'></i> Username = " . $utente['username'] . "</p>";
                echo "<hr>";
                echo "<p><i class='bi bi-pencil-square'></i> Nome = " . $utente['nome'] . "</p>";
                echo "<hr>";
                echo "<p><i class='bi bi-pencil-square'></i> Cognome = " . $utente['cognome'] . "</p>";
                echo "<hr>";
                echo "<p><i class='bi bi-envelope-at'></i> E-mail = " . $utente['email'] . "</li>";
                echo "<hr>";
                echo "<p><i class='bi bi-calendar-week'></i> Data Registrazione = " . $utente['dataregistrazione'] . "</li>";
                echo "<hr>";
                echo "</ul>";

                $id = $utente['id'];
            }
            
        }

    

       

        $numRec = "SELECT COUNT(*) AS tot FROM recensione LEFT JOIN utente ON recensione.idutente = utente.id WHERE recensione.idutente = " . $id . ";";


        $n = $conn->query($numRec);

        $row = $n->fetch_assoc();
        if ($row['tot']>0){

        echo "<div style='text-align: center'>";
        echo "<h3>Recensioni</h3>";
        echo "<p><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i></p>";
        echo "<p'>Numero recensioni effettuate: " . $row['tot'] . "</p>";
        echo "<br>";
        $info = "SELECT ristorante.nome, ristorante.indirizzo, recensione.voto, recensione.data  FROM ristorante LEFT JOIN recensione ON ristorante.codice = recensione.codiceristorante WHERE recensione.idutente =  " . $id . ";";
       
        $res = $conn->query($info);


        if ($res->num_rows > 0) {
        echo "<table class='table'>
  <thead>
    <tr>
      <th scope='col'>Nome Ristorante <i class='bi bi-house'></i></th>
      <th scope='col'>Indirizzo <i class='bi bi-geo-alt'></i></th>
      <th scope='col'>Voto <i class='bi bi-123'></i></th>
      <th scope='col'>Data <i class='bi bi-calendar-week'></i></th>
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

echo "</div>";
        
        }


        }else{
        echo "<h3>Nessuna recensione effettuata</h3>";
        }

 ?>

 <form action="inseriscirecensione.php" method="post">
 <?php

echo "<hr>";
echo "<div style='display: flex; justify-content: space-between; width: 100%; padding: 20px;'>";
echo "<div style='text-align: center; width:45%'>";
echo "<h3>Dicci la tua... </h3>";
echo "<br>";
 echo "<select name='nomi'>";
 $nomi = "SELECT ristorante.nome FROM ristorante";
 $q = $conn->query($nomi);
    if ($q->num_rows >0){
     foreach($q as $o){
        echo "<option value ='" . $o['nome'] . "'>" . $o['nome'] . "</option>;";
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
 
</div>

<br>

<?php


if(isset($_SESSION["errore"])){
  echo "<p style = 'color: red; background-color: black; text-align: center'>" . $_SESSION["errore"] . "</p>"; 
  unset($_SESSION["errore"]);
}

if (isset($_SESSION["ok"])){
  echo "<p style = 'color: green; background-color: black; text-align: center'>" . $_SESSION["ok"] . "</p>"; 
  unset($_SESSION["ok"]);
}
 ?>

 <form action="info_ristorante.php" method="post">
 <?php


echo "<div style='text-align: center'; width:'45%'>";
echo "<h3>Esplora i ristoranti... </h3>";
echo "<br>";
 echo "<select name='risto'>";
 $nomi = "SELECT ristorante.nome FROM ristorante";
 $q = $conn->query($nomi);
    if ($q->num_rows >0){
     foreach($q as $o){
        echo "<option value ='" . $o['nome'] . "'>" . $o['nome'] . "</option>;";
     }

     echo "</select>";

    }

    

    ?>

<input type="submit">
</form>

  </div>
<br>
<br>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>