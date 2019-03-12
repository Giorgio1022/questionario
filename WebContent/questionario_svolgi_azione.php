<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
</head>
<script>
    function redirect(){
        window.location.href="index.php";
    }
</script>
<title> Questionario </title>  
<body> 
<?php
$ID=$_SESSION['ID'];
$utente = $_SESSION['utente'];
// Create connection
require "lib/connessione.php";

$data = date('Y-m-d');
$sql="INSERT INTO `svolgimenti`(`ID`, `Data`, `FK_Utente`, `FK_questionario`) VALUES ('NULL','$data','$utente', '$ID')";   
    if (mysqli_query($conn, $sql)) {
   echo '<script language="javascript">';
        echo 'alert("Lo svolgimento è stato inserito");';
        echo '</script>';
} else {
        echo '<script language="javascript">';
        echo 'alert("Lo svolgimento non è stato inserito");';
        echo '</script>';
}
$last_id = mysqli_insert_id($conn);
$sqlr="INSERT INTO `risposte_svolgimenti`(`ID`, `FK_Risposta`, `FK_Svolgimento`) VALUES";
        foreach($_POST as $x => $x_value) {
    $sqlr=$sqlr." ('NULL','$x_value','$last_id')".",";

    }
$sqlr = substr($sqlr, 0, -1);
//echo $sqlr;
if (mysqli_query($conn, $sqlr)) {
    echo '<script language="javascript">';
        echo 'alert("Le risposte sono state inserite");';
    // echo 'window.location.href = "index.php";';
        echo '</script>';
} else {
   echo '<script language="javascript">';
        echo 'alert("Le risposte non sono state inserite");';
   // echo 'window.location.href = "index.php";';
        echo '</script>';
}
    
    
    $idSvolgimento = $last_id;
    $sql = 
            "SELECT SUM(risposte.Punteggio) as Punteggio, svolgimenti.FK_Utente
             FROM risposte_svolgimenti INNER JOIN risposte ON risposte.ID_risposta = risposte_svolgimenti.FK_Risposta
	                                   INNER JOIN svolgimenti ON svolgimenti.ID = risposte_svolgimenti.FK_Svolgimento
             WHERE svolgimenti.ID = '$idSvolgimento'";
        
        $risultato = mysqli_query($conn, $sql);
        if (mysqli_num_rows($risultato) > 0) {
            while($punteggio = mysqli_fetch_assoc($risultato)) {   
                echo  " Utente: " . $punteggio['FK_Utente'] . "<br> Punteggio: " . $punteggio['Punteggio'];
                echo '<br><button onclick="redirect();">Torna alla Home</button>';
            }
        } else {
            echo "0 results";
        }
        mysqli_close($conn);
    
    ?>
</body>
</html>
