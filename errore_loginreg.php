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
<h2 style='color: red'>Ops.. qualcosa e' andato storto</h2>
    <?php
    echo "<p style = 'color: red'>" . $_SESSION["errore"] . "</p>";
    $_SESSION["errore"] = "";
    ?>

    <a href="paginalogin.html">Torna al login</a>

</body>
</html>