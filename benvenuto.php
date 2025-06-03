<?php
session_start();
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Benvenuto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/stylesBenvenuto.css">
     <link rel="stylesheet" href="./css/stylesLogout.css">
</head>
<body>
    

    <?php

    if($_SESSION["utente"] == "admin"){
      header("Location: pannelloadmin.php");
      exit;
    }


        $sql2 = "SELECT * FROM utente WHERE username = '" . $_SESSION["utente"] . "';";
;
        $ris2 = $conn->query($sql2);

        echo "<nav class='navbar' style='background-color:rgb(162, 167, 172);'>
  <div class='container'>
    <button href='./scriptlogout.php' class='Btn'>
  
      <div class='sign'><svg viewBox='0 0 512 512'><path d='M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z'></path></svg></div> 
      <div class='text'>Logout</div>
    </button>

     <a class='navbar-bran' href='profilo.php'>
     <i style='color: black'; class='bi bi-person-circle fs-1'></i>
    </a>

  </div>
</nav>";

 echo "<h1 style='text-align: center; color: red'>Benvenuto " . $_SESSION["utente"] . " </h1>";

  $sql2 = "SELECT * FROM utente WHERE username = '" . $_SESSION["utente"] . "';";
;
        $ris2 = $conn->query($sql2);

        if ($ris2->num_rows >0){
            foreach($ris2 as $utente){
              $id = $utente['id'];
            }
          }



       

    

        $numRec = "SELECT COUNT(*) AS tot FROM recensione LEFT JOIN utente ON recensione.idutente = utente.id WHERE recensione.idutente = " . $id . ";";


        $n = $conn->query($numRec);

        $row = $n->fetch_assoc();

        

        if ($row['tot']>0){

        echo "<div style='text-align: center'>";
        echo "<h3>Recensioni</h3>";
        echo "<p><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i><i class='bi bi-star'></i></p>";
        echo "<p>Numero recensioni effettuate: " . $row['tot'] . "</p>";
        $_SESSION["numRecensioni"] = $row['tot'];
        echo "<br>";


        $info = "SELECT ristorante.nome, ristorante.indirizzo, recensione.voto, recensione.data, recensione.id  FROM ristorante LEFT JOIN recensione ON ristorante.codice = recensione.codiceristorante WHERE recensione.idutente =  " . $id . ";";
       
        $res = $conn->query($info);


        echo "<form action='elimina_recensioni.php' method='post'>";

        if ($res->num_rows > 0) {
        echo "<table class='table'>
  <thead>
    <tr>
      <th scope='col'>Nome Ristorante <i class='bi bi-house'></i></th>
      <th scope='col'>Indirizzo <i class='bi bi-geo-alt'></i></th>
      <th scope='col'>Voto <i class='bi bi-123'></i></th>
      <th scope='col'>Data <i class='bi bi-calendar-week'></i></th>
       <th scope='col'>Elimina <i class='bi bi-x-square'></i></th>
    </tr>
  </thead>
  <tbody>";

  while ($row = $res->fetch_assoc()) {
    echo "<tr>
      <td>" . $row['nome'] . "</td>
      <td>" . $row['indirizzo'] . "</td>
      <td>" . $row['voto'] . "</td>
      <td>" . $row['data'] . "</td>
      <td><input type='checkbox' name='deleteRec[]' class='delete-checkbox' value='" . $row['id'] . "'></input></td>";
    echo "</tr>";
  }




  echo "</tbody>
</table>";


echo "<input type='submit' value='Elimina' id='delete-button' disabled>";
if (isset($_SESSION["eliminazione"])){
echo "<p>" . $_SESSION["eliminazione"] . "</p>";
unset($_SESSION["eliminazione"]);
}
?>

<script>

function toggleDeleteButton() {
    const checkboxes = document.querySelectorAll('.delete-checkbox');
    const deleteButton = document.getElementById('delete-button');

  
    let isChecked = Array.from(checkboxes).some(cb => cb.checked);
    deleteButton.disabled = !isChecked;
}


document.querySelectorAll('.delete-checkbox').forEach(cb => {
    cb.addEventListener('change', toggleDeleteButton);
});
</script>

<?php


echo "</form>";

echo "</div>";
        
        }


        }else{
        echo "<p style='text-align: center'>Nessuna recensione effettuata</h3>";
        }

 ?>

 <form action="inseriscirecensione.php" method="post">
 <?php

echo "<hr>";
echo "<div style='display: flex; justify-content: space-between; width: 75%; padding: 20px; margin: auto'>";
echo "<div style='text-align: center; width: 45%;'>";
echo "<h3>Dicci la tua... </h3>";
echo "<br>";
 echo "<select name='nomi'>";
 $nomi = "SELECT ristorante.nome FROM ristorante";
 $q = $conn->query($nomi);
    if ($q->num_rows >0){
     foreach($q as $o){
        echo "<option value ='" . $o['nome'] . "'>" . $o['nome'] . "</option>";
     }

     echo "</select>";

    }

    

    ?>
<br>
<br>
<label>Voto:</label><br>

<input type="radio" id="voto1" name="voto" value="1">
<label for="voto1">1</label>

<input type="radio" id="voto2" name="voto" value="2">
<label for="voto2">2</label>

<input type="radio" id="voto3" name="voto" value="3">
<label for="voto3">3</label>

<input type="radio" id="voto4" name="voto" value="4">
<label for="voto4">4</label>

<input type="radio" id="voto5" name="voto" value="5">
<label for="voto5">5</label>
<br>
<br>
<div style="width: 100%; text-align: center;">
<button>
  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        width="24"
        height="24"
      >
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path
          fill="currentColor"
          d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
        ></path>
      </svg>
    </div>
  </div>
  <span>Send</span>
</button>
  </div>
</form>
 
</div>

<br>

<?php



 ?>

 <form action="info_ristorante.php" method="post">
 <?php


echo "<div style='text-align: center; width: 45%;'>";

echo "<h3>Esplora i ristoranti... </h3>";
echo "<br>";
 echo "<select name='risto'>";
 $nomi = "SELECT ristorante.nome FROM ristorante";
 $q = $conn->query($nomi);
    if ($q->num_rows >0){
     foreach($q as $o){
        echo "<option value ='" . $o['nome'] . "'>" . $o['nome'] . "</option>;";
     }

     echo "</select>";

    }



    ?>
<br>
<br>
<input type="submit">
</form>

  </div>
  </div>
    <br>
  <?php
    
    if(isset($_SESSION["errore"])){
 echo "<p style='color: red; text-align: center'>" . $_SESSION["errore"] . "</p>";
  unset($_SESSION["errore"]);
}

    if (isset($_SESSION["ok"])){
  echo "<p style = 'color: green; text-align: center'>" . $_SESSION["ok"] . "</p>"; 
  unset($_SESSION["ok"]);
}
  ?>

<button id="backToTop"><img src='./images/up-arrow.png' height='20px'></img></button>




<script src="./js/script.js">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>