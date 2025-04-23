<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Recensione</title>
</head>
<body>
    <?php
       $rist =  $_POST["nomi"];
       $voto = $_POST["voto"]; 

       $trovaId = "SELECT utente.id FROM utente WHERE utente.username = '" . $_SESSION["utente"] . "';";

       $id = $conn->query($trovaId);

       $row = $id->fetch_assoc();

       $sql = "SELECT * FROM recensione LEFT JOIN ristorante ON recensione.codiceristorante = ristorante.codice WHERE ristorante.nome = '" . $rist . "' AND recensione.idutente = " . $row['id'] . ";";

       $controllo = $conn->query($sql);

       if($controllo->num_rows >0){
        $_SESSION["errore"] = "Impossibile aggiungere la recensione";
        header("Location: benvenuto.php");

       }else{
        

        $codRist = "SELECT ristorante.codice FROM ristorante WHERE ristorante.nome = '" . $rist . "';";

        $ris = $conn->query($codRist);

         $code = $ris->fetch_assoc();



        $ins = "INSERT INTO recensione (voto, idutente, codiceristorante) VALUES (" . $voto . "," .$row . ", " . $code . ");";

        $submit = $conn->query($ins);

        if($submit){
            $_SESSION["ok"] = "Recensione inserita con successo!!";
        }else{
            $_SESSION["errore"] = "Impossibile aggiungere la recensione";
        }

        header("Location: benvenuto.php");
       }

    ?>
</body>
</html>
