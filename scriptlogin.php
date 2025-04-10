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
    <title>Script Login</title>
</head>
<body>
    <?php
        $username = $_POST["username"];
        $passwd = $_POST["passwd"];

        $sql = "SELECT * FROM utente WHERE username = '" . $username . "'";
      

        $login = $conn->query($sql);

        $newPass = hash("sha256", $passwd);
        
        if($login->num_rows >0){
            $sqlPass = "SELECT * FROM utente WHERE username = '" . $username . "' AND passwd = '" . $newPass . "'";
            
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

        header("Location: paginalogin.php");
        exit();
        

    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>

