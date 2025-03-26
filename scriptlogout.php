<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-out</title>
</head>
<body>
    <?php
        session_unset();
        echo "<h1>log-out effettuato! A presto!</h1>";
        echo "<br>";
        echo "<a href='paginalogin.html'>Torna al login</a>";
    ?>
</body>
</html>