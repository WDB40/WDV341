<?php

$productName = "";
$productPrice = "";
$productColor = "";

$productNameError = "";
$productPriceError = "";
$productColorError  = "";

if(isset($_POST['prodSubmit'])){

    include "selfPostValidation/validationsAdvanced.php";

    $validInput = true;

    $productName = $_POST["prodName"];
    $productPrice = $_POST["prodPrice"];
    $productColor = $_POST["prodColor"];

    if(!validateProdName($productName)){
        $validInput = false;
        $productNameError = "Invalid name.";
    }

    if(!validateProdPrice($productPrice)){
        $validInput = false;
        $productPriceError = "Invalid price.";
    }

    if(!validateProdColor($productColor)) {
        $validInput = false;
        $productColorError = "Please select a color.";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<header>
    <h1>WDV341 Intro PHP </h1>
    <h2>Unit-8 Self Posting Form</h2>
</header>

<main>
    <section>
        <h3>Example Form</h3>
        <p>Converting a form to a self posting form.</p>
    </section>

    <section>
        <form name="form1" method="post" action="selfPostExample.php">
            <p>
                <label for="prodName">
                    Product Name:
                    <input type="text" name="prodName" id="prodName" value="<?php echo $productName?>">
                    <span><?php echo $productNameError ?></span>
                </label>
            </p>

            <p>
                <label for="prodPrice">
                    Product Price:
                    <input type="text" name="prodPrice" id="prodPrice" value="<?php echo $productPrice ?>">
                    <span><?php echo $productPriceError ?></span>
                </label>
            </p>

            <p>Product Color:</p>
            <span><?php echo $productColorError ?></span>
            <p>
                <label for="prod_red">
                    <input type="radio" name="prodColor" id="prod_red" value="prod_red" <?php if (isset($productColor) && $productColor=="prod_red"){echo "checked='checked'";} ?>>
                    Red Wagon<br>
                </label>

                <label for="prod_green">
                    <input type="radio" name="prodColor" id="prod_green" value="prod_green" <?php if (isset($productColor) && $productColor=="prod_green"){echo "checked='checked'";} ?>>
                    Green Wagon
                </label>
            </p>

            <p>
                <input type="submit" name="prodSubmit" id="prod_submit" value="Submit">
                <input type="reset" name="Reset" id="button" value="Reset">
            </p>
        </form>
    </section>
</main>
</body>
</html>