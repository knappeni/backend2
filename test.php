<!DOCTYPE html>
<?php
// Sessionshantering
include("handyfunctions.php");
include("smallnavbar.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Annonser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
    <h1>Här ser du alla annonser på vår loppis</h1>
<?php include("navbar.php"); ?>


<section>
<?php
$conn = create_conn();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['update'])) {
    ;
};
if (isset($_POST['delete'])) {
    $deleteDB = "DELETE FROM loppis WHERE id='$_POST[hidden]'";
    $conn->query($deleteDB);
};

$sql = "SELECT * FROM loppis";
$result = $conn->query($sql);
echo "<table border=1>
<tr>
<th>ID</th>
<th>Rubrik</th>
<th>Beskrivning</th>
<th>Pris €</th>
<th>Uppladdad</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<form action=test.php method=post>";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['rubrik']."</td>";
    echo "<td>".$row['beskrivning']."</td>";
    echo "<td>".$row['pris']." €</td>";
    echo "<td>".date("d.m.Y H:i:s", strtotime($row['datum']))."</td>";
    echo "<td>"."<input type=hidden name=hidden value=".$row['id'].">"."</td>";
    echo "<td>"."<input type=submit name=update value=Uppdatera>"."</td>";
    echo "<td>"."<input type=submit name=delete value=Radera>"."</td>";
    echo "</tr>";
    echo "</form>";
}

echo "</table>";
$conn->close();
?>
</section>
</body>
</html>