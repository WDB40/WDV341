<?php

session_cache_limiter('none');
session_start();

require ("connectPDO.php");
require ("Emailer.php");


$message = "";

if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes"){
    $message = "Welcome back, " . $_SESSION['username'] . "!";
} else {
    if(isset($_POST['login'])){

        try{
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sqlCommand = "SELECT username, password 
                            FROM users 
                            WHERE username = :username 
                              AND password = :password";

            $query = $conn->prepare($sqlCommand);

            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);

            $query->execute();
        } catch(PDOException $exception){

            $email = new Emailer();
            $email->setSenderAddress("wes@wdb40.com");
            $email->setSendToAddress("wbrown1640@gmail.com");
            $email->setSubjectLine("Log In Error");
            $email->setMessageBody($exception->getMessage());
            $email->sendEmail();
            header("Location: homepage.php");
        }

        if($query->rowCount() == 1){
            $_SESSION['validUser'] = "yes";
            $_SESSION['username'] = $username;
            $message = "Welcome back, " . $_SESSION['username'] . "!";
        } else {
            $_SESSION['validUser'] = "no";
            $message = "Sorry, there was a problem with your login information.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Library</title>
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
<h2>Home Page</h2>

<?php if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes"){ ?>

    <h3>Logged In</h3>
    <p>Welcome to the Library.</p>
    <p><a href="fakeErrorHandling.php">Test the Error Handling</a></p>

<?php } else { ?>

    <h3>Enter Login Information</h3>

    <form method="post" name="loginForm" action="homepage.php">
        <p>
            <label for="username">Username: </label>
            <input name="username" id="username" type="text">
        </p>

        <p>
            <label for="password">Password: </label>
            <input name="password" id="password" type="password">
        </p>

        <input name="login" value="Login" type="submit">
    </form>

<?php } ?>
</main>
</body>
</html>
