<?php
session_start();
if(!isset($_SESSION['Livello'])){
    header('location: index.php');
    exit(0);
}?>
        <!DOCTYPE html>
<html>
<style>
html{
   background: linear-gradient(to bottom right, black, #4000ff,#c4e6d9);
}
</style>
<head>
    <title>Inserisci Utente</title>
    <meta charset="UTF-8">
</head>
<body>
    <form action="utente_azione.php" method="post">
        <a href="index.php"> <img src="logout.png" style="width:110px;height:100px;"> </a>
        <h1 align=center style="color: red"> Utenti </h1>
        <p align=center><span style="padding-left:2em"> Nome </span> <span style="padding-left:8em"> Password </span><span style="padding-left: 2em;">Livello</span> </p>
        <p align=center><input name="Nome" type="text"> <input name="Password" type="password"><select name='Livello'><option value="0">Studente</option><option value="1">Docente</option></select> </p>
        
        <br>
        <p align=center><input value="Aggiungi" type="submit"></p>
        <br>
        
    </form>
</body>
</html>
