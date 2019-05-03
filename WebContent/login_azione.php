<?php
session_start();
require "lib/connessione.php";
$conn=connessione();

$username = $_POST['username'];
$password = md5($_POST['password']);
$sql="SELECT Username, Password, Livello FROM utenti WHERE username = '$username' AND Password = '$password';";
$risultato = mysqli_query($conn, $sql);
if(mysqli_num_rows($risultato)>0){
    $riga = mysqli_fetch_assoc($risultato);
    $_SESSION['utente'] = $riga['Username'];
    $_SESSION['livello'] = $riga['Livello'];
    
    $ip = $_SERVER [ 'REMOTE_ADDR'];
    
ini_set( 'date.timezone', 'Europe/Rome' );
$fp = fopen("pagina.txt","a-");
fwrite($fp,"ok");
fwrite($fp, " ");
fwrite($fp, $ip);
fwrite($fp, " ");
fwrite($fp, $username);
fwrite($fp, " ");
fwrite($fp, date('d M Y'));
fwrite($fp, " ");
fwrite($fp, date("H:i:s"));
fwrite($fp, "\r\n");
fclose($fp);

}else{
    header('location: login_form.html');
}
//chiudo la connessione
mysqli_close($conn);
?>