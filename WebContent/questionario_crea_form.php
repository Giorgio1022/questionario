<?php
require "lib/connessione.php";
controllaAccesso(3);
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Creazione del Questionario</title>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="stili.css">
        <style>
            #finestra{
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 10px;
            }
            #divDomanda{
                background-color: skyblue;
                padding: 10px;
                grid-column: 1 / 2;
                grid-row: 1 / 4;
            }
            #divVisualizza{
                background-color: limegreen;
                padding: 10px;
                grid-column: 2 / 3;
                grid-row: 1 / 4;
            }
            #daNascondere{
                display: none;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
            <h1>Creazione Questionario</h1>
            <a href="index.php"><img src="immagini/home.png"/></a>
        </header>
        <div id = "finestra">     
            <div id = "divDomanda">
                <h3>Ricerca Testo Domande e/o Materia</h3>
                <p>Materia:

                <?php
                    /* nel php si estraggono dal server le materie 
                    e vengono messe all'interno del menu a tendina (combobox)*/
                    $conn = connessione();
                    $sql = "SELECT `Nome` FROM `materie`";
                  
                    $result = mysqli_query($conn, $sql);
                    echo"<select name = 'materia' id = 'materia' style='width:100px'>";
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo " <option value=".$row['Nome']." name = 'materia'>".$row['Nome']."</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    echo"</select>";
                ?>

    </p>
                <p>Domanda: <input type = "text" name = "q" id = "testoD"></p>   
                 <!-- TextField apposita dove si inserisce la parola chiave da cercare-->
                <input type = "button" onclick = "cercaDomanda()" value = "cerca">
                <!-- L'input cerca una volta fornita una parola chiave della domanda nell'apposita textfield
                effettua una ricerca e fornisce tutte le domande che contengono la parola chiave-->
                <div id = "domanda"></div>
            </div>
            <br>
            <div id = "divVisualizza">
                <h3>Creazione del Questionario</h3>
                <input type = "button" value = "cancella" onclick = "reset()">
                <form action="questionario_crea_azione.php" method = "post">
                    <span id = "visualizzaM" name = "materiaQ"></span>
                    <p>Nome Questionario:</p><input type = "text" value = "" name = "nomequestionario">
                    <input type = "submit" value = "inserisci"><br>
                    <div id = "visualizza"></div>
                </form>
            </div>
        </div>
        
        <script>
            var httpRequest;
            var oggetto = [];
            var risposte = [];
            //Stato Cambiato
            function statoCambiato(){
                var riga = "";
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    var nRisp = 0;
                    oggetto = JSON.parse(httpRequest.responseText);
                    riga = "<table>";
                    for(var i = 0; i < oggetto.length; i++){
                        var id = oggetto[i].Posizione_domanda;
                        riga = riga + 
                            "<tr>" + 
                            "<td><input type = checkbox id = 'domanda" + id +"' value ="+ id +" onclick = 'aggiungiDomanda("+ id +")'></td>" + 
                            "<td><p id = " + id +">" + oggetto[i].Domanda + "</p><td>" +
                            "</tr>";
                        for(var j = 0; j < oggetto[i].Risposte.length; j++){
                            risposte[nRisp] = new Array(2);
                            risposte[nRisp][0] = oggetto[i].Risposte[j].Risposta;
                            risposte[nRisp][1] = oggetto[i].Posizione_domanda;
                            nRisp++;
                        }
                    }
                    riga = riga + "</table>"; 
                    document.getElementById("domanda").innerHTML = riga;
                    nRisp = 0;
                 }
            }
            //Cerca Domanda
            function cercaDomanda(){
                httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = statoCambiato;
                httpRequest.open('GET', 'domanda_cerca.php?materia=' + document.getElementById("materia").value + '&q=' + document.getElementById("testoD").value);
                httpRequest.setRequestHeader( 'Cache-Control', 'no-cache');
                httpRequest.send();
                document.getElementById("visualizzaM").innerHTML = "<input id='daNascondere' type = 'text' name = 'materiaQuestionario' value = " + document.getElementById("materia").value + ">";
            }
            //Aggiungi Domanda
            var domande = []; 
            function aggiungiDomanda(domanda){
                var testoDomanda = "";
                var stato = document.getElementById("domanda" + domanda).checked;
                var testo = "<p><input type = 'hidden' value = " + domanda + " name = idD_" + domanda + ">" + document.getElementById(domanda).innerHTML + "</p>";
                /*
                scorro tutte le domande e prendo solo quelle che corrispondono
                all'ID della domanda che viene passato.
                */
                for(var r = 0; r < risposte.length; r++){
                    if(risposte[r][1] == domanda){
                        testo = testo +
                            "<ul>" +
                                "<li>" + risposte[r][0] + "</li>" +
                            "</ul>";
                    }
                }
                /*
                Se la domanda è stata spuntata, viene aggiunta nell'array
                altrimenti viene tolta, se è presente.
                */
                if(stato) {
                    domande.push(testo);
                } else {
                    for(var i = 0; i < domande.length; i++){
                        if(domande[i] == testo){
                             domande.splice(i, 1);
                        }
                    }
                }
                /*
                Le domande vengono riscritte in una stringa e successivamente
                visualizzate in un div.
                */
                for(var i = 0; i < domande.length; i++){
                    testoDomanda = testoDomanda + domande[i] + "<br>";
                }
                
                document.getElementById("visualizza").innerHTML = testoDomanda;
            }
            
            function reset(){
                domande.length = 0;
                testoDomanda = "";
                document.getElementById("visualizza").innerHTML = testoDomanda;
            }
        </script>
    </body>
</html>
                