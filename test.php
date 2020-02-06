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

<script language="JavaScript" type="text/javascript">
function delannons(id) {
    if (confirm("Är du säker på att du vill radera annons '" + id + "'")) {
        window.location.href='delete.php?delID=' +id+'';
    }
}
</script>
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

#if (isset($_POST['delete'])) {
    #$deleteDB = "DELETE FROM loppis WHERE id = '$_POST[hidden]'";
    #$conn->query($deleteDB);
#}

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
</tr>
</thead>";
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    echo "<tbody>";
    echo "<form action=test.php method=post>";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['rubrik']."</td>";
    echo "<td>".$row['beskrivning']."</td>";
    echo "<td>".$row['pris']." €</td>";
    echo "<td>".date("d.m.Y H:i:s", strtotime($row['datum']))."</td>";
    echo "<td>"."<input type=hidden name=hidden value=".$row['id'].">"."</td>";
    #echo "<td>"."<input type=submit name=update value=Uppdatera>"."</td>";
    #echo "<td>"."<input type=submit name=delete value=Radera onclick=delannons(".$row['id'].")>"."</td>";
    echo "<td>"."<button class='delete btn btn-danger' id='del_<?= $id ?>' data-id='<?= $id ?>' >Delete</button>"."</td>";
    echo "</tr>";
    echo "</form>";
    echo "</tbody>";
}
echo "</table>";
#$conn->close();
?>
<script type="text/javascript">
$(document).ready(function(){
// Delete 
$('.delete').click(function(){
  var el = this;
  // Delete id
  var deleteid = $(this).data('id');
  // Confirm box
  confirm("Do you really want to delete record!?", function(result) {
    alert("hiii");
     if(result){
        alert("hiii");
       // AJAX Request
       $.ajax({
         url: 'ajaxfile.php',
         type: 'POST',
         data: { id:deleteid },
         success: function(response){
           // Removing row from HTML Table
           if(response == 1){
               alert("hiii");
                $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
            });
            }else{
                alert('Record not deleted.');
            }
         }
       });
     } 
  });
  alert("hiii111");
});
});
</script>
<?php $conn->close(); ?>
</section>
</body>
</html>