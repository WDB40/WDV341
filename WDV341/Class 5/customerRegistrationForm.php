<?php

include ("Validator.php");

$validator = new Validator();

$customerName = "";
$customerPhone = "";
$customerEmail = "";
$registration = "";
$badgeHolderType = "";
$specialRequirements = "";

if(isset($_POST['submitButton']) && $_POST['customerAddress'] == ""){

    $customerName = $_POST["customerName"];
    $customerPhone = $_POST["customerPhone"];
    $customerEmail = $_POST["customerEmail"];
    $registration = $_POST["customerType"];
    $specialRequirements = $_POST["specialRequirements"];

    if(isset($_POST["badgeHolderType"])) {
        $badgeHolderType = $_POST["badgeHolderType"];
    }

    if(isset($_POST["fridayDinner"])) {
        $fridayDinner = $_POST["fridayDinner"];
    }

    if(isset($_POST["saturdayDinner"])) {
        $saturdayDinner = $_POST["saturdayDinner"];
    }

    if(isset($_POST["sundayBrunch"])) {
        $sundayBrunch = $_POST["sundayBrunch"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP - Self Posting Form</title>

    <style>
        #orderArea	{
            width:600px;
            border:thin solid black;
            margin: auto auto;
            padding-left: 20px;
        }

        #orderArea h3	{
            text-align:center;
        }

        .error	{
            color:red;
            font-style:italic;
        }
    </style>
</head>

<body onload="setForm()">

<header>
    <h1>WDV341 Intro PHP</h1>
    <h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment
</header>

<main>
    <div id="orderArea">
        <form name="customerRegistration" method="post" action="customerRegistrationForm.php">
            <h3>Customer Registration Form</h3>

            <p id="customerNameLine">
                <label for="customerName">Name:</label>
                <input type="text" name="customerName" id="customerName" value="<?php echo $customerName?>">
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && !$validator->validateName($customerName)){
                       echo "Invalid name.";
                    }
                    ?>
                </span>
            </p>

            <p id="customerPhoneLine">
                <label for="customerPhone">Phone Number:</label>
                <input type="text" name="customerPhone" id="customerPhone" value="<?php echo $customerPhone?>">
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && !$validator->validatePhoneNumber($customerPhone)){
                        echo "Invalid phone number.";
                    }
                    ?>
                </span>
            </p>

            <p id="customerEmailLine">
                <label for="customerEmail">Email Address: </label>
                <input type="text" name="customerEmail" id="customerEmail" value="<?php echo $customerEmail?>">
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && !$validator->validateEmail($customerEmail)){
                        echo "Invalid email.";
                    }
                    ?>
                </span>
            </p>

            <p id="customerAddressLine">
                <label for="customerAddress">Customer Address:</label>
                <input type="text" name="customerAddress" id="customerAddress">
            </p>

            <p>
                <label for="customerType">Registration: </label>
                <select name="customerType" id="customerType">
                    <option value="">Choose Type</option>
                    <option value="attendee" <?php if(isset($registration) && $registration=="attendee"){echo "selected = 'selected'";} ?>>Attendee</option>
                    <option value="presenter" <?php if(isset($registration) && $registration=="presenter"){echo "selected = 'selected'";} ?>>Presenter</option>
                    <option value="volunteer" <?php if(isset($registration) && $registration=="volunteer"){echo "selected = 'selected'";} ?>>Volunteer</option>
                    <option value="guest" <?php if(isset($registration) && $registration=="guest"){echo "selected = 'selected'";} ?>>Guest</option>
                </select>
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && !$validator->validateRegistration($registration)){
                        echo "Please select a registration type.";
                    }
                    ?>
                </span>
            </p>

            <p>
                Badge Holder:
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && !$validator->validateBadgeHolder($badgeHolderType)){
                        echo "Please select a badge holder type.";
                    }
                    ?>
                </span>
            </p>
            <p>
                <input type="radio" name="badgeHolderType" id="clip" value="clip" <?php if(isset($badgeHolderType) && $badgeHolderType=="clip"){echo "checked = 'checked'";} ?>>
                <label for="clip">Clip</label> <br>

                <input type="radio" name="badgeHolderType" id="lanyard" value="lanyard" <?php if(isset($badgeHolderType) && $badgeHolderType=="lanyard"){echo "checked = 'checked'";} ?>>
                <label for="lanyard">Lanyard</label> <br>

                <input type="radio" name="badgeHolderType" id="magnet" value="magnet" <?php if(isset($badgeHolderType) && $badgeHolderType=="magnet"){echo "checked = 'checked'";} ?>>
                <label for="magnet">Magnet</label>
            </p>

            <p>
                Provided Meals (Select all that apply):
                <span class="error">
                    <?php
                    if(isset($_POST['submitButton']) && (!isset($fridayDinner) && !isset($saturdayDinner) && !isset($sundayBrunch))){
                        echo "Please select at least one meal.";
                    }
                    ?>
                </span>
            </p>
            <p>
                <input type="checkbox" name="fridayDinner" id="fridayDinner" <?php if(isset($fridayDinner)){echo "checked = 'checked'";} ?>>
                <label for="fridayDinner">Friday Dinner</label><br>

                <input type="checkbox" name="saturdayDinner" id="saturdayDinner" <?php if(isset($saturdayDinner)){echo "checked = 'checked'";} ?>>
                <label for="saturdayDinner">Saturday Lunch</label><br>

                <input type="checkbox" name="sundayBrunch" id="sundayBrunch" <?php if(isset($sundayBrunch)){echo "checked = 'checked'";} ?>>
                <label for="sundayBrunch">Sunday Award Brunch</label>
            </p>

            <p>
                <label for="specialRequirements">Special Requests/Requirements: (Limit 200 characters)<br>
                <textarea name="specialRequirements" cols="40" rows="5" id="specialRequirements"><?php echo $specialRequirements?></textarea>
                </label>
            </p>
            <span class="error">
                <?php
                if(isset($_POST['submitButton']) && !$validator->validateSpecialRequest($specialRequirements)){
                    echo "Invalid special request.";
                }
                ?>
            </span>

            <p>
                <input type="submit" name="submitButton" id="submitButton" value="Submit">
            </p>
        </form>
    </div>
</main>
</body>

<script>

    function setForm(){
        document.getElementById("customerAddressLine").style.display = "none";
    }

</script>

</html>