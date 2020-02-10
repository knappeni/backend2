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
if (isset($_SESSION['username'])) {
    if ($_SESSION['roll'] == 'admin') {
        echo "<table border = 1>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>"."<button class='anvandare'>Användare</button>"."<button class='annonser'>Annonser</button>"."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<div id='result'></div>";
        echo "</td>";
        echo "</tr>";
        echo "</thead>";
        echo "</table>";
    } else {
        echo("Du måste ha rollen admin eller editor för att se denna sida!");
    }
} else {
    echo("Du måste vara inloggad!");
}
?>
<script type="text/javascript">
$(document).ready(function(){
    $('.anvandare').click(function(){
        $.ajax({
            url: 'fetch.php',
            type: 'POST',
            data: {users:"users"},
            success: function(response){
                $('#result').html(response);

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



            }
        });
    });
});
$(document).ready(function(){
    $('.annonser').click(function(){
        $.ajax({
            url: 'fetchtest.php',
            type: 'POST',
            data: {annonser:"annonser"},
            success: function(response){
                $('#result').html(response);


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



            }
        });
    });
});


</script>
</section>
</body>
</html>