<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>In Class Examples</title>
</head>
<body>

<?php

$names = ["Jeff", "Mary", "John"];

foreach ($names as $name){
    echo $name . "<br>";
}
?>


<script>

    var names = <?php
        $name1 = "Jeff";
        $name2 = "Mary";
        $name3 = "John";

        echo "[ '".$name1 . "', '" . $name2 . "','" . $name3 ."']";

        ?>;

    for(var i = 0; i<names.length; i++){
        document.writeln(names[i]);
    }

</script>

</body>
</html>