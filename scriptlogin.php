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
        $passwd = $_POST["password"];

        $sql = "SELECT * FROM utente WHERE username = " . $username;
      

        $login = $conn->query($sql);
        
        if($login->num_rows >0){
            $sqlPass = "SELECT * FROM utente WHERE username = " . $username . " AND passwd = " . $passwd;
            $_SESSION["errore"] = "password errata";
        }else{
            $_SESSION["errore"] = "username: " . $username . "non esistente";
    
        }

        header("Location: errore_loginreg.php");

    ?>
</body>
</html>