<!DOCTYPE html>
<?php
// Sessionshantering
include("handyfunctions.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Användare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
<h1>Användarkatalog</h1>
<?php include("navbar.php"); ?>

<section>
<?php
    if (isset($_SESSION['username'])) {
        print("<p>Här är alla användare som är registrerade till sidan.<br>
        Klicka på användarnamnet för att visa användarens annonser.</p>");
        // Inloggningsuppgifterna och databasen
    
        // Create connection
        $conn = create_conn();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // Uppkoppling ok, kör SQL kommandon härefter:
        $sql = "SELECT * FROM users ORDER BY roll";
    
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $sql1 = "SELECT * FROM loppis WHERE saljare='".$row['namn']."';";
                $rows = $conn->query($sql1);
                print("<p><b>Användarnamn:</b> <a href='annonser.php?user=".$row['namn']."'>".$row['namn']."</a> <br>
                <b>Email:</b> ".$row['epost']."<br>
                <b>Registrerad sedan:</b> ".date("d.m.Y H:i:s", strtotime($row['datum']))."<br>
                <b>Antal annonser:</b> ".$rows->num_rows."</p>");
            }
        } else {
            print("<p>Inga användare hittades</p>");
        }
        // Kom ihåg att stänga databasuppkopplingen
        $conn->close();
    } else {
        print("<p>Du måste vara inloggad för att kunna se innehållet på den här sidan</p>");
    }

?>
</section>
</body>
</html>