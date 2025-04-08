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
    
        $sql = "SHOW COLUMNS FROM utente";

        $sql2 = "SELECT * FROM utente WHERE username = " . $_SESSION["utente"] . ";";

        $ris = $conn->query($sql);
        $ris2 = $conn->query($sql2);

        echo "<ul>";

       
    
        echo "</ul>";
        
        
        echo "<a href='scriptlogout.php'>Log-out</a>";

    ?>
</body>
</html>