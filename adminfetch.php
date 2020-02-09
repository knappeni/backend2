<?php
include("handyfunctions.php");
$conn = create_conn();
$output = '';
$data = "";
if (isset($_POST['annonser'])) {
    $data = ($_POST['annonser']);
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $output .= '
        <table border = 1>
        <thead>
        <tr>
        <th>ID</th>
        <th>Säljare</th>
        <th>Rubrik</th>
        <th>Beskrivning</th>
        <th>Pris</th>
        <th>Uppladdad</th>
        </tr>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $saljare = $row['saljare'];
            $rubrik = $row['rubrik'];
            $beskrivning = $row['beskrivning'];
            $pris = $row['pris'];
            $uppladdad = date("d.m.Y H:i:s", strtotime($row['datum']));
            
            #$test = $rows->fetch_assoc();
            $output .= "
                <tbody>
                <tr>
                <td>".$id."</td>
                <td>".$saljare."</td>
                <td>".$rubrik."</td>
                <td>".$beskrivning."</td>
                <td>".$pris."</td>
                <td>".$uppladdad."</td>
                </tr>";
        }
        print($output);
    } else {
        print('Data Not Found');
    }
} else if (isset($_POST['users'])) {
    $data = ($_POST['users']);
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $output .= '
        <table border = 1>
        <thead>
        <tr>
        <th>ID</th>
        <th>Namn</th>
        <th>Epost</th>
        <th>Roll</th>
        <th>Status</th>
        <th>Registrerad</th>
        </tr>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $namn = $row['namn'];
            $epost = $row['epost'];
            $roll = $row['roll'];
            $status = $row['status'];
            $datum = date("d.m.Y H:i:s", strtotime($row['datum']));
            
            #$test = $rows->fetch_assoc();
            $output .= "
                <tbody>
                <tr>
                <td>".$id."</td>
                <td>".$namn."</td>
                <td>".$epost."</td>
                <td>".$roll."</td>
                <td>".$status."</td>
                <td>".$datum."</td>
                </tr>";
        }
        print($output);
    } else {
        print('Data Not Found');
    }
}
    #if ($data == "users") {
    #}
?>

