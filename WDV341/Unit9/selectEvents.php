<?php
    require ("connectPDO.php");

    $sqlCommand = "SELECT event_name, event_description, event_presenter, event_date, event_time 
                    FROM wdv341_event";

    $statement = $conn->prepare($sqlCommand);

    try {
        $statement->execute();
    } catch (PDOException $exception){
        echo "Something didn't go right.";
        echo $exception->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select All Events</title>
</head>
<body>

<table>

    <tr>
        <th>Name</th>
        <th>Presenter</th>
        <th>Description</th>
        <th>Date</th>
        <th>Time</th>
    </tr>

    <?php foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {?>
        <tr>
            <td><?php echo $tableRow["event_name"] ?></td>
            <td><?php echo $tableRow["event_presenter"] ?></td>
            <td><?php echo $tableRow["event_description"] ?></td>
            <td><?php echo $tableRow["event_date"] ?></td>
            <td><?php echo $tableRow["event_time"] ?></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>