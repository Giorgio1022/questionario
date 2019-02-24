<?php
session_start();
header('Content-type: application/json; charset=UTF-8');
//creazione delle variabili
$desc = $_GET['q'];
$materia = $_GET['materia'];
$n = 0;
if(!isset($_SESSION['utenti'])){
// header('Location: login.html');
}
// creo la connessione con il server talos, se (if) la connessione non avviene con successo, 
// viene visualizzato un messaggio di errore.
require "lib/connessione.php";

//selezione di tutto il contenuto dalla tabelle domande, ove la materia e successivamente la domanda, contengono uno o pi� caratteri da noi passati. Successivamente vengono ordinati in base all� ID_Domanda. 
$sqlDomande = "
SELECT * 
FROM materia INNER JOIN domande ON materia.Nome = domande.FK_Materia
WHERE materia.Nome LIKE '%$materia%' AND domande.Testo_domanda LIKE '%$desc%'
ORDER BY ID_domanda
";

$risultatoDomande = mysqli_query($conn, $sqlDomande);
echo "[\n";
while($domande = mysqli_fetch_assoc($risultatoDomande)){
//selezione di tutto il contenuto appartenente alla tabella risposte, ove la domanda � identica al campo FK_DOMANDA.
    $sqlRisposte = "
    SELECT * 
    FROM risposte
    WHERE FK_domanda = ".$domande['ID_domanda'];
   
    $risultatoRisposte = mysqli_query($conn, $sqlRisposte); 
    $risposte = mysqli_fetch_assoc($risultatoRisposte);
    if($n != 0){
        echo ",";
    }
    $togliere = array("\n","\r",'"',"  ","    ","\t");
    $mettere = array(" "," ",'\\"'," "," "," ");
//stampa del JSON
    echo
        '{
            "Materia" : "'.$domande['FK_Materia'].'",
	        "Domanda" : "'.str_replace($togliere, $mettere, $domande['Testo_domanda']).'",
	        "Posizione_domanda" : "'.$domande['ID_domanda'].'",
            "Risposte" : [{
                    "Risposta" : "'.(str_replace($togliere, $mettere, $risposte['Testo_risposta'])).'",
                    "Punteggio" : "'.$risposte['Punteggio'].'"
            }';
            while($risposte = mysqli_fetch_assoc($risultatoRisposte)){
            echo 
                ',{
                    "Risposta" : "'.str_replace($togliere, $mettere, $risposte['Testo_risposta']).'",
                    "Punteggio" : "'.$risposte['Punteggio'].'"
                }';
            }
    echo "]\n}";
    $n++;
}
echo "\n]";
?> 
