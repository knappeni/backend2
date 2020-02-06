<?php
// Sessionshantering
include("handyfunctions.php");
$conn = create_conn();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
print("HEJEJEJE");
$deleteDB = "DELETE FROM loppis WHERE id = '".$_GET['delID']."'";
$conn->query($deleteDB);
header ("Location: test.php");
$conn->close();
?>