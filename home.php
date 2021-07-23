<?php

require_once'db_connect.php';

// SESSION
session_start();

// VERIFICATION

if (!isset($_SESSION['logedIn']) && $_SESSION['logedIn'] != true){
    header('Location: index.php');
}



// DATAS
$id = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id ='$id'";
$resultado = mysqli_query($connect, $sql);
$datas = mysqli_fetch_array($resultado);
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>HELLO <?php echo $datas['name'];?></h2>
    <a href="logout.php">close</a>
</body>
</html>