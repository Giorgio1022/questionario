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
    </style>
</head>
<body>
    <header>
        <img src="immagini/cassatagattapone.png" alt="logo iis Cassata Gattapone">
        <h1>Questionari</h1>
        <a href="index.php"><img src="immagini/home.png"/></a>
    </header>
    <table class="righe">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Materia</th>
        </tr>
<?php

$conn = connessione();

$query = "SELECT * FROM questionari";
$ris = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($ris)) {
    echo "<tr>";
    echo "<td>" . $row["ID"] . "</td>";
    echo "<td><a href='questionario_svolgi_form.php?id=". $row["ID"] ."'>".$row["Nome"] . "</a></td>";
    echo "<td>" . $row["FK_Materia"] . "</td>";
    echo "</tr>\n";
}
mysqli_close($conn);


?>
   </table>
</body>
</html>