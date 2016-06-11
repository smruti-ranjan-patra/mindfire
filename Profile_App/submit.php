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

		if(isset($_POST['submit']))
		{
			$count = 0;

			// Validating first name

			if(isset($_POST['first_name']) && !empty($_POST['first_name']))
			{
				$f_name = formatted($_POST['first_name']);
			}
			else
			{
				echo 'Please give a valid First Name';
				echo "<br>";
				$count++;
			}

			// Validating middle name

			if(isset($_POST['middle_name']) && !empty($_POST['middle_name']))
			{
				$m_name = formatted($_POST['middle_name']);
			}
			else
			{
				echo 'Please give a valid Middle Name';
				echo "<br>";
				$count++;
			}

			// Validating last name

			if(isset($_POST['last_name']) && !empty($_POST['last_name']))
			{
				$l_name = formatted($_POST['last_name']);
			}
			else
			{
				echo 'Please give a valid Last Name';
				echo "<br>";
				$count++;
			}

			// Validating prefix

			if(isset($_POST['prefix']))
			{
				$prefix = $_POST['prefix'];
			}
			else
			{
				$count++;
			}
			// Validating gender

			if(isset($_POST['gender']))
			{
				$gender = $_POST['gender'];
			}
			else
			{
				$count++;
			}

			// Validating date of birth

			if(isset($_POST['dob']))
			{
				$dob = $_POST['dob'];
			}
			else
			{
				$count++;
			}

			// Validating marital status

			if(isset($_POST['marital']))
			{
				$marital = $_POST['marital'];
			}
			else
			{
				$count++;
			}

			// Validating employment status

			if(isset($_POST['employment']))
			{
				$employment = $_POST['employment'];
			}
			else
			{
				$count++;
			}

			// Validating employer

			if(isset($_POST['employer']) && !empty($_POST['employer']))
			{
				$employer = formatted($_POST['employer']);
			}
			else
			{
				echo 'Please give a valid Employer Name';
				echo "<br>";
				$count++;
			}

			// Validating residence street

			if(isset($_POST['r_street']) && !empty($_POST['r_street']))
			{
				$r_street = formatted($_POST['r_street']);
			}
			else
			{
				echo 'Please give a valid residence Street';
				echo "<br>";
				$count++;
			}

			// Validating residence city

			if(isset($_POST['r_city']) && !empty($_POST['r_city']))
			{
				$r_city = formatted($_POST['r_city']);
			}
			else
			{
				echo 'Please give a valid residence City';
				echo "<br>";
				$count++;
			}

			// Validating residence state

			if(isset($_POST['r_state']) && !empty($_POST['r_state']))
			{
				$r_state = formatted($_POST['r_state']);
			}
			else
			{
				echo 'Please give a valid residence State';
				echo "<br>";
				$count++;
			}

			// Validating residence zip

			if(isset($_POST['r_zip']) && !empty($_POST['r_zip']))
			{
				$r_zip = formatted($_POST['r_zip']);
				if(!ctype_digit($r_zip))
				{
					echo 'Please give a valid residence Zip';
					echo "<br>";
					$count++;
				}
			}

			// Validating residence phone

			if(isset($_POST['r_phone']) && !empty($_POST['r_phone']))
			{
				$r_phone = formatted($_POST['r_phone']);
				if(!ctype_digit($r_phone))
				{
					echo 'Please give a valid residence Phone';
					echo "<br>";
					$count++;
				}
			}

			// Validating residence fax

			if(isset($_POST['r_fax']) && !empty($_POST['r_fax']))
			{
				$r_fax = formatted($_POST['r_fax']);
				if(!ctype_digit($r_fax))
				{
					echo 'Please give a valid residence Fax';
					echo "<br>";
					$count++;
				}
			}

			// Validating office street

			if(isset($_POST['o_street']) && !empty($_POST['o_street']))
			{
				$o_street = formatted($_POST['o_street']);
			}
			else
			{
				echo 'Please give a valid office Street';
				echo "<br>";
				$count++;
			}

			// Validating office city

			if(isset($_POST['o_city']) && !empty($_POST['o_city']))
			{
				$o_city = formatted($_POST['o_city']);
			}
			else
			{
				echo 'Please give a valid office City';
				echo "<br>";
				$count++;
			}

			// Validating office state

			if(isset($_POST['o_state']) && !empty($_POST['o_state']))
			{
				$o_state = formatted($_POST['o_state']);
			}
			else
			{
				echo 'Please give a valid office State';
				echo "<br>";
				$count++;
			}

			// Validating office zip

			if(isset($_POST['o_zip']) && !empty($_POST['o_zip']))
			{
				$o_zip = formatted($_POST['o_zip']);
				if(!ctype_digit($o_zip))
				{
					echo 'Please give a valid office Zip';
					echo "<br>";
					$count++;
				}
			}

			// Validating office phone

			if(isset($_POST['o_phone']) && !empty($_POST['o_phone']))
			{
				$o_phone = formatted($_POST['o_phone']);
				if(!ctype_digit($o_phone))
				{
					echo 'Please give a valid office Phone';
					echo "<br>";
					$count++;
				}
			}

			// Validating office fax

			if(isset($_POST['o_fax']) && !empty($_POST['o_fax']))
			{
				$o_fax = formatted($_POST['o_fax']);
				if(!ctype_digit($o_fax))
				{
					echo 'Please give a valid office Fax';
					echo "<br>";
					$count++;
				}
			}

			// Validating Picture

			if(isset($_POST['pic']) && !empty($_POST['pic']))
			{
				$pic = formatted($_POST['pic']);

			}
			else
			{
				echo 'Please give a valid Photo';
				echo "<br>";
				$count++;
			}
			
			// Validating Notes

			if(isset($_POST['notes']))
			{
				$notes = formatted($_POST['notes']);
			}
			else
			{
				$notes = ' ';
			}

			// Validating Communication Medium

			if(isset($_POST['comm']) && !empty($_POST['comm']))
			{
				$comm = implode(', ', $_POST['comm']);
			}
			else
			{
				echo 'Please give at least one Communication Medium';
				echo "<br>";
				$count++;
			}

			if($count > 0)
			{
				exit;
			}

			$q_employee = "INSERT INTO employee(first_name, middle_name, last_name, prefix, gender, dob, marital_status, employment, employer, photo, extra_note, comm_id) VALUES ('$f_name', '$m_name', '$l_name', '$prefix', '$gender', '$dob', '$marital', '$employment', '$employer', '$pic', '$notes', '$comm')";

			$result_1 = mysqli_query($conn, $q_employee);

			if (TRUE === $result_1) {

				$employee_id = mysqli_insert_id($conn);

				$q_address = "INSERT INTO `address`(`emp_id`, `address_type`, `street`, `city`, `state`, `zip`, `phone`, `fax`) VALUES 
					($employee_id,'residence','$r_street','$r_city','$r_state','$r_zip','$r_phone','$r_fax'), 
					($employee_id,'office','$o_street','$o_city','$o_state','$o_zip','$o_phone','$o_fax')";

				$result_2 = mysqli_query($conn, $q_address);
			} 
			else
			{
				echo 'Not inserting'; 
				exit;
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
		}
		else
		{
			exit;
		}
		function formatted($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
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