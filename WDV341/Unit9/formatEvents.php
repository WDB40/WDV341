<?php
	//Get the Event data from the server.

    require ("connectPDO.php");

    $sqlCommand = "SELECT event_name, event_description, event_presenter, event_date, event_time 
                    FROM wdv341_event
                    ORDER BY event_date DESC";

    $statement = $conn->prepare($sqlCommand);

    try{
        $statement->execute();
    } catch (PDOException $exception){
        echo "Something didn't go so well.";
        echo $exception->getMessage();
    }

    function setClass($inDate){
        $currentDate = new DateTime();
        $eventDate = new DateTime($inDate);

        if($currentDate->format("Y-m") === $eventDate->format("Y-m")){
            echo "currentMonthEvent";
        } else if($eventDate > $currentDate){
            echo "futureEvent";
        } else{
            echo "displayEvent";
        }

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:50%;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text-align:left;
			font-size:18px;
		}
		
		.eventDetails {
			margin-left:50px;
		}

        .futureEvent{
            text-align:left;
            font-size:18px;
            font-style: italic;
        }

        .currentMonthEvent{
            font-weight: bold;
            text-align:left;
            font-size:18px;
            color: red;
        }
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3>Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $tableRow){
?>
        <div class="eventBlock">	
            <div>
            	<span class=<?php setClass($tableRow["event_date"])?>>Event: <?php echo $tableRow["event_name"] ?></span>
                <span> - Presenter: <?php echo $tableRow["event_presenter"] ?></span>
            </div>
            <div>
            	<span class="eventDetails">Description: <?php echo $tableRow["event_description"] ?></span>
            </div>
            <div>
            	<span class="eventDetails">Time: <?php echo $tableRow["event_time"] ?></span>
            </div>
            <div>
            	<span class="eventDetails">Date: <?php echo $tableRow["event_date"] ?></span>
            </div>
        </div>
<?php
    }

    $conn = null;
?>
</body>
</html>