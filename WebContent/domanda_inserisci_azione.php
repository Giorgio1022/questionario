<?php
//stabilisco la connessione con il server
error_log("P1:".serialize($_POST));
require "lib/connessione.php";

//comando sql per l’inserimento dei dati all’interno di domande
$testoDomanda = mysqli_real_escape_string($conn,$_POST['Domanda']);
$sql = "INSERT INTO `domande`(`ID_domanda`, `Testo_domanda`, `FK_Materia`) VALUES ('NULL','$testoDomanda','{$_POST['listbox']}')";
error_log("P2 ".$sql);
//stampo su video il risultato dell’operazione
if(mysqli_query($conn, $sql)){
     echo '<script language="javascript">';
        echo 'alert("Le domande sono state inserite");';
        echo '</script>';
    } else {
     echo '<script language="javascript">';
        echo 'alert("Le domande non sono state inserite" + mysqli_error($conn));';
        echo '</script>';
}

//comando per i caratteri speciali
$last_id = mysqli_insert_id($conn);
//comando sql per l’inserimento dei dati all’interno di risposte
$testoRisposta = array();
for($i=1; $i<=4; $i++){
	$testoRisposta[$i] = mysqli_real_escape_string($conn, $_POST["risposta$i"]);
}
$sqlr = "INSERT INTO `risposte`(`ID_risposta`, `Testo_risposta`, `Punteggio`, `FK_domanda`) VALUES ".
	"('NULL','{$testoRisposta[1]}','{$_POST['punteggio1']}','$last_id'),".
	"('NULL','{$testoRisposta[2]}','{$_POST['punteggio2']}','$last_id'),".
	"('NULL','{$testoRisposta[3]}','{$_POST['punteggio3']}','$last_id'),".
	"('NULL','{$testoRisposta[4]}','{$_POST['punteggio4']}','$last_id')";
error_log("P3 ".$sqlr);
//stampo su video il risultato dell’operazione
if(mysqli_query($conn, $sqlr)){
     echo '<script language="javascript">';
        echo 'alert("Le risposte sono state inserite");';
    echo 'window.location.href = "domanda_inserisci_form.php";';
        echo '</script>';
    } else {
     echo '<script language="javascript">';
        echo 'alert("Le risposte non sono state inserite" + mysqli_error($conn));';
        echo 'window.location.href = "domanda_inserisci_form.php";';
        echo '</script>';
}
//chiudo la connessione
mysqli_close($conn);
error_log("P4 chiuso");
?>

