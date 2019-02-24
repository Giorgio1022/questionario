<?php
session_start();
require "lib/connessione.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$sql="SELECT Username, Password, Livello FROM utenti WHERE username = '$username' AND Password = '$password';";
$risultato = mysqli_query($conn, $sql);
if(mysqli_num_rows($risultato)>0){
    $riga = mysqli_fetch_assoc($risultato);
    $_SESSION['utente'] = $riga['Username'];
    $_SESSION['Livello'] = $riga['Livello'];
    header('location: index.php');            
}
else{
    header('location: login_form.html');
}
?>