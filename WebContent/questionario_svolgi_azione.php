<?php
/* require è un metodo per connettersi alla libreria, viene controllato 
anche l'accesso:solo l'utente con il livello adeguato può accedere*/
require "lib/connessione.php";
controllaAccesso(3);;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Questionario</title>  
    <link rel="stylesheet" href="stili.css">
</head>
<body> 
    <header>
        <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
        <h1>Svolgimento questionario</h1>
        <a href="index.php"><img src="immagini/home.png"/></a>
    </header>
<?php
$ID=$_SESSION['ID'];
$utente = $_SESSION['utente'];
// Create connection

$conn = connessione();
//Formatta la data e l'ora locale
$data = date('Y-m-d');
//inserisce dentro la tabella svolgimenti la data,l'utente corrsipondente e l'id del questionario
$sql="INSERT INTO svolgimenti(ID, Data, FK_Utente, FK_questionario) VALUES (NULL,'$data','$utente', '$ID')";   
//se sono stati selezionate le risposte viene mostrato il messaggio sottostante
if (mysqli_query($conn, $sql)) {
    echo '<p>Lo svolgimento è stato inserito</p>';

    $idSvolgimento = mysqli_insert_id($conn);
    $sqlr="INSERT INTO risposte_svolgimenti(ID, FK_Risposta, FK_Svolgimento) VALUES";
    //inserisco la risposta utilizzando il foreach che scompone il vettore $POST e li esegue in una query
    foreach($_POST as $x => $x_value) {
        $sqlr=$sqlr." (NULL,'$x_value','$idSvolgimento')".",";
    }
    // mangio l'ultima virgola
    $sqlr = substr($sqlr, 0, -1);

    if (mysqli_query($conn, $sqlr)) {
        //se il risultato della query è giusto viene mostrato un messaggio sottostante
        echo '<p>Le risposte sono state inserite</p>';
    } else {
        echo '<p class="errore">Le risposte non sono state inserite, errore: '.mysqli_error($conn).'</p>';
        // FIXME: a questo punto abbiamo inserito una riga in svolgimenti non legata a uno svolgimento reale
    }

    // calcolo il punteggio
    $sql = "SELECT SUM(risposte.Punteggio) as Punteggio, svolgimenti.FK_Utente
             FROM risposte_svolgimenti INNER JOIN risposte ON risposte.ID_risposta = risposte_svolgimenti.FK_Risposta
	                                   INNER JOIN svolgimenti ON svolgimenti.ID = risposte_svolgimenti.FK_Svolgimento
             WHERE svolgimenti.ID = '$idSvolgimento'";
        
    $risultato = mysqli_query($conn, $sql);
    if (mysqli_num_rows($risultato) > 0) {
        // FIXME: perché qui sotto c'è un ciclo? quanti risultati si possono recuperare?
        while($punteggio = mysqli_fetch_assoc($risultato)) {   
            //stampa il nome dell'utente che ha svolto la prova e il punteggio ottenuto  
            echo  " Utente: " . $punteggio['FK_Utente'] . "<br> Punteggio: " . $punteggio['Punteggio'];
            //c'è un bottone per tornare alla home
            echo '<br><button onclick="redirect();">Torna alla Home</button>';
        }
    } else {
        //se il numero delle righe sono minori di 0 viene mostrato un messaggio d'errore
        echo "<p class='errore'>impossibile calcolare il punteggio, errore: ".mysqli_error($conn)."</p>";
    }
} else {
    //se il numero delle righe sono minori di 0 potrebbe esserci anche questo problema 
    echo '<p class="errore">Lo svolgimento non è stato inserito, errore: '.mysqli_error($conn).'</p>';
}
//chiude la connessione
mysqli_close($conn);    
?>
</body>
</html>
