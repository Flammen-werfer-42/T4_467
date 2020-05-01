<?php require_once("../private/credentials.php");
try {
    $user = "z1813781"; // holds my username
    $db = "z1813781";
    $pw = "1999May25"; // pw for sql server
    $dsn = "mysql:host=courses;dbname=".$db; // holds db name
    $pdo = new PDO($dsn, $user, $pw); // creates db obj
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOexception $e) { // handle exception
    echo "Connection failed: " . $e->getMessage();
}
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
    <div id="infoBox1"></div>
    <div id="infoBox2"></div>

    <div id="orderTitle">Address and Shipping</div>
<div id="subTitles">Name: <br><br> E-mail: <br><br><br> State: <br><br><br><br> Street Address: <br><br>City: <br><br> Zip Code:</div>
<div id="custCard">Credit Card: <br><br> Card Expiration:</div>

<form id="custOrder" method="POST">
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
<br><br><br><br><br><br><br>
<input type="text" name="cardnum" placeholder="0000-0000-0000-0000">
<br>
<input type="text" name="exp" placeholder="00/0000">
<button type="submit" name="submit">Submit</button>
</form>

<?php
if(isset( $_REQUEST['submit'] ))
{
    $numb = $_REQUEST['Name'];
    $em = $_REQUEST['email'];
    $ad = $_REQUEST['Address'];
    $cit = $_REQUEST['City'];
    $st = $_REQUEST['State'];
    $zi = $_REQUEST['Zip'];
    $num = $_REQUEST['cardnum'];
    $exp = $_REQUEST['exp'];

    $sql6 = "insert into aform (name, email) values ('$numb', '$em');";
    $sql7 = "insert into address (addr, city, st, zip) values ('$ad', '$cit', '$st', '$zi');";
    mysqli_query($connection2, $sql7);
    mysqli_query($connection2, $sql6);
}
?>

<?php
$query = "SELECT * from 467Test";
$response = @mysqli_query($connection2, $query);
if($response) {

while($row = mysqli_fetch_array($response)) {
    global $number;
    global $des;
    global $price;
    global $link;
    global $amt;
    global $bought;
    $number = $row['Number'];
    $des = $row['Description'];
    $price = $row['Price'];
    $link = $row['Picture'];
    $bought = $row['bought'];

    //the special sauce
    echo '<div id="item"> <div id="image">' .
    "<img src={$link} width='100px' height='100px'> </div>" .
    "<div id='desc'>{$des}</div>" .
    "<div id='number'>Item #: <br></br>{$number}</div>" .
    "<div id='price'>Online Price: <br></br>$ {$price} <br><br> Quantity: {$bought} </div> </div>";
}
}else {
echo 'database query2 failed';
echo mysqli_error($connection2);
}
?>

<?php
$querymult = "SELECT (Price * bought) AS mult from 467Test;";
$querycount = "SELECT COUNT(Number) as amt from 467Test;";
$resp3 = @mysqli_query($connection2, $querymult);
$resp4 = @mysqli_query($connection2, $querycount);

    while($many = mysqli_fetch_array($resp3)){
        $m = $many['mult'];
        global $tot;
        $tot = $tot + $m;
    }
    $amt = mysqli_fetch_array($resp4);
    $amt2 = $amt['amt'];
    echo "<div id='total'>YOUR TOTAL ORDER IS: $ {$tot} </div>";
    echo "<div id='itemTot'>TOTAL ITEMS IN CART: {$amt2} </div>";
?>


<?php 
$url = 'http://blitz.cs.niu.edu/CreditCard/';
$trans1 = rand(100,999);
$trans2 = rand(100000,999999);
$data = array(
	'vendor' => 'Team-4 Auto Parts',
	'trans' => "$trans1-$trans2-$trans1",
	'cc' => "{$num}",
	'name' => "{$numb}", 
	'exp' => "{$exp}", 
	'amount' => "{$tot}");

$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method' => 'POST',
        'content'=> json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if (strstr($result, "error")){
    echo "<div id='cardmsgbd'>INVALID CREDIT CARD INFO </div>";
}
else {
    header("Location: ../public/accept.php");
}

?>


<?php mysqli_close($connection2); ?>

</body>
</html>