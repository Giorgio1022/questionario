<?php
// stabilisco la connessione con il server chiamando il file connessione.php
require "lib/connessione.php";
controllaAccesso(9);
$conn=connessione();
?>
<!DOCTYPE html>
<html lang="it">
<head>
<title>redirect inserimento</title>
</head>
<body>
<?php
require "lib/connessione.php";
//comando sql per l’inserimento dei dati all’interno della tabella materia
$sql = "INSERT INTO `materie`(`Nome`) VALUES ('{$_POST['materia']}')";

//stampo su video il risultato dell’operazione
if(mysqli_query($conn, $sql)){
   echo 'alert("I dati sono stati inseriti");';
   echo 'window.location.href = "materia_inserisci_form.php";';
} else {
   echo 'alert("I dati non sono stati inseriti:'. mysqli_error($conn).'");';
   echo 'window.location.href = "materia_inserisci_form.php";';
}

//chiudo la connessione
mysqli_close($conn);
?>
</body>
</html>

