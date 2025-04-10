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
    <title>Pagina di Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url(./images/risto4.webp);
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
            height: 100vh;
            width:100%;
            
        }

        form {
            background-color: rgba(101, 164, 236, 0.829);
            margin: 100px;
            border: 1px solid black;
        }

        i {
            font-size: 18px;
        }
    </style>



</head>
<body>
    
    <form action="scriptlogin.php" method="post">
        <h1>LOGIN UTENTE:</h1>
        <label>Username:</label>
        <i class="bi bi-person-circle"></i>
        <br>
        <input type="text" name="username">
        <br>
        <br>
        <label>Password:</label>
        <i class="bi bi-key-fill"></i>
        <br>
        <input type="password" name="passwd">
        <br>
        <br>
        <button type="submit" class="btn-outline-primary">Accedi</button>
        <br>
        <br>
    </form>

    <?php
        if(isset($_SESSION["errore"])){
            echo "<p style = 'color: red; background-color: black'>" . $_SESSION["errore"] . "</p>"; 
        }
        

    ?>
    
    <form action="pagina_registrazione.php" method="post">
        <p>Non sei ancora registrato?</p>
        <button type="submit" class="btn-outline-primary">Registrati ora</button>
        <br>
        <br>
    </form>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>