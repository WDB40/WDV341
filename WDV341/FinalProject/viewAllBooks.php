<?php

session_cache_limiter('none');
session_start();

 if(!isset($_SESSION['validUser']) || $_SESSION['validUser'] != "yes"){
     header("Location: homepage.php");
 }

 require ("connectPDO.php");
 require ("Emailer.php");

 $sqlCommand = "SELECT book_id, title, author_first_name, author_last_name 
                    FROM books";

 $statement = $conn->prepare($sqlCommand);

 try{
     $statement->execute();
 } catch (PDOException $exception){

     $email = new Emailer();
     $email->setSenderAddress("wes@wdb40.com");
     $email->setSendToAddress("wbrown1640@gmail.com");
     $email->setSubjectLine("View All Error");
     $email->setMessageBody($exception->getMessage());
     $email->sendEmail();
     header("Location: homepage.php");
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View All Books</title>
    <link rel="stylesheet" type="text/css" href="standardStyle.css">

    <script>

        function getBook(bookId) {



            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {
                if(this.readyState === 4 && this.status === 200){
                    var book = JSON.parse(this.responseText);
                    document.getElementById("title").innerHTML = book.title;
                    document.getElementById("author").innerHTML = book.authorLastName + ", " + book.authorFirstName;
                    document.getElementById("genre").innerHTML = book.genre;
                    document.getElementById("desc").innerHTML = book.description;
                    document.getElementById("checkOut").innerHTML = "Check Out";
                    document.getElementById("checkOut").href = "checkOutBook.php?bookId=" + bookId;
                    document.getElementById("update").innerHTML = "Update";
                    document.getElementById("update").href = "checkInBook.php?bookId=" + bookId;
                }
            };

            request.open("GET", "getBook.php?bookId=" + bookId, true);
            request.send();

        }

    </script>

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
    <h2>All Books</h2>

    <table>
        <tr>
            <th>Title</th>
        </tr>

        <?php foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $book){ ?>

            <tr>
                <td onclick="getBook(<?php echo $book["book_id"] ?>);"><?php echo $book["title"] ?></td>
            </tr>

        <?php } ?>

    </table>

    <h3>Selected Book</h3>
    <p><label for="title">Title: </label><span id="title"></span></p>
    <p><label for="genre">Genre: </label><span id="genre"></span></p>
    <p><label for="desc">Description: </label><span id="desc"></span></p>
    <p><label for="author">Author: </label><span id="author"></span></p>
    <p><a href="#" id="checkOut"></a> <a href="#" id="update"></a></p>

</main>
</body>
</html>