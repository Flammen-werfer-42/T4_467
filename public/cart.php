<?php require_once("../private/credentials.php")
// WHERE "PURCHASED" ITEMS ARE TAKEN TO AND DISPLAYED TO ENTER THE NAME, ADDRESS, AND 
// CREDIT CARD INFO
?>
<!doctype html>
     <html lang="en">

<head>
<link rel="stylesheet" href="../CSS/IndexH.css">

<div id="Header-outer">

    <a href="./index.php">
<div id="Icon">
    <img src="../images/WMxpNUZ.png" alt="icon" width="100" height="100">
</div>

<div id="Title">
    <h1>Team 4 Auto Parts</h1>
</div>
</a>
<div id="Title2">
    <p>LINKS TO PAGES | LOGIN SECTION |</p>
    <a href="./cart.php"> CART </a>
</div>
    

</div>
</head>
<body>
    <link rel="stylesheet" href="../CSS/CartB.css">
    <div id="Body-outer">
    <div id="infoBanner"></div>
<!-- THE 2 INFO BOXES ARE EMPTY FOR NOW, WILL TRY TO ADD PROFILE INFO / LINKS TO OTHER 
      PAGES FOR AESTETIC EFFECT -->
    <div id="infoBox1"></div>
    <div id="infoBox2"></div>

    <div id="orderTitle">Address and Shipping</div>
<div id="subTitles">Name: <br><br> E-mail: <br><br><br> State: <br><br><br><br> Street Address: <br><br>City: <br><br> Zip Code:</div>

<!-- THE FORM WHERE THE CUSTOMER WILL ENTER ALL OF THEIR PERSONAL INFO TO SHIP -->
<form id="custOrder">
<input type="text" name="Name" placeholder="Your Name">
<br>
<input type="text" name="email" placeholder="Your E-mail">
<br><br><br>
<select id="state" name="State">
<option value="N/A">State</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="WI">Wisconsin</option>
  <option value="MI">Michigan</option>
  <option value="IA">Iowa</option>
</select>
<br><br><br>
<input type="text" name="Address" placeholder="Your Street-Address">
<br>
<input type="text" name="City" placeholder="Your City">
<br>
<input type="text" name="Zip" placeholder="Your Zip">
<button type="submit" name="submit">Submit</button>
</form>

<?php
// POSTING THE ENTERED INFO INTO THE ORDER DB
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $state = $_POST['State'];
    $address = $_POST['Address'];
    $city = $_POST['City'];
    $zip = $_POST['Zip'];
?>
<?php

// MAKING THE QUERY PULLING THE CONTENTS OF THE CART 
$query = "SELECT * from 467Test";
$response = @mysqli_query($connection2, $query);
if($response) {

while($row = mysqli_fetch_array($response)) {
    global $number;
    global $des;
    global $price;
    global $link;
    global $amt;
    $number = $row['Number'];
    $des = $row['Description'];
    $price = $row['Price'];
    $link = $row['Picture'];

    //the special sauce
    // DISPLAYING THE PULLED CONTENTS
    echo '<div id="item"> <div id="image">' .
    "<img src={$link} width='100px' height='100px'> </div>" .
    "<div id='desc'>{$des}</div>" .
    "<div id='number'>Item #: <br></br>{$number}</div>" .
    "<div id='price'>Online Price: <br></br>$ {$price} </div> </div>";

}
}else {
echo 'database query2 failed';
echo mysqli_error($connection2);
}
?>

<?php
// PULLING THE TOTAL PRICE FROM THE DB
$queryPrc = "SELECT SUM(Price) AS value FROM 467Test;";

$response2 = @mysqli_query($connection2, $queryPrc); 
if($response2){
    $prc = mysqli_fetch_array($response2);
    $sum = $prc['value'];

    echo "<div id='total'>YOUR TOTAL ORDER IS: $ {$sum} </div>";
}

?>

<?php
// PULLING HOW MANY ITEMS IN THE CART
$queryAmt = "SELECT COUNT(Number) as value FROM 467Test;";

$response3 = @mysqli_query($connection2, $queryAmt); 
if($response3){
    $amt = mysqli_fetch_array($response3);

    $sum2 = $amt['value'];

    echo "<div id='itemTot'> TOTAL ITEMS IN CART: {$sum2} </div>" ;
}

?>

<?php
$trans = 
// THIS IS THE API CALL TO THE CREDIT CARD FORM THAT WILL ACCEPT AND PROCESS THE CARD INFO 
// (STILL WORKING ON)
$url = 'http://blitz.cs.niu.edu/CreditCard/';
$trans = rand(0,999999999);
$data = array(
	'vendor' => 'Team-4 Auto Parts',
	'trans' => "{$trans}",
	'cc' => "{payCard}",
	'name' => "{Name}", 
	'exp' => "{$payExp}", 
	'amount' => "{$sum}");

$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method' => 'POST',
        'content'=> json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo($result);
?>

<?php
mysqli_close($connection2);
?>

</body>
</html>