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
            }
            
        }

        $id = "SELECT * FROM utente WHERE username ='" . $_SESSION["utente"] . "';";

        $idNum = $conn->query($id);

        if ($idNum->num_rows >0){
            foreach($idNum as $i){
                $q = "SELECT COUNT(*) as numRec FROM recensioni WHERE id =" . $i . ";";
                $nRec = $conn->query($q);

                if ($nRec->num_rows >0){
                    foreach($nrec as $n){
                    echo "<p>" . $n . "</p>";
                }
            }
        }
                


    }

       

        echo "<a href='scriptlogout.php' >Log-out</a>";
    ?>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>