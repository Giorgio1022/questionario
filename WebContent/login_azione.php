<?php //apro il php
session_start(); //apro una sessione
require "lib/connessione.php";//recupero dai
$conn=connessione(); //connette

$username = $_POST['username']; //creo una variabile post
$password = md5($_POST['password']); // creo variabile con cifratura

$sql="SELECT Username, Password, Livello FROM utenti WHERE username = '$username' AND Password = '$password';";// testo quey
$risultato = mysqli_query($conn, $sql);//creo query

if(mysqli_num_rows($risultato)>0){ //Ottiene il numero di righe in un risultato
    $riga = mysqli_fetch_assoc($risultato);//Recupera una riga del risultato 
    $_SESSION['utente'] = $riga['Username'];//salvo nelle vcariabili di sessione username e password
    $_SESSION['livello'] = $riga['Livello'];
    header('location: index.php');//ritorna index.php
    $stato = true;
}else{
    header('location: login_form.html');//torna al form di login perche utente sconosciuto
    $stato = false;
}
//creo data e ora
date_default_timezone_set('Europe/Rome');
$data=time();
$data=date('Y-m-d H:i:s', $data);

//trovo indirizzo ip
$ip = $_SERVER['REMOTE_ADDR']; 

//controllo se il login è andato a buon fine
if($stato==true){
    $rstato="Accesso accettato";
}else{
    $rstato="Accesso negato";
}

$fp = fopen("info.txt", "a+");

if(!$fp) die ("Errore nella operaione con il file");
fwrite($fp, "username: $username // data: $data // ip: $ip // stato: $rstato \n");
fclose($fp);

//chiudo la connessione
mysqli_close($conn);
?> <!--chiudo php>