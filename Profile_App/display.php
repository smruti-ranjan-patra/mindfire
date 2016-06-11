<!DOCTYPE html>
<html>
<head>
	<title>Display Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<?php

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$host = 'localhost';
		$userName = 'root';
		$password = 'mindfire';
		$dbName = 'registration';
		$conn = mysqli_connect($host,$userName,$password,$dbName);

		if (mysqli_connect_errno($conn))
		{
			die ('Failed to connect to MySQL :' . mysqli_connect_error());
		}
		
		$q_fetch = "SELECT emp.prefix AS prefix, CONCAT(emp.first_name,' ', emp.middle_name,' ', emp.last_name) AS name, 
		emp.gender AS gender, emp.dob AS dob, emp.marital_status AS marital_status, emp.employment AS employment, 
		emp.employer AS employer,  
		CONCAT(res.street, ', ', res.city, ', ', res.state, ', ', res.zip, ', ', res.phone, ', ', res.fax) AS res_add, 
		CONCAT(off.street, ', ', off.city, ', ', off.state, ', ', off.zip, ', ', off.phone, ', ', off.fax) AS off_add, 
		emp.comm_id AS comm_id, emp.id
		from employee AS emp 
		inner join address AS res on (emp.id = res.emp_id and res.address_type = 'residence')
		inner join address AS off on (emp.id = off.emp_id and off.address_type = 'office')";

		$result_3 = mysqli_query($conn, $q_fetch);

		$rnum = mysqli_num_rows($result_3);
		?>
		<h1><u>Employee Details :-</u></h1>
		<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Sl</th>
					<th>Prefix</th>
					<th>Name</th>
					<th>Gender</th>
					<th>DOB</th>
					<th>Marital</th>
					<th>Employment</th>
					<th>Employer</th>
					<th>Residence</th>
					<th>Office</th>
					<th>Communication</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 1;
				while ($row = mysqli_fetch_array($result_3, MYSQLI_ASSOC))
				{					
					echo "<tr>";
					echo "<td>".$i++."</td>";					
					foreach ($row as $key => $value) 
					{
						if('comm_id' == $key)
						{
							$q_comm = "SELECT GROUP_CONCAT(type SEPARATOR ', ') FROM `communication_medium` WHERE id IN ($value)";
							$result_4 = mysqli_query($conn, $q_comm);
							while ($row1 = mysqli_fetch_array($result_4, MYSQLI_ASSOC))
							{
								foreach ($row1 as $key => $value) 
								{
									echo "<td>".$value."</td>";
								}
							}
						}
						elseif('dob' == $key)
						{
							echo "<td>".date("d/m/Y", strtotime($value))."</td>";
						}
						elseif('id' != $key)
						{
							echo "<td>".$value."</td>";
						}
					}
					echo "</tr>";
				}
			?>				
			</tbody>
		</table>
	</div>
	<form action = "registration_form.html" method = "post">
	<button class="btn btn-primary"  type="submit" value="submit">Go to form</button>
	</form>
</body>
</html>	
