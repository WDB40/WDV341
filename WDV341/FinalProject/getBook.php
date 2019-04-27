<?php
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header("Location: homepage.php");
}

require ("Book.php");
require ("connectPDO.php");

$book = new Book();

$sqlCommand = "SELECT book_id, title, author_last_name, author_first_name, genre, description 
                FROM books 
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

    $result = $statement->fetch();

    $book->setTitle($result["title"]);
    $book->setAuthorFirstName($result["author_first_name"]);
    $book->setAuthorLastName($result["author_last_name"]);
    $book->setGenre($result["genre"]);
    $book->setDescription($result["description"]);

    $selectedBook = json_encode($book->expose());
    echo $selectedBook;

} catch(PDOException $exception){
    echo $exception->getMessage();
}