<!DOCTYPE html>
<html>
<head>
	<title>Submit Page</title>
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
		
		$f_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
		$m_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : '';
		$l_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
		$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : '';
		$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
		$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
		$marital = isset($_POST['marital']) ? $_POST['marital'] : '';
		$employment = isset($_POST['employment']) ? $_POST['employment'] : '';
		$employer = isset($_POST['employer']) ? $_POST['employer'] : '';
		$r_street = isset($_POST['r_street']) ? $_POST['r_street'] : '';
		$r_city = isset($_POST['r_city'])? $_POST['r_city'] : '';
		$r_state = isset($_POST['r_state']) ? $_POST['r_state'] : '';
		$r_zip = isset($_POST['r_zip'])?$_POST['r_zip'] : '';
		$r_phone = isset($_POST['r_phone']) ? $_POST['r_phone'] : '';
		$r_fax = isset($_POST['r_fax']) ? $_POST['r_fax'] : '';
		$o_street = isset($_POST['o_street']) ? $_POST['o_street'] : '';
		$o_city = isset($_POST['o_city']) ? $_POST['o_city'] : '';
		$o_state = isset($_POST['o_state']) ? $_POST['o_state'] : '';
		$o_zip = isset($_POST['o_zip']) ? $_POST['o_zip'] : '';
		$o_phone = isset($_POST['o_phone']) ? $_POST['o_phone'] : '';
		$o_fax = isset($_POST['o_fax']) ? $_POST['o_fax'] : '';
		$pic = isset($_POST['pic']) ? $_POST['pic'] : '';
		$notes = isset($_POST['notes']) ? $_POST['notes'] : '';
		$comm = (isset($_POST['comm']) && !empty($_POST['comm'])) ? implode(', ', $_POST['comm']) : '';

		$q_employee = "INSERT INTO employee(first_name, middle_name, last_name, prefix, gender, dob, marital_status, employment, employer, photo, extra_note, comm_id) VALUES ('$f_name', '$m_name', '$l_name', '$prefix', '$gender', '$dob', '$marital', '$employment', '$employer', '$pic', '$notes', '$comm')";

		$result_1 = mysqli_query($conn, $q_employee);

		if (TRUE === $result_1) {

			$employee_id = mysqli_insert_id($conn);

			$q_address = "INSERT INTO `address`(`emp_id`, `address_type`, `street`, `city`, `state`, `zip`, `phone`, `fax`) VALUES 
				($employee_id,'residence','$r_street','$r_city','$r_state','$r_zip','$r_phone','$r_fax'), 
				($employee_id,'office','$o_street','$o_city','$o_state','$o_zip','$o_phone','$o_fax')";

			$result_2 = mysqli_query($conn, $q_address);

		} 
		else {
			echo 'Not inserting'; exit;
		}


		$q_fetch = "SELECT CONCAT(emp.first_name,'',emp.middle_name,'',emp.last_name) AS name, emp.prefix, 
			   emp.gender, emp.dob, emp.marital_status, emp.employment, 
			   emp.employer, emp.comm_id, group_concat(addr.address_type), group_concat(addr.street), group_concat(addr.city),
			   group_concat(addr.state), group_concat(addr.zip), group_concat(addr.phone), group_concat(addr.fax)  
		    FROM employee AS emp
		    INNER JOIN address AS addr
		    ON emp.id = addr.emp_id
		    group by emp.id
		    order by emp.id";

		$result_3 = mysqli_query($conn, $q_fetch);

		$rnum = mysqli_num_rows($result_3);
		?>
		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Prefix</th>
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


				while ($row = mysqli_fetch_array($result_3, MYSQLI_ASSOC)){
					echo '<pre>'; print_r($row);
					//echo '<br>';
					echo "<tr>";
					foreach ($row as $key => $value) {
						//print_r($value);
						
						echo "<td>".$key."==".$value."</>";

						//echo $key . '----' . $value;
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

		




















	<!-- <div class="container">
		<h1><u>Details  :-</u></h1>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
          	<div class="well">
                    <div class="row form-group">
	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
	                    	<?php

	                    	echo "<h3><u>General Details :-</u></h3><br>";
							echo 'First Name : ' . $_POST['first_name']."<br>";
							echo 'Middle Name : ' . $_POST['middle_name']."<br>";
							echo 'Last Name : ' . $_POST['last_name']."<br>";
							echo 'prefix : ' . $_POST['prefix']."<br>";
							echo 'Gender : ' . $_POST['gender']."<br>";
							echo 'Date of Birth : ' . $_POST['dob']."<br>";
							echo 'Marital Status : ' . $_POST['marital']."<br>";
							echo 'Employment Status: ' . $_POST['employment']."<br>";
							echo 'Employer : ' . $_POST['employer']."<br>";

	                    	?>
	                    </div>

	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
	                    	<?php

	                    	echo "<h3><u>Residence Address  :-</u></h3><br>";
							echo 'Street : ' . $_POST['r_street']."<br>";
							echo 'City : ' . $_POST['r_city']."<br>";
							echo 'State : ' . $_POST['r_state']."<br>";
							echo 'Zip : ' . $_POST['r_zip']."<br>";
							echo 'Phone : ' . $_POST['r_phone']."<br>";
							echo 'Fax : ' . $_POST['r_fax']."<br>";

	                    	?>
	                    </div>

	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
	                    	<?php

	                    	echo "<h3><u>Office Address :-</u></h3><br>";
							echo 'Street : ' . $_POST['o_street']."<br>";
							echo 'City : ' . $_POST['o_city']."<br>";
							echo 'State : ' . $_POST['o_state']."<br>";
							echo 'Zip : ' . $_POST['o_zip']."<br>";
							echo 'Phone : ' . $_POST['o_phone']."<br>";
							echo 'Fax : ' . $_POST['o_fax']."<br>";

	                    	?>
	                    </div>
	                </div>

	                <div class="row form-group">
	                    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11 col-md-offset-1 col-lg-offset-1">

	                    	<?php

	                    		echo "<h3><u>Personal Info  :-</u></h3><br>";
								echo 'Picture : ' . $_POST['pic']."<br>";
								echo 'Notes : ' . $_POST['notes']."<br>";

								 if (isset($_POST['comm']))
								 {
								 	echo 'Communication : ' . implode(', ', $_POST['comm'])."<br>";
								 }
								 else
								 	echo 'Please provide communication medium';

	                    	?>

	                    </div>
                    </div>
            </div>        	
          </div>
        </div>
    </div> -->


</body>
</html>
