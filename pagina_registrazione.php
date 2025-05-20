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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Pagina Registrazione</title>
</head>
<body>
  
 <div style="border: solid 1px black; width:50%; margin: auto; text-align: center;">
    <h2><a href='paginalogin.php' ><i style='color: red'; class='bi bi-arrow-left'></i></a></h2>
    <h1>REGISTRAZIONE UTENTE</h1>
    <form action="scriptregistrazione.php" method="post" style="text-align: center;">

        <label>Username: <i class="bi bi-person-circle"></i></label>
        <br>
        <input type="text" name="user">
        <br>
        <label>Password: <i class="bi bi-key-fill"></i></label>
        <br>
        <input type="password" name="pass">
        <br>
        <label>Nome: <i class="bi bi-pencil-square"></i></label>
        <br>
        <input type="text" name="nome">
        <br>
        <label>Cognome: <i class="bi bi-pencil-square"></i></label>
        <br>
        <input type="text" name="cognome">
        <br>
        <label>E-mail: <i class="bi bi-envelope-at"></i></label>
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
            session_unset();
        }

    ?>


 </div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>