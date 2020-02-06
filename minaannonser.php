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
    <title>Mina annonser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>Här ser du alla dina annonser</h1>
<?php include("navbar.php");?>

<section>
<?php
$conn = create_conn();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
<th>Uppdatera</th>
</tr>
</thead>";
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $rubrik = $row['rubrik'];
    $beskrivning = $row['beskrivning'];
    $pris = $row['pris'];
    echo "<tbody>";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['rubrik']."</td>";
    echo "<td>".$row['beskrivning']."</td>";
    echo "<td>".$row['pris']." €</td>";
    echo "<td>".date("d.m.Y H:i:s", strtotime($row['datum']))."</td>";
    echo "<td>"."<button class='delete' id='del_$id' data-id='$id'>Radera</button>"."</td>";
    echo "<form action=uppdatera.php method=POST>";
    echo "<input type=hidden name=id value=$id>";
    echo "<input type=hidden name=rubrik value=$rubrik>";
    echo "<input type=hidden name=beskrivning value=$beskrivning>";
    echo "<input type=hidden name=pris value=$pris>";
    echo "<td>"."<button class='update'>Uppdatera</button>"."</td>";
    echo "</form>";
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
<script type="text/javascript">
$(document).ready(function(){
    $('.update').click(function(){
        var updateid = $(this).data('id');
        $.ajax({
            url: 'uppdatera.php',
            type: 'POST',
            data: { id:updateid },
            success: function(response){
                $('#result').html(response);
            }
        });
    });
});
</script>

<?php $conn->close(); ?>
</section>
</body>
</html>