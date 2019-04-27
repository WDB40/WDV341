<?php
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header("Location: homepage.php");
}

require ("connectPDO.php");
require ("Emailer.php");

$sqlCommand = "DELETE FROM books 
                WHERE book_id = :bookId";

$statement = $conn->prepare($sqlCommand);

$bookId = "";

if(isset($_GET["bookId"])){
    $bookId = $_GET["bookId"];
} else {
    header("Location: viewAllBooks.php");
}

$statement->bindParam(":bookId", $bookId);

try{
    $statement->execute();
    header("Location: viewAllBooks.php");
} catch (PDOException $exception){

    $email = new Emailer();
    $email->setSenderAddress("wes@wdb40.com");
    $email->setSendToAddress("wbrown1640@gmail.com");
    $email->setSubjectLine("Check Out Error");
    $email->setMessageBody($exception->getMessage());
    $email->sendEmail();
    header("Location: homepage.php");

}

?>