<?php
session_start();
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
        echo "<h1>Benvenuto " . $_SESSION["utente"] . " </h1>";
        echo "<a href='scriptlogout.php'>Log-out</a>";
    ?>
</body>
</html>