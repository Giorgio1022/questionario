<html>
<head>
<meta name="utente" content="width=device-width, initial-scale=1">
<style>
    html{
   background: linear-gradient(to bottom right, black, #4000ff,#c4e6d9);
}
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
    
   <div style='text-align: left;'><a href='index.php'><img src="logout.png"/></a></div>
<form action="materia_inserisci_azione.php" method="post">
<h1 align=center style="color: chocolate">Inserisci Materia</h1>
     <p align=center> <input name="materia" type="text"></p>
<p align=center><button class="button"><span> Inserisci i dati </span></button></p> 
</form>
</body>
</html>



