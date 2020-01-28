<?php
include("handyfunctions.php");
$conn = create_conn();
$output = '';
if(!empty($_POST["query"]))
{
	$search = test_input($_POST["query"]);
	$sql = "SELECT * FROM users WHERE namn LIKE '%".$search."%' OR epost LIKE '%".$search."%';";
}
else
{
	$sql = "SELECT * FROM users";
}
$result=$conn->query($sql);
if($result->num_rows > 0)
{
	
	
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Namn</th>
							<th>Epost</th>
                            <th>Registreringsdatum</th>
							<th>Roll</th>
							<th>Antal annoser</th>
						</tr>';
	while($row = $result->fetch_assoc())
	{
		$sql1 = "SELECT * FROM loppis WHERE saljare='".$row['namn']."';";
		$rows = $conn->query($sql1);
		$output .= "
			<tr>
				<td><a href='annonser.php?user=".$row['namn']."'>".$row['namn']."</a></td>
				<td>".$row['epost']."</td>
				<td>".$row['datum']."</td>
				<td>".$row['roll']."</td>
				<td>".$rows->num_rows."</td>
			</tr>
		";
	}
	print($output);
}
else
{
	print('Data Not Found');
}

?>