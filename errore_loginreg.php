<?php
include ('connessione.php');
include ('scriptlogin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<p>" . $_SESSION["errore"] . "</p>";
    ?>
</body>
</html>