<?php

$host="localhost";
$user="root";
$password="";
$db="capstone";

$con=mysqli_connect($host,$user,$password,$db);
if($con===false){
    die("connection error");
}

?>