<?php
session_start();
if(!isset($_SESSION['livello'])){
    header('location: index.php');
    exit(0);
}
?><!DOCTYPE html>
<html lang="it">
<head>
<title>redirect inserimento</title>
</head>
<body>
<script><?php

    if($_SESSION['livello'] == 1){
        $x = $_POST["Nome"];
        $y = md5($_POST["Password"]);
        $z = $_POST["Livello"];
        require "lib/connessione.php";
        
        $sql = "INSERT INTO utenti (Username, Password, Livello) VALUES ('$x','$y','$z')";
            
        if (mysqli_query($conn,$sql)){
            echo 'alert("L\'utente '.$x.' è stato inserito");';
            echo 'window.location.href = "index.php";';
        } else {
            echo 'alert("Errore in inserimento:'.mysqli_error($conn).'");';
            echo 'window.location.href = "utente_form.php";';
        }
        mysqli_close($conn);
    }
    else{
        header('location: index.php');
    }
?>
</script>
</body>
</html>