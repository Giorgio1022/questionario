<?php
//$_SESSION[]
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stili.css">
    <style>
body {
    background: linear-gradient(to bottom right, #26438c, #7D05FF);
    background-repeat: no-repeat;
    background-attachment: fixed;
}

table {
	border-collapse: collapse;
	width: 50%;
	margin: auto;
    padding 5px;
}

th:first-child {
	border-top-left-radius: 6px;
}

th:last-child {
	border-top-right-radius: 6px;
}

th, td {
    border: 0;
	text-align: center;
	padding: 10px;
}

tr:nth-child(even) {
	background-color: #f2f2f2;    
}
tr:nth-child(odd) {
	background-color: white;
}
th {
	background-color: #162650;
	color: white;
    font-family: 'Roboto', sans-serif;
}

td {
	border: 1px solid black;
    font-family: "Roboto", helvetica, arial, sans-serif;
}

tr:hover td {
	background-color: #0099e6;
    color: white;
}

    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Materia</th>
        </tr>
<?php
require "lib/connessione.php";

$query = "SELECT * FROM questionari";
$ris = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($ris)) {
    echo "<tr>";
    echo "<td>" . $row["ID"] . "</td>";
    echo "<td><a href='questionario_svolgi_form.php?id=". $row["ID"] ."'>".$row["Nome"] . "</a></td>";
    echo "<td>" . $row["FK_Materia"] . "</td>";
    echo "</tr>";
}
mysqli_close($conn);


?>
   </table>
</body>
</html>