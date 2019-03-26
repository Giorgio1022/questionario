<?php	
	session_start();
    if(!isset($_SESSION['utente'])){
        header('location: login_form.html');     
        exit(0);
	}
?>
        
<!DOCTYPE html>
<html>
<head>
    <title> Index </title>
    <meta char-set="UTF-8">
    <link rel="stylesheet" href="stili.css">
    <script type="text/javascript">
    function esegui(){
    var ID = document.getElementById('ID').value;
    window.location.href = 'questionario_svolgi_form.php?id=' + ID;
    }
    </script>
</head>
    <body>
         <header>
            <div><img id="iis" src="logoiis.png"></div>
            <h1>Questionario</h1>
            <div><a  href='logout.php'><img id="esci" src="logout.png"/></a></div>
        </header>
    
<?php  if($_SESSION['Livello']==1){ //Errore in questa riga ?>

        <table border="0" align="center"> 
            <tr>
                <th>Crea Questionario</th>
                <th>Elenco Questionario</th>
                <th>Inserisci Domande</th>
                <th>Inserisci Materia</th>
				<th>Aggiungi Utente</th>
            </tr>
            <tr>
                <td> <a href="questionario_crea_form.php"> <img src="questionario.jpg" style="width:100px;height:100px;"> </a></td>
                <td> <a href="questionario_elenco.php"> <img src="elenco.png" style="width:100px;height:100px;"> </a></td>
                <td> <a href="domanda_inserisci_form.php"> <img src="domande.jpg" style="width:145px;height:110px;"> </a></td>
                <td> <a href="materia_inserisci_form.php"> <img src="materia.jpg" style="width:110px;height:100px;"> </a></td>
                <td> <a href="utente_form.php"> <img src="utente.png" style="width:110px;height:100px;"> </a></td>
            </tr>          
        </table>
<?php } else {?>

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
