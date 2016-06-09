<?php
// echo "Successfully Submitted";
// echo '<pre>';

// print_r($_POST);
echo "<h1><u>Details  :-</u></h1><br>";

echo 'First Name : ' . $_POST['first_name']."<br>";
echo 'Middle Name : ' . $_POST['middle_name']."<br>";
echo 'Last Name : ' . $_POST['last_name']."<br>";
echo 'prefix : ' . $_POST['prefix']."<br>";
echo 'Gender : ' . $_POST['gender']."<br>";
echo 'Date of Birth : ' . $_POST['dob']."<br>";
echo 'Marital Status : ' . $_POST['marital']."<br>";
echo 'Employment Status: ' . $_POST['employment']."<br>";
echo 'Employer : ' . $_POST['employer']."<br>";

echo "<h3><u>Residence Address  :-</u></h3><br>";

echo 'Street : ' . $_POST['r_street']."<br>";
echo 'City : ' . $_POST['r_city']."<br>";
echo 'State : ' . $_POST['r_state']."<br>";
echo 'Zip : ' . $_POST['r_zip']."<br>";
echo 'Phone : ' . $_POST['r_phone']."<br>";
echo 'Fax : ' . $_POST['r_fax']."<br>";

echo "<h3><u>Office  :-</u></h3><br>";

echo 'Street : ' . $_POST['o_street']."<br>";
echo 'City : ' . $_POST['o_city']."<br>";
echo 'State : ' . $_POST['o_state']."<br>";
echo 'Zip : ' . $_POST['o_zip']."<br>";
echo 'Phone : ' . $_POST['o_phone']."<br>";
echo 'Fax : ' . $_POST['o_fax']."<br>";

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
