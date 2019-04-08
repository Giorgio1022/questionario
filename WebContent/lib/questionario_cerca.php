<?php
require "lib/connessione.php";
controllaAccesso(3);
$conn=connessione();

header('ContentType: application/json');



mysqli_close($conn);