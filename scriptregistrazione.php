<?php
include ('connessione.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script Registrazione</title>
</head>
<body>
    <?php
        $username = $_POST["user"];
        $password = $_POST["pass"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["mail"];

        $sql = "SELECT * FROM utente WHERE username = '" . $username . "'";

        $controllo = $conn->query($sql);

        if($controllo->num_rows >0){
            $_SESSION["errore"] = "Username gia' presente nel Database";
            header("Location: pagina_registrazione.php");
            exit();
        }else{
            $checkmail = "SELECT * FROM utente WHERE email = '" . $email . "'";
            $check = $conn->query($checkmail);
            if($check->num_rows >0){
                $_SESSION["errore"] = "E-mail gia' presente nel Database";
                header("Location: pagina_registrazione.php");
                exit();
            }else{
                $_SESSION["utente"] = $username;
                $_SESSION["errore"] = "";

                $passwordHash = hash("sha256", $password);

                $insert = "INSERT INTO utente(username, passwd, nome, cognome, email) VALUES ('" . $username . "', '" . $passwordHash . "', '" . $nome . "' , '" . $cognome . "' , '" . $email . "')";
                $check = $conn->query($insert);


                header("Location: benvenuto.php");
                exit();
            }

        }
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>