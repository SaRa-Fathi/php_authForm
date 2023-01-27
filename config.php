<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname ='formlogin';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass ,$dbname);
if(! $connect ) {
die('Could not connect: ' . mysqli_connect_error());
}
?>