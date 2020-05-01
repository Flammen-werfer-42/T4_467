<?php require_once("../private/credentials.php") ?>
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
    <link rel="stylesheet" href="../CSS/CatalogB.css">
    <div id="Body-outer">
    <div id="infoBanner"></div>
    <div id="infoBox1">
        <div id='acct'></div>
        <div id='acctText'>Username: <br>Goddard <br></br>e-mail address:</br> N/A <br></br>Phone: </br>N/A</div>
    </div>
    
<div id="infoBox2">
    <div id='link1'>Store Locator</div>
    <div id='link2'>Daily Deals</div>
    <div id='link3'>View the Catalog</div>
    <div id='link4'>Terms and Services</div>
</div>

<?php

$query = "SELECT * from parts";
$response = @mysqli_query($connection1, $query);
if($response) {

while($row = mysqli_fetch_array($response)) {
    global $number;
    global $des;
    global $price;
    global $link;
    global $amt;
    $number = $row['number'];
    $des = $row['description'];
    $price = $row['price'];
    $weight = $row['weight'];
    $link = $row['pictureURL'];

    //the special sauce
    echo '<div id="item"> <div id="image">' .
    "<img src={$link} width='150px' height='150px'> </div>" .
    "<div id='desc'>{$des}</div>" .
    "<div id='number'>Item #: <br></br>{$number}</div>" .
    "<div id='weight'>Weight {lbs}: <br></br>{$weight}</div>" .
    "<div id='price'>Online Price: <br></br>$ {$price} </div> </div>";    
}
}else {
echo 'database query1 failed';
echo mysqli_error($connection1);
}
?>
<form method='POST'>
<div id='buybox'>
<input type='text' id='numtext' name='cartNum' placeholder='Enter # of item to buy'>
<div id='amttext'>Enter Amount to Buy: </div>
<select id='amount' name='Amount'>
<option value='0'>0</option>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select> <button type='submit' id='rsub' name='submit'>Add to Cart</button>
</div>
</form>

<?php
    if(isset( $_REQUEST['submit'] ))
{
    $numBuy = $_REQUEST['cartNum'];
    $amtBuy = $_REQUEST['Amount'];
    $query9 = "select * from parts where number ='$numBuy';";  
    $respe = @mysqli_query($connection1, $query9);
    $row2 = mysqli_fetch_array($respe);

    $nu = $row2['number'];
    $de = $row2['description'];
    $pr = $row2['price'];
    $li = $row2['pictureURL'];
    $query11 = "insert into 467Test (Number, Description, Price, Picture, bought) VALUES ('$nu','$de','$pr','$li','$amtBuy');";
    @mysqli_query($connection2,$query11);
}

?>


<?php
mysqli_close($connection2);
mysqli_close($connection1);
?>

</body>
</html>