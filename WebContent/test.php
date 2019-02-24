<!doctype html>
<html><head><meta charset="utf-8"></head><body>
<?php

$conn = mysqli_connect("helios.itisgubbio.local","tpsit","tpsit","questionario");
if(!$conn){
    die("Connessione non riuscita: " . mysqli_connect_error());
}

printf("Initial character set: %s\n", mysqli_character_set_name($conn));

mysqli_set_charset ( $conn , "utf8" );

printf("Initial character set: %s\n", mysqli_character_set_name($conn));

$sql="SELECT * FROM domande WHERE ID_domanda=2 ";
$risultato = mysqli_query($conn, $sql);

    $riga = mysqli_fetch_assoc($risultato);
	echo $riga['Testo_domanda'];
?>
</body></html>