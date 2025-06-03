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
    <link rel="stylesheet" href="./css/stylesLogin.css">
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
        <h1>Login Utente:</h1>
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

        
            <button type="submit">
    <span class="text">Accedi</span>
    <svg
        width="34"
        height="34"
        viewBox="0 0 74 74"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
        <path
        d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z"
        fill="white"
        ></path>
    </svg>
    </button>

        <br>
        <br>
    </form>

    <?php
        if(isset($_SESSION["errore"])){
            echo "<p style = 'color: red; background-color: black'>" . $_SESSION["errore"] . "</p>"; 
            unset($_SESSION["errore"]);
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