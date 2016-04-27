<?php
// error_reporting(0);
$connect_error = '<h2><b style="color: red;">Sorry for the Server Down Time... The Administrator will facilitate the website.</b></h2>';

$server = 'ap-cdbr-azure-southeast-b.cloudapp.net';
$username = 'b94ffec3b9a5b1';
$password = '35d53d72';
$database = 'dresscodeviolation';

// Connect to database.
try {
    $conn = new PDO( "mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}
?>
