<?php
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header("Location: homepage.php");
}

require ("connectPDO.php");
require ("Emailer.php");

$sqlCommand = "SELECT book_id, title, author_last_name, author_first_name, genre, description 
                FROM book 
                WHERE book_id = :bookId";

$statement = $conn->prepare($sqlCommand);

$bookId = 1;

$statement->bindParam(":bookId", $bookId);

try{
    $statement->execute();

} catch(PDOException $exception){

    $email = new Emailer();
    $email->setSenderAddress("wes@wdb40.com");
    $email->setSendToAddress("wbrown1640@gmail.com");
    $email->setSubjectLine("Showing the Error Handling");
    $email->setMessageBody("Error Message: " . $exception->getMessage() . "\nError Trace:\n" . $exception->getTraceAsString());
    $email->sendEmail();
    header("Location: homepage.php");

}