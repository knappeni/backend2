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
<p>Radera annonser från lopptorget</p>
<form action="radera.php" method="GET">
    Söksträng: <input type="text" name="sokstrang" />
    <input type="submit" name="sok" value="Sök" />
</form>
<?php
if($_SESSION['roll'] == 'admin'){
include("handyfunctions.php");
$conn = create_conn();

// Aktiv sökning
if (isset($_GET["sokstrang"])) {
    $sokord = test_input($_GET["sokstrang"]);
    // Uppkoppling ok, kör SQL kommandon härefter:
    $sql = "SELECT * FROM loppis WHERE rubrik LIKE '%$sokord%' OR beskrivning LIKE '%$sokord%' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Skriv ut varje rad
        while($row = $result->fetch_assoc()) {
         print("<p>Id: ".$row['id']. "<br>Rubrik: ".$row['rubrik']. "<br>Beskrivning: ".$row['beskrivning']."<br>Säljare:".$row['saljare']."<br>Pris:".$row['pris']."");
         // Knapp för att radera
         print("<br><a href='radera.php?delete=".$row['id']."'>Radera annonsen!</a></p>");
        }   
    } else {
        print("Queryn returnerade 0 rader");
    }
}
// Om man klickat radera
else if (isset($_GET["delete"])) {
    // Radera inlägg
    $id = test_input($_GET['delete']);
    print("<p>Annonsen du försöker ta bort har idn: ".$id."</p>");
    $sql = "DELETE FROM loppis WHERE id = '$id'";
    print($sql);
    $conn->query($sql); // Kör query på DBn
    if ($conn->affected_rows >0) {
        print("<p>Radering lyckades</p>");
    } else {
        print("<p>Radering lyckades inte!</p>");
    }
}
// Ingen söksträng
else {
    print("<p>Skriv in en sträng i fältet och tryck på sök</p>");
}

// Kom ihåg att stänga databasuppkopplingen
$conn->close();
}
else{
    print("<p>Du måste vara administratör för att ta bort annonser!</p>");
}
?>
</section>
</body>
</html>