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
    <title>Pagina Registrazione</title>
</head>
<body>
 <div style="border: solid 1px black; width:50%; margin: auto; text-align: center;">
    <h1>REGISTRAZIONE UTENTE</h1>
    <form action="scriptregistrazione.php" method="post" style="text-align: center;">

        <label>Username:</label>
        <br>
        <input type="text" name="user">
        <br>
        <label>Password:</label>
        <br>
        <input type="password" name="pass">
        <br>
        <label>Nome:</label>
        <br>
        <input type="text" name="nome">
        <br>
        <label>Cognome:</label>
        <br>
        <input type="text" name="cognome">
        <br>
        <label>E-mail:</label>
        <br>
        <input type="email" name="mail">
        <br>
        <br>

        <button type="submit">Registrati</button>
        <br>
        <br>
    </form>

    <?php
        if(isset($_SESSION["errore"])){
            echo "<p style = 'color: red; background-color: black'>" . $_SESSION["errore"] . "</p>"; 
        }
    ?>


 </div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>