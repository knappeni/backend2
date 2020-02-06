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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>Här ser du alla annonser på vår loppis</h1>
<?php include("navbar.php");?>

<section>
<?php
$conn = create_conn();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    ;
}

$sql = "SELECT * FROM loppis";
$result = $conn->query($sql);
echo "<table border=1>
<thead>
<tr>
<th>ID</th>
<th>Rubrik</th>
<th>Beskrivning</th>
<th>Pris €</th>
<th>Uppladdad</th>
<th>Ta bort</th>
</tr>
</thead>";
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    echo "<tbody>";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['rubrik']."</td>";
    echo "<td>".$row['beskrivning']."</td>";
    echo "<td>".$row['pris']." €</td>";
    echo "<td>".date("d.m.Y H:i:s", strtotime($row['datum']))."</td>";
    echo "<td>"."<button class='delete btn btn-danger' id='del_$id' data-id='$id'>Radera</button>"."</td>";
    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
?>
<script type="text/javascript">
$(document).ready(function(){
$('.delete').click(function(){
  var deleteid = $(this).data('id');
  var confirmation = confirm("Vill du verkligen radera annonsen?")
     if (confirmation == true) {
       $.ajax({
         url: 'delete.php',
         type: 'POST',
         data: { id:deleteid },
         success: function(response){
           if (response == 1) {
               alert("Annonsen är raderad");
               location.reload();
            } else {
                alert('Annonsen är inte raderad');
            }
         }
       });
     } 
});
});
</script>
<?php $conn->close(); ?>
</section>
</body>
</html>