<?php
session_start();
?><!DOCTYPE html>
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
require "lib/connessione.php";

$data = date('Y-m-d');
$sql="INSERT INTO svolgimenti(ID, Data, FK_Utente, FK_questionario) VALUES (NULL,'$data','$utente', '$ID')";   
if (mysqli_query($conn, $sql)) {
    echo '<p>Lo svolgimento è stato inserito</p>';

    $idSvolgimento = mysqli_insert_id($conn);
    $sqlr="INSERT INTO risposte_svolgimenti(ID, FK_Risposta, FK_Svolgimento) VALUES";
    foreach($_POST as $x => $x_value) {
        $sqlr=$sqlr." (NULL,'$x_value','$idSvolgimento')".",";
    }
    // mangio l'ultima virgola
    $sqlr = substr($sqlr, 0, -1);

    if (mysqli_query($conn, $sqlr)) {
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
            echo  " Utente: " . $punteggio['FK_Utente'] . "<br> Punteggio: " . $punteggio['Punteggio'];
            echo '<br><button onclick="redirect();">Torna alla Home</button>';
        }
    } else {
        echo "<p class='errore'>impossibile calcolare il punteggio, errore: ".mysqli_error($conn)."</p>";
    }
} else {
    echo '<p class="errore">Lo svolgimento non è stato inserito, errore: '.mysqli_error($conn).'</p>';
}

mysqli_close($conn);    
?>
</body>
</html>
