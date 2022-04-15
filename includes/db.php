<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "cms";


$connection = mysqli_connect($host, $username, $password, $dbName);

if (!$connection) {
    echo "Banco NÃO conectado";
} else {
    // echo "Banco conectado";
}
