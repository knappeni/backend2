<nav>
    <?php
    if (isset($_SESSION['username'])) {
            //inloggad user
            if ($_SESSION['roll'] == 'user') {
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>
                <a href='profil.php?user=".$_SESSION['username']."'>Logged in as ".$_SESSION['username']."</a>");
            } elseif ($_SESSION['roll'] == 'editor') {
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>
                <a href='profil.php?user=".$_SESSION['username']."'>Logged in as ".$_SESSION['username']."</a>");
            } elseif ($_SESSION['roll'] == 'admin') {
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='radera.php'>Radera</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>
                <a href='profil.php?user=".$_SESSION['username']."'>Logged in as ".$_SESSION['username']."</a>");
            }
    } else {
        print("
        <a href='index.php'>Home</a>
        <a href='login.php'>Logga In</a>
        <a href='registrera.php'>Registrera dig</a>
        <div class='loggedDiv'>Not logged in</div>");
    }
?>
</nav>