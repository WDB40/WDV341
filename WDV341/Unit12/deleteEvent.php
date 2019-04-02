<?php

session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header('Location: ../Unit11/presentersLogin.php');
}

require "connectPDO.php";
$command = "DELETE FROM wdv341_event WHERE event_id = :event_id";

try {
    $query = $conn->prepare($command);
    $query->bindParam(":event_id", $_GET['deleteId']);
    $query->execute();

    header('Location: ../Unit9/selectEvents.php');

} catch (PDOException $exception){
    echo $exception->getMessage();
}

?>