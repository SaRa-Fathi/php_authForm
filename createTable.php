<?php
require_once 'config.php';

if(!$connect){
    echo "error";
}

echo "Connecting to database successfully :) <br>";

//CREATE TABLE
$sql = 'CREATE TABLE UserLogin(
    ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(50) UNIQUE NOT NULL,
    Passwd VARCHAR(50) NOT NULL
)';

$ret =mysqli_query($connect , $sql);

if(!$ret){
    echo "cannot create table";
}
echo "table created successfully :)<br>";
mysqli_close($connect);
?>