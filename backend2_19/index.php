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
<h1>Välkommen till Jockes Loppis(Projekt 2)</h1>
<?php include("navbar.php"); ?>
<section>
<!-- <article>
<form action="index.php" method="get">
Epost: <input type="text" name="epost"><br>
Användarnamn: <input type="text" name="anvandare"><br>
<input type="submit" name="skicka" value="Registrera">
</form>

</article>
-->
    <?php
    if(isset($_SESSION['username'])){
      print("<p>Välkommen till Jockes Loppis Sida. Man kan laga annonser, och se en lista på användare.<br>
      Använd linkarna i nav-baren för att navigera.</p>");
      }
      else{
        print("<p>Välkommen, du har inte loggat in. <br>
        Om du inte har ett användarkonto kan du laga ett.<br> 
        Till det behöver du en GILTIG epost-adress(epost-adressen måste verifieras före du kan logga in) för att kunna logga in.
        </p>");
      }
    ?>
</section>
</body>
</html>