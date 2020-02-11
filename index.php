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
    <title>Loppis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
    <h1>Projekt 2</h1>
    <?php include 'navbar.php'?>
<?php
if (isset($_SESSION['username'])) {
    print("<p>Välkommen till Jockes och Knappes Loppis Sida. Man kan laga annonser, och se en lista på användare.<br>
    Använd linkarna i nav-baren för att navigera.<br>
    </p><br><br><br><h2>Det finns tre stycken färdiga användare åt dennis :></h2><br><h3>Username: admin password: password</h3><br><h3>Username: editor password: password</h3><br><h3>Username: user password: password</h3>");
} else {
    print("<p>Välkommen, du har inte loggat in. <br>
    Om du inte har ett användarkonto kan du laga ett.<br> 
    Till det behöver du en GILTIG epost-adress(epost-adressen måste verifieras före du kan logga in) för att kunna logga in.<br>
    </p><br><br><br><h2>Det finns tre stycken färdiga användare åt dennis :></h2><br><h3>Username: admin password: password</h3><br><h3>Username: editor password: password</h3><br><h3>Username: user password: password</h3>");
}
?>
<div>
<h3>Rapport för Projekt2</h3>
<br>
<h5>Specifikation för Projekt2</h5>
<p>För projekt två valde vi att inte vara så kreativa och fortsatte på loppis idén från kursen 2019<br>
dels för att det var samma som i fjol och dels för att Jocke hade en grund för projektet kvar från året innan.<br>
</p>
<p>Det finns tre olika roller på Loppis sidan, "user" som är vanliga användare, "editor" som kan editera andra användares loppis-annonser<br>
och admins, som kan ta bort andra användares annonser och ta bort andra användare.</p>
<p>Sidans design är inte väldigt vacker eller modern, men eftersom kursen är Back-End programering, har vi försökt att<br>
satsa mera på att ha en fungerande backend på vår sida.<br></p>
<p>Några saker som att editor och admin kan inte för tillfället ennu editera andra användares annonser. Också "grief repporting" och "forgot password"<br>
är ennu Work in progress.</p>
<p>Användare kan dock ändra på sina egna annonser, och byta sitt lösenord och uppdatera sin epost. Detta under linkarna<br>
"Min Profil" och "Mina Annonser"</p>
<h5>Bilder på specificationerna på SQL tabellerna för annonser och användare:<br></h5>
<p>Bild kommer här</p>
<p>Bild kommer här</p>
</div>
</body>
</html>