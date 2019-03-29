<?php	
    require "lib/connessione.php";
    controllaAccesso(3);
?>        
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Index</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stili.css">
    <script type="text/javascript">
    function esegui(){
        // devo leggere l'id del questionario da svolgere
        var ID = document.getElementById('ID').value;
        // carico la pagina del questionario
        window.location.href = 'questionario_svolgi_form.php?id=' + ID;
    }
    </script>
</head>
    <body>
         <header>
            <div><img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone"></div>
            <h1>Questionario</h1>
            <div><a  href='logout.php'><img id="esci" src="immagini/logout.png"/></a></div>
        </header>
    
<?php  if($_SESSION['livello']>3){ 
    // ingresso come docente 
?>
        <table border="0" align="center"> 
            <tr>
                <th>Crea Questionario</th>
                <th>Cerca Questionario</th>
                <th>Inserisci Domande</th>
                <th>Inserisci Materia</th>
				<th>Aggiungi Utente</th>
            </tr>
            <tr>
                <td> <a href="questionario_crea_form.php"> <img src="immagini/questionario.jpg" style="height:100px;"> </a></td>
                <td> <a href="questionario_elenco.php"> <img src="immagini/elenco.png" style="height:100px;"> </a></td>
                <td> <a href="domanda_inserisci_form.php"> <img src="immagini/domande.png" style="height:110px;"> </a></td>
                <td> <a href="materia_inserisci_form.php"> <img src="immagini/materia.jpg" style="height:100px;"> </a></td>
                <td> <a href="utente_form.php"> <img src="immagini/utente.png" style="height:100px;"> </a></td>
            </tr>          
        </table>
<?php } else { 
    // ingresso come studente    
?>
        <table border="0" align="center"> 
            <tr>
                <th>Svolgi Questionario<br><input type="text" width="1em" id="ID" placeholder="Inserisci l'ID del questionario"></th>
            </tr>
            <tr>
                <td><img onclick="esegui();" src="questionario.jpg" style="width:100px;height:100px;"></td>
            </tr>          
        </table>
          
<?php } ?>
</body>
</html>
