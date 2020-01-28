<nav>
    <?php
    if(isset($_SESSION['username'])){
            print("<section>
                    Hejsan: ".$_SESSION['username']."<br>
                    Du har rollen: ".$_SESSION['roll']."
            </section>");
            //inloggad user
            if($_SESSION['roll'] == 'user'){
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>");
            }
            //inloggad editor
            else if($_SESSION['roll'] == 'editor'){
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>");
              }
            //inloggad admin
            else if($_SESSION['roll'] == 'admin'){
                print("
                <a href='index.php'>Home</a>
                <a href='lista.php'>List</a>
                <a href='annonser.php'>Annonser</a>
                <a href='matain.php'>Mata in</a>
                <a href='radera.php'>Radera</a>
                <a href='ajax.php'>Ajax</a>
                <a href='logout.php'>Logga ut</a>");
             }
    }
    else{
        print("<section>Du är inte inloggad</section>");

        print("
        <a href='index.php'>Home</a>
        <a href='login.php'>Logga In</a>
        <a href='registrera.php'>Registrera dig</a>");
    }
?>
</nav>