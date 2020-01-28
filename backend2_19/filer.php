<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Filer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>Filer</h1>
<?php include('navbar.php')?>
<section>
<article>
<h3>Här kan du ladda upp filer
<form action="filer.php" method="post" enctype="multipart/form-data">
    <p>Välj en profilbild till ditt konto</p>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Ladda upp bild" name="submit">
    <p>Filen Skall vara en bild och mindre än 2MB</p>
</form>
</h3>

</article>
<?php
include('handyfunctions.php');

$katalog = "filer/";
$target_file = $katalog . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        print("<p>Filen är en bild - " . $check["mime"] . ".</p>");
        $uploadOk = 1;
    } else {
        print("<p>Filen är inte en bild</p>");
        $uploadOk = 0;
    }

// Se om filen redan finns
if (file_exists($target_file)) {
    print("<p>Filen med det här namnet finns redan.</p>");
    $uploadOk = 0;
}
// Tillåt endast filer under 2MB
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    print("<p>Din fil är för stor (max 2MB)</p>");
    $uploadOk = 0;
}
// Tillåt endast vissa filtyper
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    print("<p>Endast JPG, JPEG, PNG & GIF filer är tillåtna</p>");
    $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    print("<p>Ett fel uppstod vid uppladning av filen</p>");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        print("<p>Filen ". basename( $_FILES["fileToUpload"]["name"]). " har laddats upp.</p>");
        $filnamn = basename( $_FILES["fileToUpload"]["name"]); //Är filens namn vid uppladdning
        //TODO: lägg till filnamnet och användaren i databas
        update_files_inDB($filnamn);
    } else {
        print("<p>Ett fel uppstod vid uppladdning av filen</p>");
        }
    }
}
print("<p>I ".$katalog." katalogen finns nu filerna: </p>");

$innehall = scandir($katalog);

foreach ($innehall as $rad) {
   if(($rad != ".") && ($rad != "..")) {print($rad."<br>");//$rad innehåller filnamn
    print("<img src='".$katalog.$rad."' alt='asd' width='300px'/><br>");    
    $sql = "SELECT * FROM filer WHERE filnamn = '$rad';";       
}
    }


?>
</section>
</body>
</html>