<?php
// stabilisco la connessione con il server chiamando il file connessione.php
require "lib/connessione.php";
controllaAccesso(9);
$conn=connessione();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title> Inserimento materia </title>  
  <meta name="utente" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stili.css">
</head>
<body> 
  <header>
      <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
      <h1>Inserimento materia</h1>
      <a href="index.php"><img src="immagini/home.png"/></a>
  </header>
   <!-- Form per inserire il nome della materia -->
  <form action="materia_inserisci_azione.php" method="post">
      <p> <input name="materia" type="text"></p>
      <p><button><span> Inserisci i dati </span></button></p> 
  </form>
</body>
</html>



