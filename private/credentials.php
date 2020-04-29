<?php
// ESTABLISHES THE BASIC CONNECTIONS. CONNECTION1 IS THE LEGACY DB
// PROVIDED BY THE PROFESSOR, CONNECTION 2 IS SUPPOSED TO BE THE 
// CART DB TO POST AND PULL ITEMS ADDED TO THE CART

// CONNECTION 2 DOESN'T WORK ANYMORE, NEED TO CONNECT TO THE NEW DATABASES
$dbhost2 = 'localhost';
$dbuser2 = 'root';
$dbpass2 = '';
$dbname2 = 'mysql';

$dbhost1 = 'er7lx9km02rjyf3n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$dbuser1 = 'rs0czd6o8w8e8r3j';
$dbpass1 = 'w1ffboir25orrcs4';
$dbname1 = 'b25oudnru9u3blk4';

$connection1 = mysqli_connect($dbhost1, $dbuser1, $dbpass1, $dbname1)
OR die("connection1 to mysql failed " .
mysqli_connect_error());

$connection2 = mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2)
OR die("connection2 to mysql failed " .
mysqli_connect_error());

?>