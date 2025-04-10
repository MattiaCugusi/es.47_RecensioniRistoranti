<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

        

        
        
        
        echo "<a href='scriptlogout.php'>Log-out</a>";

    ?>
</body>
</html>