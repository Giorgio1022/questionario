<?php
/* require è un metodo per connettersi alla libreria, viene controllato 
anche l'accesso:solo l'utente con il livello adeguato può accedere*/
require "lib/connessione.php";
controllaAccesso(3);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Questionario</title>  
    <link rel="stylesheet" type="text/css" href="stili.css">
    <!-- viene impostato il margine al form tramite il foglio di stile --> 
    <style>
        form { margin: 2em }
    </style>
</head>
<body> 
<!-- viene creato il form che si collega con il file  "questionario_svolgi_azione.php"--> 
<form action="questionario_svolgi_azione.php" method="post">
    <?php
    /* isset serve per vedere se la variabile id è stata definita */
    if(!isset($_GET['id'])){
        /* stampa un alert e ritorna all'indice in caso non sia settato l’id */
        echo '<script language="javascript">';
        echo 'alert("Id non è stato inserito");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    } else {
        //stabilisco la connessione con il server
        $ID=$_GET['id'];
        $_SESSION['ID'] = $ID;
        $conn = connessione();
//la query prende dalla tabella questionari tutti gli id con valore uguale a quello passato con GET
        $sql="SELECT * FROM questionari WHERE ID = $ID";
  
        $result = mysqli_query($conn, $sql);
        // stampo il nome de questionario se c’è un risultato se no 
        // stampo un alert e reindirizzo ad un'altra pagina
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<H1 align=center style='color: chocolate'>${row['Nome']}</H1>";
            }
        } else {
            //stampa un alert in javascript se il numero delle righe è < 0
            echo '<script language="javascript">';
            echo 'alert("Id non è stato inserito");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
    //seleziona le domande corrispondenti all'id del questionario scelto
        $sqlDomande="SELECT domande.* FROM domande,domande_questionari,questionari 
            WHERE domande.ID_domanda=domande_questionari.FK_domanda and domande_questionari.FK_questionario=questionari.ID 
            and questionari.id='$ID'";

        $resultDomande = mysqli_query($conn, $sqlDomande);
        //stampo il testo della domanda se sono state trovate righe e procedo con la stampa delle risposte
        if (mysqli_num_rows($resultDomande) > 0) {
            while($row = mysqli_fetch_assoc($resultDomande)) {
                echo "<div class='domanda'>\n";
                echo"<h2>${row['Testo_domanda']}</h2>\n";
                //comando sql per la selezione delle risposte e del loro id corrispondenti a quella domanda 
                $sqlRisposte="SELECT Testo_risposta, ID_risposta FROM risposte WHERE risposte.FK_domanda=${row['ID_domanda']}";
                $id=$row['ID_domanda'];
                $resultRisposte = mysqli_query($conn, $sqlRisposte);
                //stampo il testo della risposta vicino ad un radiobutton che serve per la sua selezione
                if (mysqli_num_rows($resultRisposte) > 0) {
                    while($row = mysqli_fetch_assoc($resultRisposte)) {
                        echo "<p><input type='radio' name=$id value=${row['ID_risposta']}><label>${row['Testo_risposta']}"; echo "</label></p>\n";
                    }
                } else {
                    echo "0 results";
                }
                echo "</div>\n";
            }
        } else {
            echo "0 results";
        }
        //chiude la connessione
        //il bottone permette di inviare i risultati 
        mysqli_close($conn);
        echo '<p><button><span> Inivia questionario </span></button></p>';
    }
    ?> 
</form>
</body>
</html>
