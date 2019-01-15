<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Div Assignment</title>

    <style>
        .red {
            background-color: #7d0000;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            color: white;
            width: 200px;
            height: 200px;
        }

        .blue {
            background-color: #0000fa;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            color: white;
            width: 200px;
            height: 200px;
        }

        .green {
            background-color: #00bf00;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            color: white;
            width: 200px;
            height: 200px;
        }
    </style>
</head>

<body>

<?php $colorCode = 2; ?>

<?php if($colorCode < 4){ ?>
    <div class="red">
        <h1>Red Div</h1>
    </div>
<?php } elseif($colorCode < 7){ ?>
    <div class="blue">
        <h1>Blue Div</h1>
    </div>
<?php } else{ ?>
    <div class="green">
        <h1>Green Div</h1>
    </div>
<?php } ?>

</body>
</html>