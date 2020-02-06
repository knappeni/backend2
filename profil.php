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
    <title><?php if(isset($_SESSION['username'])){
                 if(!isset($_GET['user']) || $_SESSION['username'] == $_GET['user'] ){ print($_SESSION['username']."s profil");}
                 else{print($_GET['user']."s profil");}}
                 else{print("Inte Inloggad");}?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
<h1><?php if(isset($_SESSION['username'])){
                 if(!isset($_GET['user']) || $_SESSION['username'] == $_GET['user'] ){ print($_SESSION['username']."s profil");}
                 else{print($_GET['user']."s profil");}}
                 else{print("Inte Inloggad");}?></h1>
<?php 
include("navbar.php"); 
if(isset($_SESSION['username'])){
    //Om man är inloggad, kolla ifall det bara är profil.php i URL eller om $_GET['user'] är samma som
    //inloggad användare. Laddar inloggade användarens egna profil
    if(isset($_GET['user'])){ 
    $user = test_input($_GET['user']);}
    if(!isset($user) || $_SESSION['username'] == $user ){
        
        $conn = create_conn();
        // Check connection
        if ($conn->connect_error) {
            die("<p>Connection failed: " . $conn->connect_error."</p>");
        } 
    
        // Uppkoppling ok, kör SQL kommandon härefter:
        $sql = "SELECT * FROM users WHERE namn='".$_SESSION['username']."';";
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $sql1 = "SELECT * FROM loppis WHERE saljare='".$row['namn']."';";
                $rows = $conn->query($sql1);
                print("<p>Användarnamn: ".$row['namn']."<br>
                        Email: ".$row['epost']."<br>
                        Din roll är: ".$row['roll']."<br>
                        Registrerad sedan: ".$row['datum']."<br>
                        Antal annonser: ".$rows->num_rows."
                        </p>");
                $oldlosen = $row['losen'];
             
            };
            
            //editera information form
            print("<article>
                <form action='profil.php' method='POST'>
                Uppdatera din Epost:<br>
                <input type='text' name='epost'><br>
                <br><input type='submit' name='updateEmail' value='Updatera Epost'>
                </form>
                <form action='profil.php' method='POST'>
                <br>
                Nuvarande lösenord:<br>
                <input type='password' name='currentlosen'><br>
                <br>
                Nytt lösenord:(8-256 tecken)<br>
                <input type='password' name='losen'><br>
                Bekräfta nytt lösenord:<br>
                <input type='password' name='losen1'><br><br>
                <input type='submit' name='updatePsw' value='Updatera Lösenord'>
                </form>        
                </article>");
            //uppdatera epost
            if(isset($_POST['updateEmail'])){
                $epost = test_input($_POST['epost']);
              
                if (filter_var($epost, FILTER_VALIDATE_EMAIL)){
                    $sql1 = "UPDATE users SET epost='$epost' WHERE namn='".$_SESSION['username']."';";
                    if (mysqli_query($conn, $sql1)) {
                        print("<p>Updateringen av eposten lyckades</p>");
                    } else {
                        print("<p>Updateringen av eposten lyckades inte: ".mysqli_error($conn)."</p>");
                    }
                }
                else{
                    print("<p>Epost adressen är inte i rätt format, försök på nytt</p>");
                }
            }
            //uppdatera lösenordet
            if(isset($_POST['updatePsw'])){
                $currentlosen = test_input($_POST['currentlosen']);
                $losen = test_input($_POST['losen']);
                $losen1 = test_input($_POST['losen1']);
             if($oldlosen == hash('sha256',$currentlosen)){
                  if(strlen($losen) < 8) {
                    echo "Lösenordet är för kort";
                } elseif (strlen($losen) > 256) {
                    echo "Lösenordet är för långt";
                } else{
                    $losen_hash = hash('sha256',$losen);
                    $losen1_hash = hash('sha256',$losen1);
                    if ($losen_hash == $losen1_hash){
                            $sql2 = "UPDATE users SET losen='$losen_hash' WHERE namn='".$_SESSION['username']."';";
                                if (mysqli_query($conn, $sql2)) {
                                    print("<p>Updateringen av lösenordet lyckades</p>");
                                }   else {
                                    print("<p>Updateringen av lösenordet lyckades inte: ".mysqli_error($conn)."</p>");
                                    }
                    }  else{
                        print("<p>Lösenorden matchade inte</p>");
                        }
                    }
                } else {
                    print("<p>Ditt nuvarande lösenord var fel</p>");
                    }
                        
                    
            }
            $conn->close();
           
    }}
    //ifall $_GET['user'] är annat än inloggade användaren, ladda $_GET['user'] profil
    else {
        $conn = create_conn();
        // Check connection
        if ($conn->connect_error) {
            die("<p>Connection failed: " . $conn->connect_error."</p>");
        } 
          
            // Uppkoppling ok, kör SQL kommandon härefter:
         $sql = "SELECT * FROM users WHERE namn='". $user ."';";
        
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                 while ($row = $result->fetch_assoc()) {
                    $sql1 = "SELECT * FROM loppis WHERE saljare='".$row['namn']."';";
                    $rows = $conn->query($sql1);
                    print("<p>Användarnamn: ".$row['namn']."<br>
                        Email: ".$row['epost']."<br>
                        Användaren ".$row['namn']."s roll är: ".$row['roll']."<br>
                        Registrerad sedan: ".$row['datum']."<br>
                        Antal annonser: ".$rows->num_rows."
                        </p>");
                };
            }
             else {
                print("<p>Ingen profil hittades</p>");
                }
                // Kom ihåg att stänga databasuppkopplingen
                $conn->close();
        }
    //if session user == GET user (eller om GET user är tom)
    //visa din egen profil med möjlighet att editera din info
    //elseif session user != GET user
    //visa GET user profil, men ingen möjlighet för att editera
    }
    else{
        print("<p>Du måste vara inloggad för att se profiler</p>");
    }
?>
</body>
</html>