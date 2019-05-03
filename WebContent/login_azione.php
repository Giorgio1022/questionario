<?php //apro il php
session_start(); //apro una sessione
require "lib/connessione.php";//recupero dai
$conn=connessione(); //connette

$username = $_POST['username']; //creo una variabile post
$password = md5($_POST['password']); // creo variabile con cifratura
$sql="SELECT Username, Password, Livello FROM utenti WHERE username = '$username' AND Password = '$password';";// testo quey
$risultato = mysqli_query($conn, $sql);//creo query
$fp=fopen("datiUtenti.txt","a");
    if(!$fp){
        die ("Errore nella operazione con il file");
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    fwrite($fp,$ip." ");
    $data=date("j-n-Y/H:i:s");
    fwrite($fp,$data." ");
    fwrite($fp,$username." ");
if(mysqli_num_rows($risultato)>0){ //Ottiene il numero di righe in un risultato
    fwrite($fp,"ok\n");
    $riga = mysqli_fetch_assoc($risultato);//Recupera una riga del risultato 
    $_SESSION['utente'] = $riga['Username'];//salvo nelle vcariabili di sessione username e password
    $_SESSION['livello'] = $riga['Livello'];
    header('location: index.php');//ritorna index.php
}else{
    fwrite($fp,"no\n");
    header('location: login_form.html');//torna al form di login perche utente sconosciuto
}
//chiudo la connessione
mysqli_close($conn);
?> <!--chiudo php-->