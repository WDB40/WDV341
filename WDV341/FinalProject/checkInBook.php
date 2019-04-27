<?php
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
    header('Location: homepage.php');
}

require ("connectPDO.php");
require ("BookValidator.php");

$bookId = "";
$title = "";
$titleError = "";
$firstName = "";
$firstNameError = "";
$lastName = "";
$lastNameError = "";
$genre = "";
$genreError = "";
$desc = "";
$descError = "";

$validator = new BookValidator();

if(isset($_POST['submit'])){

    $validBook = true;

    if(isset($_POST["bookId"])){
        $bookId = $_POST["bookId"];
    }

    if(isset($_POST["title"])){
        $title = $_POST["title"];
    }

    if(isset($_POST["firstName"])){
        $firstName = $_POST["firstName"];
    }

    if(isset($_POST["lastName"])){
        $lastName = $_POST["lastName"];
    }

    if(isset($_POST["genre"])){
        $genre = $_POST["genre"];
    }

    if(isset($_POST["desc"])){
        $desc = $_POST["desc"];
    }

    if($validator->isEmpty($title)){
        $validBook = false;
        $titleError = "Title cannot be empty.";
    } elseif(!$validator->validateTitle($title)){
        $validBook = false;
        $titleError = "Title cannot be more than 50 characters.";
    }

    if($validator->isEmpty($firstName)){
        $validBook = false;
        $firstNameError = "First Name cannot be empty.";
    } elseif(!$validator->validateName($firstName)){
        $validBook = false;
        $firstNameError = "First Name cannot be more than 25 characters.";
    }

    if($validator->isEmpty($lastName)){
        $validBook = false;
        $lastNameError = "Last Name cannot be empty.";
    } elseif (!$validator->validateName($lastName)){
        $validBook = false;
        $lastNameError = "Last Name cannot be more than 25 characters.";
    }

    if($validator->isEmpty($genre)){
        $validBook = false;
        $genreError = "Genre cannot be empty.";
    } elseif(!$validator->validateGenre($genre)){
        $validBook = false;
        $genreError = "Genre cannot be more than 25 characters.";
    }

    if($validator->isEmpty($desc)){
        $validBook = false;
        $descError = "Description cannot be empty.";
    } elseif(!$validator->validateDesc($desc)){
        $validBook = false;
        $descError = "Description cannot be more than 100 characters.";
    }

    if($validBook){

        if($bookId != ""){
            $sqlCommand = "UPDATE books 
                            SET title = :title, author_first_name = :firstName, author_last_name = :lastName, genre = :genre, description = :description 
                            WHERE book_id = :bookId";

            $statement = $conn->prepare($sqlCommand);
            $statement->bindParam(":bookId", $bookId);
        } else {
            $sqlCommand = "INSERT INTO books(title, author_first_name, author_last_name, genre, description) 
                            VALUES(:title, :firstName, :lastName, :genre, :description)";
            $statement = $conn->prepare($sqlCommand);
        }

        $statement->bindParam(":title", $title);
        $statement->bindParam(":firstName", $firstName);
        $statement->bindParam(":lastName", $lastName);
        $statement->bindParam(":genre", $genre);
        $statement->bindParam(":description", $desc);

        try{
            $statement->execute();
            header("Location: viewAllBooks.php");
        } catch(PDOException $exception){
            echo $exception->getMessage();
        }
    }
} elseif (isset($_GET["bookId"])){
    $bookId = $_GET["bookId"];

    $sqlCommand = "SELECT title, author_first_name, author_last_name, genre, description  
                    FROM books 
                    WHERE book_id = :bookId";

    $statement = $conn->prepare($sqlCommand);
    $statement->bindParam(":bookId", $bookId);
    $statement->execute();

    $book = $statement->fetch();

    $title = $book["title"];
    $firstName = $book["author_first_name"];
    $lastName = $book["author_last_name"];
    $genre = $book["genre"];
    $desc = $book["description"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check In or Update Book</title>
    <link rel="stylesheet" type="text/css" href="standardStyle.css">
</head>
<body>

<header>
    <h1>The Library</h1>
    <img src="banner.png" alt="Banner">
</header>

<nav>
    <a href="homepage.php">Home</a>
    <a href="checkInBook.php">Check In</a>
    <a href="viewAllBooks.php">View All</a>
    <a href="contactUs.php">Contact Us</a>
    <a href="logout.php">Logout</a>
</nav>

<main>
    <h2>Enter Book Information</h2>

    <form method="post" action="checkInBook.php">
        <input type="hidden" name="bookId" value="<?php echo $bookId ?>">

        <h3>Book</h3>
        <p>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" value="<?php echo $title ?>">
            <span id="titleError"><?php echo $titleError ?></span>
        </p>

        <p>
        <label for="genre">Genre: </label>
        <input type="text" name="genre" id="genre" value="<?php echo $genre ?>">
        <span id="genreError"><?php echo $genreError ?></span>
        </p>

        <p>
            <label for="desc">Description: </label>
            <span id="descError"><?php echo $descError ?></span>
        </p>

        <textarea name="desc" id="desc" cols="30" rows="5"><?php echo $desc ?></textarea>

        <h3>Author</h3>
        <p>
            <label for="firstName">First Name: </label>
            <input type="text" name="firstName" id="firstName" value="<?php echo $firstName ?>">
            <span id="firstNameError"><?php echo $firstNameError ?></span>
        </p>

        <p>
            <label for="lastName">Last Name: </label>
            <input type="text" name="lastName" id="lastName" value="<?php echo $lastName ?>">
            <span id="lastNameError"><?php echo $lastNameError ?></span>
        </p>

        <input type="submit" name="submit" value="Submit">

    </form>
</main>
</body>
</html>