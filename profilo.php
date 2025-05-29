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
    <title>Profilo Personale</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php
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
                echo "<p><i class='bi bi-calendar-week'></i> Data Registrazione = " . $utente['dataregistrazione'] . "</p>";
                echo "<hr>";

                $sql = "SELECT ristorante.nome, ristorante.indirizzo, recensione.voto, recensione.data, recensione.id FROM ristorante JOIN recensione ON ristorante.codice = recensione.codiceristorante WHERE recensione.idutente = " . $utente['id'] . ";
                        ORDER BY recensione.data DESC
                        LIMIT 1;";
                
                $ris = $conn->query($sql);

                 if ($ris->num_rows > 0) {
                       while ($row = $ris->fetch_assoc()) {
                          $UltimaData = $row['data'];
                       }
                       
                 }



                if ($_SESSION["numRecensioni"] > 0){
                echo "<p><i class='bi bi-calendar-week'></i> Data Ultima Recensione = " . $UltimaData . "</p>";
                echo "<hr>";

                
                }else{

                }

                echo "<form action='cambio_password.php' method='post'";
                  echo "<label><i class='bi bi-key'></i> Cambia Password:  </label>";
                  echo "<input type='password' placeholder='nuova password' name='nuovaPass'></input>";
                  echo "<input type='submit' value='Cambia'>";
                  echo "</form>";
                  if(isset($_SESSION["errore"])){
                     echo "<p style = 'color: red; background-color: black; text-align: center'>" . $_SESSION["errore"] . "</p>"; 
                      unset($_SESSION["errore"]);
                  }

                  if (isset($_SESSION["ok"])){
                     echo "<p style = 'color: green; background-color: black; text-align: center'>" . $_SESSION["ok"] . "</p>"; 
                      unset($_SESSION["ok"]);
                    }
                echo "<hr>";
            echo "</ul>";




                $id = $utente['id'];
            }
            
        }

    ?>

</body>
</html>