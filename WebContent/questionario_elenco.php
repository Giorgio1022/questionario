<?php
    require "lib/connessione.php";
    controllaAccesso(3);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Questionari</title>
    <link rel="stylesheet" href="stili.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #26438c, #7D05FF);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        p{
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
        <h1>Questionari</h1>
        <a href="index.php"><img src="immagini/home.png"/></a>
    </header>

    <form action="questionario_elenco.php" method="GET">
    <p>
    Ricerca Questionari:
<?php
$conn = connessione();

$sql = "SELECT DISTINCT FK_Materia FROM questionari";
$result = mysqli_query($conn, $sql);
echo '<input list="materie" name="materia">';
echo '<datalist id="materie">';
while ($r = mysqli_fetch_assoc($result)) {
echo '<option value="'.$r['FK_Materia'].'">'.$r['FK_Materia'].'</option>'; 
}
echo '</datalist>';

mysqli_close($conn);
?>

<input type="submit" value="cerca"> 
</form>
</p>


<?php
if(isset($_GET['materia'])){  
$conn = connessione();
$materia = $_GET['materia'];
if($materia!=""){
    $query = "SELECT DISTINCT * FROM questionari WHERE FK_Materia='$materia'";
}else{
    $query = "SELECT DISTINCT * FROM questionari";
}
$ris = mysqli_query($conn, $query);
echo '<table class="righe">';
echo '<tr>';
echo    '<th>ID</th>';
echo    '<th>Nome</th>';
echo    '<th>Materia</th>';
echo '</tr>';
while ($row = mysqli_fetch_assoc($ris)) {
    echo "<tr>";
    echo "<td>" . $row["ID"] . "</td>";
    echo "<td><a href='questionario_svolgi_form.php?id=". $row["ID"] ."'>".$row["Nome"] . "</a></td>";
    echo "<td>" . $row["FK_Materia"] . "</td>";
    echo "</tr>\n";
}
mysqli_close($conn);
}

?>
   </table>
</body>
</html>