<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title> Questionario </title>  
</head>
<body> 
      <!-- apro un form con metodo post che possa permettere di passare i dati tra pagine 
           riga di codice in javscript che ritorna ad una pagine php 
           stampa un alert in caso non sia settato l’id-->
<form action="questionario_svolgi_azione.php" method="post">
     <?php
    if(!isset($_GET['id'])){
        echo '<script language="javascript">';
        echo 'alert("Id non è stato inserito");';
        echo 'window.location.href = "/nicola/Questionario/index.php";';
        echo '</script>';
    }
        else {
            
        //stabilisco la connessione con il server
        $ID=$_GET['id'];
        $_SESSION['ID'] = $ID;
        $servername = "192.168.1.25";
        $username = "tpsit";
        $password = "tpsit";
$db = "questionario";

$conn = mysqli_connect($servername, $username, $password, $db);
//verifico se la connessione è stata stabilita o meno
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//consente i caratteri speciali
mysqli_set_charset($conn,"utf8");

//comando sql per la selezione dei dati all’interno della tabella questionario 
//con l’id uguale a quello inserito
$sql="SELECT * FROM questionari WHERE ID = $ID";
  
$result = mysqli_query($conn, $sql);
 //stampo il nome de questionario se c’è un risultato se no stampo un alert 
//reindirizzo ad un'altra pagina
if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<H1 align=center style='color: chocolate'>${row['Nome']}</H1>";
    }
}
 else {
        echo '<script language="javascript">';
        echo 'alert("Id non è stato inserito");';
        echo 'window.location.href = "/nicola/Questionario/index.php";';
        echo '</script>';
   }
    
//comando sql per la selezione delle domande che abbiano i seguesnti requisiti 
$sqlDomande="SELECT domande.* FROM domande,domande_questionari,questionari 
WHERE domande.ID_domanda=domande_questionari.FK_domanda and domande_questionari.FK_questionario=questionari.ID 
and questionari.id='$ID'";

$resultDomande = mysqli_query($conn, $sqlDomande);
//stampo il testo della domanda se sono state trovate righe e procedo con la stampa delle risposte
if (mysqli_num_rows($resultDomande) > 0) {
    while($row = mysqli_fetch_assoc($resultDomande)) {
        echo"<h2>${row['Testo_domanda']}</h2>\n";
//comando sql per la selezione delle risposte e del loro id 
//corrispondenti a quella domanda 
        $sqlRisposte="SELECT Testo_risposta, ID_risposta FROM risposte WHERE risposte.FK_domanda=${row['ID_domanda']}";
        $id=$row['ID_domanda'];
        $resultRisposte = mysqli_query($conn, $sqlRisposte);
//stampo il testo della risposta vicino ad un radiobutton che serve per la sua selezione
        if (mysqli_num_rows($resultRisposte) > 0) {
            while($row = mysqli_fetch_assoc($resultRisposte)) {
                   echo "<p><input type='radio' name=$id value=${row['ID_risposta']}>${row['Testo_risposta']}"; echo "</p>\n";
            }
        } else {
            echo "0 results";
        }
    }
} else {
    echo "0 results";
}
    //chiudo la connessiione
mysqli_close($conn);
//creo un bottone per inviare i dati alla pagina successiva che si limiterà a verificare i risultati 
     echo '<p><button class="button"><span> Inivia questionario </span></button></p>';
        }
    ?> 
</form>
</body>
</html>
