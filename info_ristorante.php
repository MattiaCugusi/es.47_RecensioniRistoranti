<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Ristorante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>
<body>

    <?php

        echo "<h2><a href='benvenuto.php' ><i style='color: red'; class='bi bi-arrow-left'></i></a></h2>";

       $ristorante = $_POST["risto"];

       echo "<h1 style='text-align: center'>RECENSIONI RISTORANTE '" . $ristorante . "': </h1><hr>";

       $sql = "SELECT recensione.* FROM recensione LEFT JOIN ristorante ON recensione.codiceristorante = ristorante.codice WHERE ristorante.nome = '" . $ristorante . "'";

       $latLong = "SELECT ristorante.latitudine, ristorante.longitudine FROM ristorante WHERE ristorante.nome = '" . $ristorante . "'";
    

       $selezione = $conn->query($sql);

       if($selezione->num_rows >0){
        echo "<br><br>";
            echo "<table class='table'; style='text-align: center'>";
             echo "<thead>";
                 echo "<tr>";
                   echo "<th scope='col'>ID <i class='bi bi-info-circle'></i></th>";
                   echo "<th scope='col'>Voto <i class='bi bi-list-ol'></i></th>";
                   echo "<th scope='col'>Data_inserimento <i class='bi bi-calendar-week'></i></th>";
                   echo "<th scope='col'>Codice Utente <i class='bi bi-person-circle'></i></th>";
                   echo "</tr>";
                   echo "</thead>";


                   echo "<tbody>";
                         foreach($selezione as $riga){
           
                            echo "<tr>";
                            echo "<td>" . $riga['id']. "</td>";
                            echo "<td>" . $riga['voto']. "</td>";
                            echo "<td>" . $riga['data']. "</td>";
                            echo "<td>" . $riga['idutente']. "</td>";
                            echo "</tr>";
                       }
                    echo "</tbody>";
        echo "</table>";
       }else{
        echo "<p>Ancora nessuna recensione per questo ristorante";
       }

       $coordinate = $conn->query($latLong);

       if($coordinate->num_rows >0){
             foreach($coordinate as $c){
                $latitudine = $c['latitudine'];
                $longitudine = $c['longitudine'];
            }
       }
    ?>

    
        <style>
            #map { height: 580px; }
        </style>

     <div id="map" style="width= 50%;">
        <script>
            var map = L.map('map').setView([<?php echo $latitudine?>, <?php echo $longitudine?>], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([<?php echo $latitudine?>, <?php echo $longitudine?>]).addTo(map);

        </script>
    



</body>
</html>