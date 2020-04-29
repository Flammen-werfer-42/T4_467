<?php
// DOESN'T ACTUALLY DO ANYTHING, ALL CONNECTIONS
// DONE THROUGH CREDENTIALS

//credentials
$dbhost = 'team2db.cwsq5gwylu5q.us-east-2.rds.amazonaws.com';
$dbuser = 'team2_evenDanial';
$dbpass = 'R810*&()';
$dbname = 'innodb';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// query
$query = "SELECT * FROM Parts";
$result_set = mysqli_query($connection, $query);
//use data
while($subject = mysqli_fetch_assoc($result_set)) {
    echo $subject["eventName"] . "<br />";
}
//release data
mysqli_free_result($result_set);
//close
mysqli_close($connection);
?>