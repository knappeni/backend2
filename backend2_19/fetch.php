<?php
include("handyfunctions.php");
$conn = create_conn();
$output = '';
if (!empty($_POST["query"])) {
	$search = test_input($_POST["query"]);
	$sql = "SELECT * FROM users WHERE namn LIKE '%".$search."%' OR epost LIKE '%".$search."%';";
} else {
	$sql = "SELECT * FROM users";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Användare</th>
							<th>Epost</th>
							<th>Rubrik</th>
							<th>Beskrivning</th>
							<th>Pris</th>
						</tr>';
	while ($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM loppis WHERE saljare='".$row['namn']."';";
		#$sql1 = "SELECT * FROM loppis;";
		$rows = $conn->query($sql1);
		$test = $rows->fetch_assoc();
		print($test);
		#print($test['rubrik']);
		
		$output .= "
			<tr>
				<td><a href='annonser.php?user=".$row['namn']."'>".$row['namn']."</a></td>
				<td>".$row['epost']."</td>
				<td>".$test['rubrik']."</td>
				<td>".$test['beskrivning']."</td>
				<td>".$test['pris']."</td>
			</tr>
		";
	}
	print($output);
} else {
	print('Data Not Found');
}
?>