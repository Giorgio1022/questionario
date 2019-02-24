<!doctype html>
<html><head><meta charset="utf-8"></head><body>
<?php

require "lib/connessione.php";

printf("character set: %s\n", mysqli_character_set_name($conn));

$sql="SELECT * FROM domande WHERE ID_domanda=2 ";
$risultato = mysqli_query($conn, $sql);

    $riga = mysqli_fetch_assoc($risultato);
	echo $riga['Testo_domanda'];
?>
</body></html>