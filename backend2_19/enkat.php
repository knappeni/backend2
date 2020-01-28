<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>Enkät</h1>
<?php include("navbar.php"); ?>
<section>
    
    <?php
        include("handyfunctions.php");
       
        $conn = create_conn();
      
    if(isset($_GET["skicka"])){
        $sql = "SELECT * FROM poll where id='1';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        print("Fråga: ".$row["fraga"]."<br>
        Alternativ 1: ".$row["text1"]." - ".$row["antal1"]."st röster<br>
        Alternativ 2: ".$row["text2"]." - ".$row["antal2"]."st röster<br>
        Alternativ 3: ".$row["text3"]." - ".$row["antal3"]."st röster<br>
        ");

    }
    else{
       
        $sql = "SELECT * FROM poll where id='1';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        print($row["fraga"]."<br><form action='enkat.php' method='get'>");
        for($i = 1; $i <=$row['antal'];$i++){
            print("<input type='radio' name='svar' value='".$i."'/>".$row["text".$i]."<br>");
        }
        print("<input type='submit' name='skicka' value='Rösta'/><br>
        </form>");
    }
    $conn->close();
    ?>



<article>


</article>

</section>
</body>
</html>