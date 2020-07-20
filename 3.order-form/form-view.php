<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>

                <input type="text" id="email" name="email" class="form-control" value="
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['email'])){ 
                                $email = $_POST['email'];
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    echo("VALID ".$email);
                                }else{
                                    echo($email);
                                }
                            }
                        }
                    ?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="                
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['street'])){ 
                                $street = $_POST['street'];
                                if(empty($street)){
                                    echo($street);
                                }else{
                                    echo($street);
                                }
                            }
                        }
                        if(isset($_POST['street'])){
                            $_SESSION['street'] = $_POST['street'];
                        }
                        
                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="    
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['streetnumber'])){ 
                                $streetNumber = $_POST['streetnumber'];
                                if(is_numeric($streetNumber)){
                                    echo($streetNumber);
                                }else{
                                    echo($streetNumber);
                                }
                            }
                        }
                        if(isset($_POST['streetnumber'])){
                            $_SESSION['streetnumber'] = $_POST['streetnumber'];
                        }

                    ?>"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="                    
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['city'])){ 
                                $city = $_POST['city'];
                                if(empty($city)){
                                    echo($city);
                                }else{
                                    echo($city);
                                }
                            }
                        }
                        if(isset($_POST['city'])){
                            $_SESSION['city'] = $_POST['city'];
                        }

                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['zipcode'])){ 
                                $zipcode = $_POST['zipcode'];
                                if(is_numeric($zipcode)){
                                    echo($zipcode);
                                }else{
                                    echo($zipcode);
                                }
                            }
                        }
                        if(isset($_POST['zipcode'])){
                            $_SESSION['zipcode'] = $_POST['zipcode'];
                        }

                    ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
    <?php 
        $currentTime = date("G:i:s");
        $timeExpectedNormalDeliv = strtotime("+2 hours", strtotime($currentTime));
        $timeExpectedExpress = strtotime("+45 minutes", strtotime($currentTime));
        $endTimeExpressDelivery = date("G:i:s", $timeExpectedExpress);
        $endTime = date("G:i:s", $timeExpectedNormalDeliv);
        if(isset($_POST['express_delivery'])){
            echo("time expected of delivery ".$endTimeExpressDelivery);
        }elseif(isset($_POST['submit'])){
            echo("time expected of delivery ".$endTime);
        }
    ?>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
