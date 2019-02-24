<?php
session_start();
if(!isset($_SESSION['Livello'])){
    header('location: index.php');
}
else{
    if($_SESSION['Livello'] == 1){
    $x = $_POST["Nome"];
    $y = md5($_POST["Password"]);
    $z = $_POST["Livello"];
    require "lib/connessione.php";
	
	$sql = "INSERT INTO utenti (Username, Password, Livello) VALUES ('$x','$y','$z')";
		
		if (mysqli_query($conn,$sql)){
			echo "<br/>"; 
			echo "Dati Inseriti";
              header('location: index.php');
		} else {
			echo "Error: " .$sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
    }
    else{
        header('location: index.php');
    }
}
?>