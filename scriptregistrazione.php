<?php
include ('connessione.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
            header("Location: errore_loginreg.php");
            exit();
        }else{
            $checkmail = "SELECT * FROM utente WHERE email = '" . $email . "'";
            $check = $conn->query($checkmail);
            if($check->num_rows >0){
                $_SESSION["errore"] = "E-mail gia' presente nel Database";
                header("Location: errore_loginreg.php");
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
</body>
</html>