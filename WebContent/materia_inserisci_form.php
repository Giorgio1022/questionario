<html>
<head>
<meta name="utente" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stili.css">
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
  padding-right: 25px;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  opacity: 0;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
}

</style>
</head>
<title> Inserimento materia </title>  
<body> 
  <header>
    <div><img id="iis" src="logoiis.png"></div>
    <h1>Inserisci materia</h1>
    <div><a  href='index.php'><img id="esci" src="logout.png"/></a></div>
  </header>
   
  <form action="materia_inserisci_azione.php" method="post">
      <p> <input name="materia" type="text"></p>
      <p><button class="button"><span> Inserisci i dati </span></button></p> 
  </form>
</body>
</html>



