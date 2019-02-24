<?php

$conn = mysqli_connect('helios.itisgubbio.local', 'tpsit', 'tpsit', 'questionario');
$sqlQuestionario = "";
$sqlDQ = "";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
    echo 'window.location.href = "/nicola/Questionario/questionario_crea_form.php";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("I dati non sono stati inseriti" + mysqli_error($conn));';
    echo 'window.location.href = "/nicola/Questionario/questionario_crea_form.php";';
    echo '</script>';
}
?>