<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hms_logistics1';

$conn= new mysqli($host,$user,$password,$database);

// Check connection
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>