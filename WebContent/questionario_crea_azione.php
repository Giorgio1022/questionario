<?php

require "lib/connessione.php";
$sqlQuestionario = "";
$sqlDQ = "";
$trovato=false;
foreach($_POST as $key => $value){
    if(strstr($key, "idD_")){
        $trovato=true;
        break;
    }
}
if (!$trovato){
    echo '<script language="javascript">';
    echo 'alert("I dati non sono stati inseriti! È necessario selezionare la disciplina e le domande relative");';
    echo 'window.location.href = "questionario_crea_form.php";';
    echo '</script>';
    exit(0);
}
$sqlQuestionario = 
    "INSERT INTO questionari (ID, Nome, FK_Materia)
     VALUES ('', '$_POST[nomequestionario]', '$_POST[materiaQuestionario]')";

if(mysqli_query($conn, $sqlQuestionario)){
   // echo'{"esito":"riuscito"}';	
}
else{
    echo'{"esito":"no", "descrizione":"'.mysqli_error($conn).'" }';
}


$sqlDQ = "INSERT INTO domande_questionari (ID, FK_domanda, FK_questionario)
            VALUES";

foreach($_POST as $key => $value){
    if(strstr($key, "idD_")){
        $sqlDQ = $sqlDQ . "('', $_POST[$key], ".mysqli_insert_id($conn)."),";
    }
}
$sqlDQ = substr($sqlDQ, 0, -1);

if(mysqli_query($conn, $sqlDQ)){
    echo '<script language="javascript">';
    echo 'alert("I dati sono stati inseriti");';
    echo 'window.location.href = "questionario_crea_form.php";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("I dati non sono stati inseriti" + mysqli_error($conn));';
    echo 'window.location.href = "questionario_crea_form.php";';
    echo '</script>';
}
?>