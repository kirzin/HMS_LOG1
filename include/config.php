<?php
$localhost = 'localhost';
$dbroot = 'root';
$dbpass = '';
$dbname = 'hms_logistics1';

$con = new mysqli($localhost, $dbroot, $dbpass, $dbname);

if(!$con)
{
    die(mysqli_error($con));
}
?>