<?php
include("handyfunctions.php");
$conn = create_conn();
$data = "";
if (isset($_POST['annonser'])) {
    $data = ($_POST['annonser']);
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border = 1>
                <thead>
                <tr>
                <th>ID</th>
                <th>Säljare</th>
                <th>Rubrik</th>
                <th>Beskrivning</th>
                <th>Pris €</th>
                <th>Uppladdad</th>";
                if ($_SESSION['roll'] == 'admin'){
                    echo "<th>Radera</th>
                    <th>Editera</th>
                    </tr>
                    </thead>";
                } elseif ($_SESSION['roll'] == 'editor'){
                    echo "<th>Radera</th>
                    <th>Editera</th>
                    </tr>
                    </thead>";
                }

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $saljare = $row['saljare'];
                    $rubrik = $row['rubrik'];
                    $beskrivning = $row['beskrivning'];
                    $pris = $row['pris'];
                    $uppladdad = date("d.m.Y H:i:s", strtotime($row['datum']));
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>".$id."</td>";
                    echo "<td>".$saljare."</td>";
                    echo "<td>".$rubrik."</td>";
                    echo "<td>".$beskrivning."</td>";
                    echo "<td>".$pris." €</td>";
                    echo "<td>".$uppladdad."</td>";
                    if ($_SESSION['roll'] == 'admin'){
                    echo "<td>"."<button class='delete' id='del_$id' data-id='$id'>Radera</button>"."</td>";
                    echo "<form action=updatetest.php method=POST>";
                    echo "<input type=hidden name=id value=$id>";
                    echo "<input type=hidden name=rubrik value=$rubrik>";
                    echo "<input type=hidden name=beskrivning value=$beskrivning>";
                    echo "<input type=hidden name=pris value=$pris>";
                    echo "<td>"."<button class='update'>Uppdatera</button>"."</td>";
                    echo "</form>";
                    } elseif ($_SESSION['roll'] == 'editor'){
                    echo "<form action=uppdatera.php method=POST>";
                    echo "<input type=hidden name=id value=$id>";
                    echo "<input type=hidden name=rubrik value=$rubrik>";
                    echo "<input type=hidden name=beskrivning value=$beskrivning>";
                    echo "<input type=hidden name=pris value=$pris>";
                    echo "<td>"."<button class='update'>Uppdatera</button>"."</td>";
                    echo "</form>";
                    }
                    echo "</tr>";
                    echo "</tbody>";
                }
            echo "</table>";
        } else {
        print('Data Not Found');
    }
}
?>

