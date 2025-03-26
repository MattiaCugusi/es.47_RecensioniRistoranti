<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<h2 style='color: red'>Ops.. qualcosa e' andato storto</h2>
    <?php
    echo "<p style = 'color: red'>" . $_SESSION["errore"] . "</p>";
    $_SESSION["errore"] = "";
    ?>


    <a href="paginalogin.html"><i class="bi bi-skip-backward-fill"></i> Torna al login</a>

</body>
</html>