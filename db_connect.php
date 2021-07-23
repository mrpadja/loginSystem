<?php

//CONNECTION TO DATABASE
$servername ="localhost";
$username = "root";
$password ="";
$db_name ="loginsystem";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(mysqli_connect_error()){
    echo"Connection failed: ".mysqli_connect_error();
}