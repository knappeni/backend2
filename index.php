<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Intressant Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Projekt 2</h1>
    <?php include 'navbar.php'?>
<?php

    $conn = mysqli_connect("localhost","knappe","password","projekt2");
    if(!$conn){
        echo "Connection error:" . mysqli_connect_error();
    }
   
?>
</body>
</html>