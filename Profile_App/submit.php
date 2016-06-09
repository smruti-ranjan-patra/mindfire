<!DOCTYPE html>
<html>
<head>
	<title>Submit Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>

	<div class="container">
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
    </div>
</body>
</html>
