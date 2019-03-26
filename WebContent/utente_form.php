<?php
session_start();
if(!isset($_SESSION['livello'])){
    header('location: index.php');
    exit(0);
}?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Inserisci Utente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stili.css">
</head>
<body>
    <header>
        <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
        <h1>Inserisci utente</h1>
        <a href="index.php"><img src="immagini/home.png"/></a>
    </header>

    <form action="utente_azione.php" method="post">
        <table style="margin:auto">
            <tr>
                <th>Nome</th><th>Password</th><th>Livello</th>
            </tr>
            <tr>
                <td><input name="Nome" type="text"></td>
                <td><input name="Password" type="password"></td>
                <td>
                    <select name='Livello'>
                        <option value="0">Studente</option>
                        <option value="1">Docente</option>
                    </select>
                </td>
            </tr>
        </table>

        <p><input value="Aggiungi" type="submit"></p>
        
    </form>
</body>
</html>
