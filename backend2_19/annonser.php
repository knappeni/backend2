<!DOCTYPE html>
<?php   
// Sessionshantering
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP Projekt 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
<?php include("navbar.php"); ?>

<section>

<?php
    // Inloggningsuppgifterna och databasen
    include("handyfunctions.php");
    // Create connection
    $conn = create_conn();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Uppkoppling ok, kör SQL kommandon härefter: om man kommer direkt till sidan
    if(!isset($_GET['user'])){
        print("<p>Här ser du annonser från databasen</p>");
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            print("<p>".$row['rubrik']."<br>
                    ".$row['beskrivning']."<br>
                    ".$row['saljare']."<br>
                    <b>".$row['pris']."€</b><br>
                    Annonsen uppladdad: ".$row['datum']."</p>");
            }
        } else {
            print("<p>Det finns inga annonser i databasen</p>");
        }
    }
    elseif(isset($_GET['user']) && !empty($_GET['user'])){
        $user = test_input($_GET['user']);
        print("<p>Här ser du annonser från databasen av användaren ".$user."</p>");
        $sql = "SELECT * FROM loppis WHERE saljare='".$user."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                print("<p>".$row['rubrik']."<br>
                        ".$row['beskrivning']."<br>
                        ".$row['saljare']."<br>
                        <b>".$row['pris']."€</b><br>
                        Annonsen uppladdad: ".$row['datum']."</p>");
                }
            } else {
                print("<p>Användaren har inga annonser</p>");
            }

    }
    // Kom ihåg att stänga databasuppkopplingen
    $conn->close();
?>
</section>
</body>
</html>