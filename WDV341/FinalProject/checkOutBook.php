<?php
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header("Location: homepage.php");
}

require ("connectPDO.php");

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
    echo $exception->getMessage();
}

?>