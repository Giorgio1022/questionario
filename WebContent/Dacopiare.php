<html>
<head>
  <!-- css della pagina con colori e relative animazioni -->
<meta name="utente" content="width=device-width, initial-scale=1">
<style>
.button {
  border-radius: 4px;
  background-color: deepskyblue;
  border: none;
  color: black;
  text-align: center;
  font-size: 25px;
  padding: 15px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
<title> Utenti </title>  
<body> 
    <img src="https://www.w3schools.com/images/w3schools_green.jpg">
     <!-- apro un form con metodo post che possa permettere di passare i dati tra pagine inserisco dei paragrafi -->
  
<form action="domanda_inserisci_azione.php" method="post">
<h1 align=center style="color: chocolate">QUESTIONARIO</h1>
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
    <p align=center><textarea name="risposta1"></textarea> <input name="punteggio1" type="text" size='1'></p> <br>
    <p align=center> <textarea name="risposta2"></textarea> <input name="punteggio2" type="text" size='1'></p> <br>
    <p align=center><textarea name="risposta3"></textarea> <input name="punteggio3" type="text" size='1'></p> <br>
    <p align=center><textarea name="risposta4"></textarea> <input name="punteggio4" type="text" size='1'></p> <br>
    <!-- inserico un bottone che permetta di inviare i dati ad una pagina per l’inserimento -->
<p align=center><button class="button"><span> Inserisci i dati </span></button></p> 
    <br>
    <br>
     <p>Per inserire una domanda con tanto di risposte scegliere la materia attraverso la listbox e scrivere al suo fianco la domanda, nelle textarea inserire le risposte e al suo fianco inserire il valore della risposta. Se la risposta è falsa allora inserire 0 altrimenti un numero superiore anche costituito da virgole che devono essere sostituite da un punto. </p>
</form>
</body>
</html>








