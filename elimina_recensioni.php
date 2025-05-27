<?php
session_start();
include ('connessione.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimina Recensioni</title>
</head>
<body>
    <?php

    if (isset($_POST["deleteRec"])){
        $arrayElimina = $_POST["deleteRec"];
        $numCheckbox = count($arrayElimina);

       for ($i=0; $i<$numCheckbox; $i++){
        $q = "DELETE FROM recensione WHERE recensione.id = " . $arrayElimina[$i];
        $eliminazione = $conn->query($q);
       
       }

        $_SESSION["eliminazione"] = "sono state eliminate " . $numCheckbox . " recensioni!";
        header("Location: benvenuto.php");
    }

    ?>
</body>
</html>