<!DOCTYPE html>
<?php
// Sessionshantering
include("handyfunctions.php");
?>
<html>
<head>
    <meta charset="utf-8"/>>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print($_SESSION['username'])?> profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
<h1>Din Profil</h1>
<?php 
include("navbar.php"); 
    //if session user == GET user (eller om GET user är tom)
    //visa din egen profil med möjlighet att editera din info
    //elseif session user != GET user
    //visa GET user profil, men ingen möjlighet för att editera
?>
</body>
</html>