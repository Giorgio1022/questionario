<?php
function connessione(){
    $conn = mysqli_connect("helios.itisgubbio.local","tpsit","tpsit","questionario");
    //verifico se la connessione è stata stabilita o meno
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //consente i caratteri speciali
    mysqli_set_charset($conn,"utf8");
    return $conn;
}
function controllaAccesso($livMinimo){
    session_start();
    if(!isset($_SESSION['utente'])){
        header('location: login_form.html');     
        exit(0);
    }
    if($_SESSION['livello']<$livMinimo){
        http_response_code(403);
        echo "<html><body>Non hai diritto di accedere a questa pagina</body></html>";
        exit(0);
    }
}