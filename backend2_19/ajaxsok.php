<?php 

include("handyfunctions.php");
$conn = create_conn();
$query = test_input($_GET['query']);
$sql = "SELECT * FROM users WHERE namn='$query';";
$result = $conn-> query($sql);
if($result->num_rows>0){
    $row = $result->fetch_assoc();
    print("<p>Användarnamn: ".$row['namn']."<br>
            Epost: ".$row['epost']."<br>
            Roll: ".$row['roll']."<br></p>");
    
}
else{
    print("<p>SQL queryn returnerade 0 rader</p>");
}
$conn->close();
?>