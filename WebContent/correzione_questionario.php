<!DOCTYPE html>
<html>
    <head>
        <title>Correzione Questionario</title>
        <meta charset = "UTF-8">
    </head>
    <body>
        <?php  
        $idSvolgimento = $_GET["id"];
        require "lib/connessione.php";
        
        $sql = 
            "SELECT SUM(risposte.Punteggio) as Punteggio, svolgimenti.FK_Utente
             FROM risposte_svolgimenti INNER JOIN risposte ON risposte.ID_risposta = risposte_svolgimenti.FK_Risposta
	                                   INNER JOIN svolgimenti ON svolgimenti.ID = risposte_svolgimenti.FK_Svolgimento
             WHERE svolgimenti.ID = '$idSvolgimento'";
        
        $risultato = mysqli_query($conn, $sql);
        if (mysqli_num_rows($risultato) > 0) {
            while($punteggio = mysqli_fetch_assoc($risultato)) {   
                echo  " Utente: " . $punteggio['FK_Utente'] . "<br> Punteggio: " . $punteggio['Punteggio'];
            }
        } else {
            echo "0 results";
        }
        mysqli_close($conn);
        ?>
    </body>
</html>