<?php

//Insert the actual error messages
    require ("connectPDO.php");
    require ("EventValidator.php");

    $eventName = "";
    $eventDescription = "";
    $eventPresenter = "";
    $eventDate = "";
    $eventTime = "";

    $nameError = "";
    $descriptionError = "";
    $presenterError = "";
    $dateError = "";
    $timeError = "";

    $validator = new EventValidator();

if(isset($_POST['submitButton']) && $_POST['eventLength'] == ""){

    $validEvent = true;

    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventPresenter = $_POST["eventPresenter"];
    $eventDate = $_POST["eventDate"];
    $eventTime = $_POST["eventTime"];

    if(!$validator->validateText($eventName)){
        $validEvent = false;
        $nameError = "Enter a name.";
    }

    if(!$validator->validateText($eventDescription)){
        $validEvent = false;
        $descriptionError = "Enter a description.";
    }

    if(!$validator->validateText($eventPresenter)){
        $validEvent = false;
        $presenterError = "Enter a presenter.";
    }

    if(!$validator->validateDate($eventDate)){
        $validEvent = false;
        $dateError = "Invalid date.";
    }

    if(!$validator->validateTime($eventTime)){
        $validEvent = false;
        $timeError = "Invalid time";
    }

    if($validEvent){
        $sqlCommand = "INSERT INTO wdv341_event(event_name, event_description, event_presenter, event_date, event_time) 
                          VALUES(:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)";

        $statement = $conn->prepare($sqlCommand);
        $statement->bindParam(':eventName', $eventName);
        $statement->bindParam(':eventDescription', $eventDescription);
        $statement->bindParam(':eventPresenter', $eventPresenter);
        $statement->bindParam(':eventDate', $eventDate);
        $statement->bindParam(':eventTime', $eventTime);

        try {
            $statement->execute();

            $eventName = "";
            $eventDescription = "";
            $eventPresenter = "";
            $eventDate = "";
            $eventTime = "";
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Form</title>
</head>
<body onload="setUpForm()">

<h1>Add an Event</h1>

<form  method="post" action="eventsForm.php">
    <table>
        <tr id="eventName">
            <th>Event Name:</th>
            <td><input type="text" name="eventName" value="<?php echo $eventName ?>"></td>
            <td id="nameError"><?php echo $nameError ?></td>
        </tr>

        <tr id="eventDescription">
            <th>Event Description:</th>
            <td><input type="text" name="eventDescription" value="<?php echo $eventDescription ?>"></td>
            <td id="descriptionError"><?php echo $descriptionError ?></td>
        </tr>

        <tr id="eventPresenter">
            <th>Event Presenter:</th>
            <td><input type="text" name="eventPresenter" value="<?php echo $eventPresenter ?>"></td>
            <td id="presenterError"><?php echo $presenterError ?></td>
        </tr>

        <tr id="eventLength">
            <th>Event Length:</th>
            <td><input type="text" name="eventLength"></td>
            <td id="lengthError"></td>
        </tr>

        <tr id="eventDate">
            <th>Event Date (YYYY/MM/DD)</th>
            <td><input type="text" name="eventDate" value="<?php echo $eventDate ?>"></td>
            <td id="dateError"><?php echo $dateError ?></td>
        </tr>

        <tr id="eventTime">
            <th>Event Time (HH:MM:SS):</th>
            <td><input type="text" name="eventTime" value="<?php echo $eventTime ?>"></td>
            <td id="timeError"><?php echo $timeError ?></td>
        </tr>
    </table>

    <input type="submit" name="submitButton" value="Add">
</form>

</body>

<script>

    function setUpForm(){
        document.getElementById("eventLength").style.display = "none";
    }

</script>

</html>