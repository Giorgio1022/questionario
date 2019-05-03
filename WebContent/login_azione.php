<?php //apro il php
session_start(); //apro una sessione
require "lib/connessione.php";//recupero dai
$conn=connessione(); //connette
$username = $_POST['username']; //creo una variabile post





$password = md5($_POST['password']); // creo variabile con cifratura

$sql="SELECT Username, Password, Livello FROM utenti WHERE username = '$username' AND Password = '$password';";// testo quey
$risultato = mysqli_query($conn, $sql);//creo query
if(mysqli_num_rows($risultato)>0){ //Ottiene il numero di righe in un risultato
    $riga = mysqli_fetch_assoc($risultato);//Recuper una riga del risultato 
    $_SESSION['utente'] = $riga['Username'];//salvo nelle vcariabili di sessione username e password
    $_SESSION['livello'] = $riga['Livello'];
    header('location: index.php');//ritorna index.php
    $accesso="RIUSCITO";
}else{
    header('location: login_form.html');//torna al form di login perche utente sconosciuto
    $accesso="NON RIUSCITO";
}
$file = "fileLogin.txt";
$data = date('d/m/Y \a\l\l\e H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$finale=$ip.";".$data.";".$username.";".$accesso."\n";
//$ora= date("H:i:s");
// apriamo il file in scrittura, 
// il parametro 'a' indica che deve aggiungere il testo a quello esistente
// per sovrascrivere il contenuto si usa 'w'        
$fileDati = fopen($file, 'a');
fwrite($fileDati,$finale);
fclose($fileDati);

//chiudo la connessione
mysqli_close($conn);
?> <!--chiudo php>