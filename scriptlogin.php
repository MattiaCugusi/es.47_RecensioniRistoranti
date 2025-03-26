<?php
include ('connessione.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script Login</title>
</head>
<body>
    <?php
        $username = $_POST["username"];
        $passwd = $_POST["passwd"];

        $sql = "SELECT * FROM utente WHERE username = '" . $username . "'";
      

        $login = $conn->query($sql);
        
        if($login->num_rows >0){
            $sqlPass = "SELECT * FROM utente WHERE username = '" . $username . "' AND passwd = '" . $passwd . "'";
            
            $controlPass = $conn->query($sqlPass);
            if ($controlPass->num_rows > 0){
                $_SESSION["utente"] = $username;
                $_SESSION["errore"] = "";
                header("Location: benvenuto.php");
                exit();
            }else{
                $_SESSION["errore"] = "password errata";
            
            }
        }else{
            $_SESSION["errore"] = "username: '" . $username . "' non esistente";
    
        }

        header("Location: errore_loginreg.php");
        exit();
        

    ?>
</body>
</html>

