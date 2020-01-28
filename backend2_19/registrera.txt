<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>Projekt 2</h1>
<?php include "navbar.php" ?>
<section>
   

    <?php
      
      if(!isset($_SESSION['username'])){
        print("<p>    
        <article>
        <form action='registrera.php' method='POST'>
        Användarnamn:         <input type='text' name='anvnamn' ><br>
        Lösenord:    <input type='text' name='losen'><br>
        Bekräfta lösenord: <input type='text' name='losen1'><br>
        Epost:        <input type='text' name='epost'><br>
        <input type='submit' name='registrera' value='Registrera dig'>
        </form>        
        </article>
        </p>");
      include("handyfunctions.php");
      $conn = create_conn();
      
      if(isset($_POST['registrera'])){
        
          $anvnamn = test_input($_POST['anvnamn']);
          $losen = test_input($_POST['losen']);
          $losen = hash("sha256",$losen);
          $losen1 = test_input($_POST['losen1']);
          $losen1 = hash("sha256",$losen1);
          $epost = test_input($_POST['epost']);
          $roll = "user";
          $status = "overifierad";

          $sql = "SELECT * FROM users WHERE namn ='$anvnamn' OR epost ='$epost';";
          $result = $conn->query($sql);
        
          if($result-> num_rows > 0){
              print("<p>Användaren finns redan!</p>");
      }
      else{
        
      if (filter_var($epost, FILTER_VALIDATE_EMAIL)&& $losen == $losen1) {
      $hash = hash(sha256,rand(0,1000));      
      $sql = "INSERT INTO users (namn,losen,epost,roll,hash,status)
      VALUES('$anvnamn','$losen','$epost','$roll','$hash','$status');";
      $result = $conn->query($sql);
      
      if($conn->affected_rows > 0){
        $subject = 'Verifiering av ditt konto!';
        $meddelande = '
        Du har registrerat dig till Jockes Loppis sidan!
        

        Aktivera ditt konto: https://cgi.arcada.fi/~mutkajoa/backend2/verifiera.php?epost='.$epost.'&hash='.$hash.'

        ';
        $headers = 'From:noreply@loppis.fi' . "\r\n";
        
        mail($epost,$subject,$meddelande,$headers);
        
          print("<p>Registrering lyckades!<br>
          Ett e-post meddelande har skickats med en verifierings-link!
          (Kom ihåg att kolla spam-filtret)
          </p>");
      }
    
    }
    else{
        if($losen != $losen1){
          print("<p>Lösenorden matchade inte</p>");
        }
      else{
      print("<p>Registrering lyckades inte!</p>");
      }
    } 
  }
  $conn->close();
  }
}
else{
  print("<p>Du verkar redan vara inloggad, du behöver inte registrera dig!</p>");
}   
    ?>
</section>
</body>
</html>