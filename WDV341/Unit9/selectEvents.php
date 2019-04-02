<?php

    session_cache_limiter('none');
    session_start();

    if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
        header('Location: ../Unit11/presentersLogin.php');
    }

    require ("connectPDO.php");

    $sqlCommand = "SELECT event_id, event_name, event_description, event_presenter, event_date, event_time 
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
        <th>Delete</th>
    </tr>

    <?php foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {?>
        <tr>
            <td><?php echo $tableRow["event_name"] ?></td>
            <td><?php echo $tableRow["event_presenter"] ?></td>
            <td><?php echo $tableRow["event_description"] ?></td>
            <td><?php echo $tableRow["event_date"] ?></td>
            <td><?php echo $tableRow["event_time"] ?></td>
            <td><a href="../Unit12/deleteEvent.php?deleteId=<?php echo $tableRow["event_id"]?>">Delete</td>
            <td><a href="../Unit8/eventsForm.php?recID=<?php echo $tableRow["event_id"]?>">Update</a></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>