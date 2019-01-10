<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Basics</title>
</head>
<body>

    <!--Problem 1-->
    <?php $yourName = "Wes Brown"?>

    <!--Problem 2-->
    <?php echo "<h1>PHP Basics</h1>"; ?>

    <!--Problem 3-->
    <h2 id="nameHeader"><?php echo $yourName;?></h2>

    <!--Problem 4-->
    <?php
    $number1 = 5;
    $number2 = 10;
    $total = $number1 + $number2;
    ?>

    <!--Problem 5-->
    <?php
    echo $number1 . " + " . $number2 . " = " . $total;
    ?>

    <!--Problem 6-->
    <?php

    echo "<script> var languages = ['PHP', 'HTML', 'JavaScript']; </script>";

    /*$languages = ['PHP', 'HTML', 'JavaScript'];

    foreach($languages as $language){
        echo "<p>" . $language . "</p>";
    }*/
    ?>

    <script>
        for(var i = 0; i < languages.length; i++){
            document.write("<p>"+ languages[i] + "</p>");
        }
    </script>
</body>
</html>