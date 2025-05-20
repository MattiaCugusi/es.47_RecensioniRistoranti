<?php
include ('connessione.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento ristorante</title>
</head>
<body>
    <?php
    $nome = $_POST["nome"];
    $indirizzo = $_POST["indirizzo"];
    $citta = $_POST["citta"];
    $latitudine = $_POST["latitudine"];
    $longitudine = $_POST["longitudine"];

    $sql = "INSERT INTO ristorante (nome, indirizzo, citta, latitudine, longitudine) VALUES ('$nome', '$indirizzo', '$citta', $latitudine, $longitudine);";
    
    $controllo = $conn->query($sql);

    if($controllo){
        $_SESSION["ok"] = "ristorante inserito con successo";
        header("Location: pannelloadmin.php");
    }else{
        $_SESSION["errore"] = "impossibile aggiungere il ristorante";
        header("Location: pannelloadmin.php");
    }
   

    ?>
</body>
</html>