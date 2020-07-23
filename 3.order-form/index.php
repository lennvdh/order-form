<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
if(isset($_GET['food']) && (int)$_GET['food'] === 0){
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}
function totalPrice(array $products):string{
    $totalValue = 0;
    if(isset($_COOKIE['totalValue'])){
        $totalValue = (float)$_COOKIE['totalValue'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            foreach($_POST['products'] as $i => $product) {
                $totalValue += (float)$products[$i]['price'];
            }
            if(!empty($_POST['express_delivery'])){
                $totalValue += (float)$_POST['express_delivery'];
            }
            setcookie('totalValue', (string)$totalValue, time() + 86400);
    }
    return number_format($totalValue, 2);
}

require 'form-view.php';
//require 'mail.php';
?>