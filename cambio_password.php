<?php
session_start();
include ('connessione.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio Password</title>
</head>
<body>
    <?php

    $pass = $_POST["nuovaPass"];

    $passwordHashata = hash("sha256", $pass);


    $q = "SELECT utente.id FROM utente WHERE username = '" . $_SESSION["utente"] . "' AND passwd = '" . $passwordHashata . "'";
    
    $check = $conn->query($q);

    if($check->num_rows > 0){
        $_SESSION["errore"] = "Impossibile modificare la password";
    }else{
       $updatePass = "UPDATE utente SET passwd = '" . $passwordHashata . "' WHERE username = '" . $_SESSION["utente"] . "'";
        $up = $conn->query($updatePass);

         if ($conn->affected_rows > 0) {
               $_SESSION["ok"] = "Password modificata";
         } else {
               $_SESSION["errore"] = "Impossibile modificare la password";
}
    }

    header("Location: benvenuto.php");



    ?>
    
</body>
</html>