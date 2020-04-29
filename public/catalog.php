<?php require_once("../private/credentials.php") ?>
<?php
// THE PAGE WHERE THE LEGACY DB IS BEING PULLED AND PEOPLE CAN SELECT WHAT
// ITEM TO PURCHASE 
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
    <link rel="stylesheet" href="../CSS/CatalogB.css">
    <div id="Body-outer">
    <div id="infoBanner"></div>
    <div id="infoBox1">ACCOUNT INFO</div>
    <div id="infoBox2">LINKS TO OTHER PAGES</div>

<?php

//PULLING FROM THE LEGACY DB
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
    //DISPLAYING ALL OF THE CONTENTS FROM THE LEGACY DB
    echo '<div id="item"> <div id="image">' .
    "<img src={$link} width='150px' height='150px'> </div>" .
    "<div id='desc'>{$des}</div>" .
    "<div id='number'>Item #: <br></br>{$number}</div>" .
    "<div id='weight'>Weight {lbs}: <br></br>{$weight}</div>" .
    "<select id='amount' name='Amount'>" .
    "<option value='0'>0</option>" .
    "<option value='1'>1</option>" .
    "<option value='2'>2</option>" .
    "<option value='3'>3</option>" .
    "<option value='4'>4</option>" .
    "<option value='5'>5</option>" .
    "<option value='6'>6</option>" .
    "<option value='7'>7</option>" .
    "<option value='8'>8</option>" .
    "<option value='9'>9</option>" .
    "<option value='10'>10</option>" .
    "</select>" .
    "<div id='price'>Online Price: <br></br>$ {$price} <button type= 'submit' id='subbuy' onclick='postit()'>Add to Cart</button></div> </div>";
}
}else {
echo 'database query1 failed';
echo mysqli_error($connection1);
}



mysqli_close($connection2);
mysqli_close($connection1);
?>

</body>
</html>