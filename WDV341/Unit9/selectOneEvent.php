<?php

    require ("connectPDO.php");




    $name = "";
    $description = "";
    $presenter = "";
    $date = "";
    $time = "";
    $id = "";

    $sqlCommand = "SELECT event_id FROM wdv341_event";
    $getIDs = $conn->prepare($sqlCommand);
    $getIDs->execute();


if(isset($_GET["submit"])){
        $sqlCommand = "SELECT event_name, event_description, event_presenter, event_date, event_time 
                          FROM wdv341_event 
                          WHERE event_id = :id";

        $statement = $conn->prepare($sqlCommand);

        $id = $_GET["selectedEvent"];
        $statement->bindParam(":id", $id);

        $statement->execute();
        $event = $statement->fetch();

        $statement->rowCount();

        $name = $event["event_name"];
        $description = $event["event_description"];
        $presenter = $event["event_presenter"];
        $date = $event["event_date"];
        $time = $event["event_time"];

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select One Event</title>
</head>
<body>
    <form action="selectOneEvent.php" method="get">
        <label>Select an ID:
            <select name="selectedEvent">
                <?php foreach ($getIDs->fetchAll(PDO::FETCH_ASSOC) as $currentEvent){ ?>
                    <option value="<?php echo $currentEvent["event_id"]; ?>" <?php if($id == $currentEvent["event_id"]){echo "selected";} ?>><?php echo $currentEvent["event_id"]; ?></option>
                <?php } ?>
            </select>
        </label>

        <table>
            <tr>
                <th>Name</th>
                <td><?php echo $name ?></td>
            </tr>

            <tr>
                <th>Presenter</th>
                <td><?php echo $presenter ?></td>
            </tr>

            <tr>
                <th>Description</th>
                <td><?php echo $description ?></td>
            </tr>

            <tr>
                <th>Date</th>
                <td><?php echo $date ?></td>
            </tr>

            <tr>
                <th>Time</th>
                <td><?php echo $time ?></td>
            </tr>
        </table>

        <input type="submit" value ="Search" name="submit">

    </form>
</body>
</html>