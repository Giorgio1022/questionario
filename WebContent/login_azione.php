<?php
session_start();
$conn = mysqli_connect("helios.itisgubbio.local","tpsit","tpsit","questionario");
if(!$conn){
    die("Connessione non riuscita: " . mysqli_connect_error());
}
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