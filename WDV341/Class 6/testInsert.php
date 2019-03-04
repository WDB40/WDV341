<?php

include ("connectPDO.php");

$name = "Test";
$desc = "Testing the prepared statement";
$presenter = "Tester";
$date = '2019-05-10';
$time = '05:10:50';

try {

    $sql = "INSERT INTO wdv341_event(event_name, event_description, event_presenter, event_date, event_time)
              VALUES(:name, :desc, :presenter, :date, :time)";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':desc', $desc);
    $statement->bindParam(':presenter', $presenter);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':time', $time);

    $statement->execute();

    echo "Successful insert.";

} catch(PDOException $exception){
    echo $exception->getMessage();
}