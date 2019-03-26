<html>
<head>
  <!-- css della pagina con colori e relative animazioni -->
<meta name="utente" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stili.css">
</head>
<title> Utenti </title>  
<body> 
     <!-- apro un form con metodo post che possa permettere di passare i dati tra pagine inserisco dei paragrafi -->
 <header>
     <div><img id="iis" src="logoiis.png"></div>
     <h1>Inserimento Domande</h1>
     <a  href='index.php' ><img id="esci" src="logout.png"/></a>
</header>
<form action="domanda_inserisci_azione.php" method="post">
<p align=center> <span style="padding-left:1em"> Materia </span><span style="padding-left:5em"> Domanda </span></p>
<!-- stabilisco la connessione con il server -->
<p align=center> <?php
require "lib/connessione.php";

//comando sql per la selezione del nome all’interno della tabella materia
$sql = "SELECT `Nome` FROM `materie`";
$result = mysqli_query($conn, $sql);
//creo una listbox
 echo"<select name='listbox' style='width:100px'>";
//inserisco le materie all’interno della listbox
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
echo "<option value=".$row['Nome'].">".$row['Nome']."</option>";
    }
} else {
    echo "0 results";
}
echo"</select>";
//chiudo la connessione
mysqli_close($conn);
    ?>
         <!-- inserisco dei paragrafi e delle textbox -->
 <input name="Domanda" type="text"></p>
 <h1 align=center style="color: chocolate">Risposte</h1>
<table align=center>
    <tr>
        <td>Testo Risposta</td>
        <td>Punteggio</td>
    </tr>
    <tr>
        <td><textarea name="risposta1" type="text"></textarea></td>
        <td><input name="punteggio1" type="text" size='1'></td>
    </tr>
    <tr>
        <td><textarea name="risposta2" type="text"></textarea></td>
        <td><input name="punteggio2" type="text" size='1'></td>
    </tr>
    <tr>
        <td><textarea name="risposta3" type="text"></textarea></td>
        <td><input name="punteggio3" type="text" size='1'></td>
    </tr>
    <tr>
        <td><textarea name="risposta4" type="text"></textarea></td>
        <td><input name="punteggio4" type="text" size='1'></td>
    </tr>
</table>
    <!-- inserico un bottone che permetta di inviare i dati ad una pagina per l’inserimento -->
<p><button><span> Inserisci i dati </span></button></p> 
</form>
</body>
</html>








