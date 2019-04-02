<?php 
session_cache_limiter('none');
session_start();


    include "connectPDO.php";


	$message = "";

	if (isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes")
	{
		$message = "Welcome Back! " . $_SESSION['username'];
	}
	else
	{
		if (isset($_POST['submitLogin']))
		{
			try {
				$inUsername = $_POST['loginUsername'];
				$inPassword = $_POST['loginPassword'];

				$sql = "SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name = :username AND event_user_password = :password";

				$query = $conn->prepare($sql);

				$query->bindParam(":username", $inUsername);
				$query->bindParam(":password", $inPassword);

				$query->execute();
				
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

			
			if ($query->rowCount() == 1 )
			{
				$_SESSION['validUser'] = "yes";
				$_SESSION['username'] = $inUsername;
				$message = "Welcome Back! $inUsername";
			}
			else
			{
				$_SESSION['validUser'] = "no";					
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}
			
		}
		else
		{

		}
		
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Login and Control Page</title>

</head>

<body>

<h1>WDV341 Intro PHP</h1>

<h2>Events Admin Page</h2>

<h2><?php echo $message?></h2>

<?php
	if (isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes")
	{
?>
		<h3>Presenters Administrator Options</h3>
        <p><a href="../Unit8/eventsForm.php">Add New Event</a></p>
        <p><a href="../Unit9/selectEvents.php">See All Events</a></p>
        <p><a href="../Unit9/selectOneEvent.php">Select An Event</a></p>
        <p><a href="presentersLogout.php">Logout</a></p>
        					
<?php
	}
	else
	{
?>
			<h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="presentersLogin.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>
                
<?php
	}
?>

<p>Return to <a href='#'>www.presentationstogo.com</a></p>

</body>
</html>