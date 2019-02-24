<?php

$conn = mysqli_connect("helios.itisgubbio.local","tpsit","tpsit","questionario");
//verifico se la connessione è stata stabilita o meno
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//consente i caratteri speciali
mysqli_set_charset($conn,"utf8");