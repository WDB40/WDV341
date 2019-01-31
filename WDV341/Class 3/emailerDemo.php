<?php

    include ("Emailer.php");

    $testEmail = new Emailer();

    $testEmail->setSenderAddress("wes@wdb40.com");
    $testEmail->setSendToAddress("wbrown1640@gmail.com");
    $testEmail->setSubjectLine("WDV341 - Class 3");
    $testEmail->setMessageBody("Example of using the Emailer class for WDV341.");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Object Demo</title>
</head>
<body>

    <h1>Copy of Email That Will Be Sent</h1>

    <p>From: <?php echo $testEmail->getSenderAddress(); ?></p>
    <p>To: <?php echo $testEmail->getSendToAddress(); ?></p>
    <p>Subject: <?php echo $testEmail->getSubjectLine(); ?></p>
    <p>Body: <?php echo $testEmail->getMessageBody(); ?></p>

    <p>
        <?php
        if($testEmail->sendEmail()){
            echo "The above message was properly sent!";
        } else {
            echo "The above message was not properly sent.";
        };
        ?>
    </p>

</body>
</html>