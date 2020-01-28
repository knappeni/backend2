<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Loppis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>Projekt 2</h1>
<?php include "navbar.php" ?>
<section>
    <p>Här kan du göra nya Loppis-annonser</p>
    <?php
      if(isset($_SESSION['username'])){
        print("<article>
        <form action='matain.php' method='POST'>
        Rubrik:         <input type='text' name='rubrik'><br>
        Beskrivning:    <input type='text' name='beskrivning'><br>
        Säljare:        ".$_SESSION['username']."<br>
        Pris:           <input type='text' name='pris'><br>
        <input type='submit' name='matain' value='Mata in'>
        </form>
        
        </article>");
      }
      else{
        print("<p>Du måste vara inloggad för att kunna göra annonser</p>");
      }



      include("handyfunctions.php");
      $conn = create_conn();
      if($conn->connect_error){die("<p>CONNECTION FAILED: ".$conn->connect_error."</p>");}
      if(isset($_POST['matain'])){
          $rubrik = test_input($_POST['rubrik']);
          $beskrivning = test_input($_POST['beskrivning']);
          $saljare = $_SESSION['username'];
          $pris = test_input($_POST['pris']);
          $datum = date("Y-m-d H:i:s");
      

      $sql = "INSERT INTO loppis (rubrik,beskrivning,saljare,pris,datum)
      VALUES('$rubrik','$beskrivning','$saljare','$pris','$datum');";
      $result = $conn->query($sql);
      if($conn->affected_rows >0){
          print("<p>Inamtning lyckades!</p>");
      }
      else
        {
          print("<p>Inmatning lyckades inte!</p>");
        }
      $conn->close();
    }
    ?>
</section>
</body>
</html>