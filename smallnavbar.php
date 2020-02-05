<nav id="smallnavbar">
    <?php
    if (isset($_SESSION['username'])) {
        print("
        <div class='loggedDiv'>
        Loggad in som: ".$_SESSION['username']."
        <a href='profil.php'>Min profil</a>
        <a href='logout.php'>Logga ut</a></div>");

    } else {
        print("Inte loggad in");
    }
?>
</nav>