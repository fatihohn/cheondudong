<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$conn = mysqli_connect(
    $servername, $username, $password, $dbname
);
if(!conn):
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
endif;
?>