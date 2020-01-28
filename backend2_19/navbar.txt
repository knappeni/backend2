
<?php
    if(isset($_SESSION['username'])){
            print("<section>
                    Hejsan: ".$_SESSION['username']."<br>
                    Du har rollen: ".$_SESSION['roll']."
            </section>");
            //inloggad user
            if($_SESSION['roll'] == 'user'){
                print("<ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='lista.php'>List</a></li>
                <li><a href='annonser.php'>Annonser</a></li>  
                <li><a href='matain.php'>Mata in</a></li>
                <li><a href='ajax.php'>Ajax</a></li>
                <li><a href='logout.php'>Logga ut</a></li>
            </ul>");
            }
            //inloggad editor
            else if($_SESSION['roll'] == 'editor'){
                print("<ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='lista.php'>List</a></li>
                <li><a href='annonser.php'>Annonser</a></li>  
                <li><a href='matain.php'>Mata in</a></li>
                <li><a href='ajax.php'>Ajax</a></li>
                <li><a href='logout.php'>Logga ut</a></li>
            </ul>");

              }
            //inloggad admin
            else if($_SESSION['roll'] == 'admin'){
                print("<ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='lista.php'>List</a></li>
                <li><a href='annonser.php'>Annonser</a></li>  
                <li><a href='matain.php'>Mata in</a></li>
                <li><a href='radera.php'>Radera</a></li>          
                <li><a href='ajax.php'>Ajax</a></li>
                <li><a href='logout.php'>Logga ut</a></li>
            </ul>");

                  }
    }
    else{
        print("<section>Du är inte inloggad</section>");

        print("<ul>
        <li><a href='index.php'>Home</a></li>
        <li><a href='login.php'>Logga In</a></li>
        <li><a href='registrera.php'>Registrera dig</a></li>
    </ul>");
    }
?>