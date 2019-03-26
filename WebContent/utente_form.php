<?php
session_start();
if(!isset($_SESSION['Livello'])){
    header('location: index.php');
    exit(0);
}?>
<!DOCTYPE html>
<html>
<head>
    <title>Inserisci Utente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stili.css">
</head>
<body>
    <header>
    <div><img id="iis" src="logoiis.png"></div>
    <h1>Inserisci utente</h1>
    <div><a  href='index.php'><img id="esci" src="logout.png"/></a></div>
  </header>

    <form action="utente_azione.php" method="post">
        <p align=center><span style="padding-left:2em"> Nome </span> <span style="padding-left:8em"> Password </span><span style="padding-left: 2em;">Livello</span> </p>
        <p align=center><input name="Nome" type="text"> <input name="Password" type="password"><select name='Livello'><option value="0">Studente</option><option value="1">Docente</option></select> </p>
        
        <br>
        <p align=center><input value="Aggiungi" type="submit"></p>
        <br>
        
    </form>
</body>
</html>
