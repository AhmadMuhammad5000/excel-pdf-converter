<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'fileconverter';

$conn = new mysqli($host,$user,$password,$db) or die("mysqli failed to connect ".mysqli_error());
