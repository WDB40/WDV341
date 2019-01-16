<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Functions</title>

    <?php

    //Creating a date to use for 1 and 2
    //I used the date object and then got the timestamp before
    //sending it to the methods

    try {
        $today = new DateTime("now");
    } catch (Exception $exception){
        echo $exception->getMessage();
    }

    //Problem 1
    function formatAmericanDate($inDate){
        return date("m/d/Y", $inDate);
    }

    //Problem 2
    function formatInternationalDate($inDate){
        return date("d/m/Y", $inDate);
    }

    //Problem 3
    function stringFormatter($inString){
        //a.
        echo strlen($inString) . "<br>";

        //b.
        trim($inString);

        //c.
        echo strtolower($inString) . "<br>";

        //d.
        if(stripos($inString, "DMACC") == false){
            echo "Does not contain DMACC. <br>";
        } else {
            echo "Contains DMACC. <br>";
        }
    }

    //Problem 4
    function numberFormatter($inNumber){
        echo number_format($inNumber);
    }

    //Problem 5
    function currencyFormatter($inNumber){
//        setlocale(LC_MONETARY, "en_US");
//        echo money_format("%.2n", $inNumber);
        echo "$" . number_format($inNumber, 2);

    }

    ?>

</head>
<body>
<main>

    <!--Problem 1-->
    <section>
        <h3>Problem 1</h3>

        <?php
        echo formatAmericanDate($today->getTimestamp());
        ?>
    </section>

    <!--Problem 2-->
    <section>
        <h3>Problem 2</h3>

        <?php
        echo formatInternationalDate($today->getTimestamp());
        ?>
    </section>

    <!--Problem 3-->
    <section>
        <h3>Problem 3</h3>

        <?php

        $testString = "    TEN   ";
        stringFormatter($testString);

        $testString = "Does this contain DmAcC?";
        stringFormatter($testString);

        ?>
    </section>

    <!--Problem 4-->
    <section>
        <h3>Problem 4</h3>

        <?php

        $testNumber = 1234567890;
        numberFormatter($testNumber);

        ?>
    </section>

    <!--Problem 5-->
    <section>
        <h3>Problem 5</h3>

        <?php

        $testNumber = 123456;
        currencyFormatter($testNumber);

        ?>
    </section>

</main>

</body>
</html>