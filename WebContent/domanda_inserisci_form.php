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
    
header{
    display: grid;grid-template-columns: 1fr 4fr 1fr
}
header img{
    height: 5em;
    }
header > :first-child{
    text-align: left;
    }
header > :nth-child(2){
    text-align: center;
    font-size: 2.5em;
    }
header > :last-child{
    text-align: right;
    }
    table, th, td{
        margin-top: 1em;
        margin-bottom: 1em;
        text-align: center;
    }
</style>
</head>
<title> Utenti </title>  
<body> 
     <!-- apro un form con metodo post che possa permettere di passare i dati tra pagine inserisco dei paragrafi -->
 <header>
     <div><img id="iis" src="logoiis.png"></div>
     <div style="color: chocolate;"><b>Inserimento Domande</b></div>
     <a  href='index.php' ><img id="esci" src="logout.png"/></a>
</header>
<form action="domanda_inserisci_azione.php" method="post">
<p align=center> <span style="padding-left:1em"> Materia </span><span style="padding-left:5em"> Domanda </span></p>
<!-- stabilisco la connessione con il server -->
<p align=center> <?php
$servername = "192.168.1.25";
$username = "tpsit";
$password = "tpsit";
$db = "questionario";
    
$conn = mysqli_connect($servername, $username, $password, $db);
    
//verifico se la connessione è stata stabilita o meno
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//comando sql per la selezione del nome all’interno della tabella materia
$sql = "SELECT `Nome` FROM `materia`";
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
<p align=center><button class="button"><span> Inserisci i dati </span></button></p> 
</form>
</body>
</html>








