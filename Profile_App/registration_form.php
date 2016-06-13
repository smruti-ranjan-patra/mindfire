<?php
$check = 0;
if (isset($_GET['id']))
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $temp = 0;

  $host = 'localhost';
  $userName = 'root';
  $password = 'mindfire';
  $dbName = 'registration';
  $conn = mysqli_connect($host,$userName,$password,$dbName);

  if (mysqli_connect_errno($conn))
  {
    die ('Failed to connect to MySQL :' . mysqli_connect_error());
  }

  $q_fetch = "SELECT emp.first_name AS f_name, emp.middle_name AS m_name, emp.last_name AS l_name, 
  emp.prefix AS prefix, emp.gender AS gender, emp.dob AS dob, emp.marital_status AS marital_status, 
  emp.employment AS employment, emp.employer AS employer, res.street AS r_street, 
  res.city AS r_city, res.state AS r_state, res.zip AS r_zip, res.phone AS r_phone, res.fax AS r_fax, 
  off.street AS o_street, off.city AS o_city, off.state AS o_state, off.zip AS o_zip, 
  off.phone AS o_phone, off.fax AS o_fax, emp.photo AS photo, emp.extra_note AS notes, 
  emp.comm_id AS comm_id 
  from employee AS emp 
  INNER JOIN address AS res ON (emp.id = res.emp_id AND res.address_type = 'residence')
  INNER JOIN address AS off ON (emp.id = off.emp_id AND off.address_type = 'office')
  where emp.id = ".$_GET['id'];

  $result = mysqli_query($conn, $q_fetch);

  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $com = explode(", ",$row['comm_id']);
  $length = count($com);
  $c1 = $c2 = $c3 = $c4 = 0;
  for($i = 0; $i < $length; $i++)
  {
    if(1 == $com[$i])
      $c1 = 1;
    if(2 == $com[$i])
      $c2 = 1;
    if(3 == $com[$i])
      $c3 = 1;
    if(4 == $com[$i])
      $c4 = 1;
  }
}
else
{
  $_GET['id'] = 0;
  $row['prefix'] = 'Mr';
  $row['gender'] = 'Male';
  $row['marital_status'] = 'Single';
  $row['employment'] = 'Employed';
}
?>

<!DOCTYPE html>

<html>
	<head>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/form.css">        
  	</head>
  <body>
    <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
              <form action="submit.php" method="post">      
                <h1>Registration Form</h1>

                <!-- Hidden Form to get the ID -->
                <input type="text" name="edit_id" hidden value="<?php
                if(isset($_GET['id']))
                    echo $_GET['id'];
                else
                    echo $temp;
                ?>">
                
                <fieldset>

                <!-- Names -->                  
                <div class="well">
                    <div class="row form-group">
	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	                       
	                        <label for="first_name">First Name:</label>
	                    </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
	                        <input type="text" name="first_name" id="first_name" 
                            class="form-control" required placeholder="First Name" value="<?php
                          echo $row['f_name'] ?>">	              
	                    </div>
                    </div>

                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                      
                            <label for="middle_mail">Middle Name:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <input type="text" name="middle_name" id="middle_name" 
                          class="form-control" placeholder="Middle Name" value="<?php
                          echo $row['m_name'] ?>">
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label for="last_name">Last Name:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <input type="text" name="last_name" id="last_name" 
                          class="form-control" placeholder="Last Name" value="<?php
                          echo $row['l_name'] ?>">                
                      </div>
                    </div>

                    <!-- Prefix -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                           <label>Prefix:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="prefix" id="prefix_1" 
                              value="Mr" <?php  if( 'Mr' == $row['prefix']) echo "checked" ?> >Mr
                            </label>
                          </div>
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="prefix" id="prefix_2" 
                              value="Ms" <?php  if( 'Ms' == $row['prefix']) echo "checked" ?> >Ms
                            </label>
                          </div>
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="prefix" id="prefix_3" 
                              value="Mrs" <?php  if( 'Mrs' == $row['prefix']) echo "checked" ?>> Mrs
                            </label>
                          </div>
                      </div>
                    </div>

                    <!-- Gender -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label>Gender:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="gender" id="gender_1" value="Male" 
                              <?php  if( 'Male' == $row['gender']) echo "checked" ?>>Male
                            </label>
                          </div>
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="gender" id="gender_2" value="Female" 
                              <?php  if( 'Female' == $row['gender']) echo "checked" ?>>Female
                            </label>
                          </div>
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="gender" id="gender_3" value="Others" 
                              <?php  if( 'Others' == $row['gender']) echo "checked" ?>>Others
                            </label>
                          </div>                    
                      </div>
                    </div>

                    <!-- Date of birth -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label for="dob">DOB:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <input type="date" class="form-control" name="dob" id="dob" 
                          value="<?php echo $row['dob'] ?>">                
                      </div>
                    </div>

                    <!-- Marital Status -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label for="marital">Marital Status:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="radio-inline">
                            <label>
                              <input type="radio" name="marital" id="marital_status_1" 
                              value="Single" <?php  if( 'Single' == $row['marital_status']) 
                              echo "checked"  ?>>Single
                            </label>
                          </div><div class="radio-inline">
                            <label>
                              <input type="radio" name="marital" id="marital_status_2" 
                              value="Married" <?php  if( 'Married' == $row['marital_status']) 
                              echo "checked"  ?>>Married
                            </label>
                          </div>
                      </div>
                    </div>

                    <!-- Employent -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label>Employent:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <div class="radio-inline">
                            <label>
                              <input type="radio" name="employment" id="employment_status_1" 
                              value="Employed" <?php  if( 'Employed' == $row['employment']) 
                              echo "checked"  ?>>Employed
                            </label>
                          </div><div class="radio-inline">
                            <label>
                              <input type="radio" name="employment" id="employment_status_2" 
                              value="Unemployed" <?php  if( 'Unemployed' == $row['employment']) 
                              echo "checked"  ?>>Unemployed
                            </label>
                          </div>
                      </div>
                    </div>

                    <!-- Employer -->
                    <div class="row form-group">
	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	                       
	                        <label for="employer">Employer:</label>
	                    </div>
	                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
	                        <input type="text" id="employer" name="employer" class="form-control" 
                            value="<?php echo $row['employer'] ?>" placeholder="Organization">	              
	                    </div>
                    </div>


                    <!-- Residence Address :- -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        
                        <h4><u>Residence Address :-</u></h4>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">                               
                                <label for="r_street">Street:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="r_street" name="r_street" 
                                class="form-control" value="<?php echo $row['r_street'] ?>" 
                                placeholder="Street">                      
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">                               
                                <label for="r_city">City:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="r_city" name="r_city" 
                                class="form-control" value="<?php echo $row['r_city'] ?>" 
                                placeholder="City">                      
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">                               
                                <label for="r_state">State:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select name="r_state" id="r_state" class="form-control">
                                   <option value="">Select State</option>
                                   <option value="Andaman and Nicobar Islands" 
                                   <?php  if( 'Andaman and Nicobar Islands' == $row['r_state']) 
                                   echo "selected" ?>>Andaman and Nicobar Islands</option>
                                   <option value="Andhra Pradesh" 
                                   <?php  if( 'Andhra Pradesh' == $row['r_state']) 
                                   echo "selected" ?>>Andhra Pradesh</option>
                                   <option value="Arunachal Pradesh" 
                                   <?php  if( 'Arunachal Pradesh' == $row['r_state']) 
                                   echo "selected" ?>>Arunachal Pradesh</option>
                                   <option value="Assam" 
                                   <?php  if( 'Assam' == $row['r_state']) 
                                   echo "selected" ?>>Assam</option>
                                   <option value="Bihar" 
                                   <?php  if( 'Bihar' == $row['r_state']) 
                                   echo "selected" ?>>Bihar</option>
                                   <option value="Chandigarh" 
                                   <?php  if( 'Chandigarh' == $row['r_state']) 
                                   echo "selected" ?>>Chandigarh</option>
                                   <option value="Chhattisgarh" 
                                   <?php  if( 'Chhattisgarh' == $row['r_state']) 
                                   echo "selected" ?>>Chhattisgarh</option>
                                   <option value="Dadra and Nagar Haveli" 
                                   <?php  if( 'Dadra and Nagar Haveli' == $row['r_state']) 
                                   echo "selected" ?>>Dadra and Nagar Haveli</option>
                                   <option value="Daman and Diu" 
                                   <?php  if( 'Daman and Diu' == $row['r_state']) 
                                   echo "selected" ?>>Daman and Diu</option>
                                   <option value="Delhi" 
                                   <?php  if( 'Delhi' == $row['r_state']) 
                                   echo "selected" ?>>Delhi</option>
                                   <option value="Goa" 
                                   <?php  if( 'Goa' == $row['r_state']) 
                                   echo "selected" ?>>Goa</option>
                                   <option value="Gujarat" 
                                   <?php  if( 'Gujarat' == $row['r_state']) 
                                   echo "selected" ?>>Gujarat</option>
                                   <option value="Haryana" 
                                   <?php  if( 'Haryana' == $row['r_state']) 
                                   echo "selected" ?>>Haryana</option>
                                   <option value="Himachal Pradesh" 
                                   <?php  if( 'Himachal Pradesh' == $row['r_state']) 
                                   echo "selected" ?>>Himachal Pradesh</option>
                                   <option value="Jammu and Kashmir" 
                                   <?php  if( 'Jammu and Kashmir' == $row['r_state']) 
                                   echo "selected" ?>>Jammu and Kashmir</option>
                                   <option value="Jharkhand" 
                                   <?php  if( 'Jharkhand' == $row['r_state']) 
                                   echo "selected" ?>>Jharkhand</option>
                                   <option value="Karnataka" 
                                   <?php  if( 'Karnataka' == $row['r_state']) 
                                   echo "selected" ?>>Karnataka</option>
                                   <option value="Kerala" 
                                   <?php  if( 'Kerala' == $row['r_state']) 
                                   echo "selected" ?>>Kerala</option>
                                   <option value="Lakshadweep" 
                                   <?php  if( 'Lakshadweep' == $row['r_state']) 
                                   echo "selected" ?>>Lakshadweep</option>
                                   <option value="Madhya Pradesh" 
                                   <?php  if( 'Madhya Pradesh' == $row['r_state']) 
                                   echo "selected" ?>>Madhya Pradesh</option>
                                   <option value="Maharashtra" 
                                   <?php  if( 'Maharashtra' == $row['r_state']) 
                                   echo "selected" ?>>Maharashtra</option>
                                   <option value="Manipur" 
                                   <?php  if( 'Manipur' == $row['r_state']) 
                                   echo "selected" ?>>Manipur</option>
                                   <option value="Meghalaya" 
                                   <?php  if( 'Meghalaya' == $row['r_state']) 
                                   echo "selected" ?>>Meghalaya</option>
                                   <option value="Mizoram" 
                                   <?php  if( 'Mizoram' == $row['r_state']) 
                                   echo "selected" ?>>Mizoram</option>
                                   <option value="Nagaland" 
                                   <?php  if( 'Nagaland' == $row['r_state']) 
                                   echo "selected" ?>>Nagaland</option>
                                   <option value="Odisha" 
                                   <?php  if( 'Odisha' == $row['r_state']) 
                                   echo "selected" ?>>Odisha</option>
                                   <option value="Pondicherry" 
                                   <?php  if( 'Pondicherry' == $row['r_state']) 
                                   echo "selected" ?>>Pondicherry</option>
                                   <option value="Punjab" 
                                   <?php  if( 'Punjab' == $row['r_state']) 
                                   echo "selected" ?>>Punjab</option>
                                   <option value="Rajasthan" 
                                   <?php  if( 'Rajasthan' == $row['r_state']) 
                                   echo "selected" ?>>Rajasthan</option>
                                   <option value="Sikkim" 
                                   <?php  if( 'Sikkim' == $row['r_state']) 
                                   echo "selected" ?>>Sikkim</option>
                                   <option value="Tamil Nadu" 
                                   <?php  if( 'Tamil Nadu' == $row['r_state']) 
                                   echo "selected" ?>>Tamil Nadu</option>
                                   <option value="Telangana" 
                                   <?php  if( 'Telangana' == $row['r_state']) 
                                   echo "selected" ?>>Telangana</option>
                                   <option value="Tripura" 
                                   <?php  if( 'Tripura' == $row['r_state']) 
                                   echo "selected" ?>>Tripura</option>
                                   <option value="Uttaranchal" 
                                   <?php  if( 'Uttaranchal' == $row['r_state']) 
                                   echo "selected" ?>>Uttaranchal</option>
                                   <option value="Uttar Pradesh" 
                                   <?php  if( 'Uttar Pradesh' == $row['r_state']) 
                                   echo "selected" ?>>Uttar Pradesh</option>
                                   <option value="West Bengal" 
                                   <?php  if( 'West Bengal' == $row['r_state']) 
                                   echo "selected" ?>>West Bengal</option>
                                </select>                
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                               
                                <label for="r_zip">Zip:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="r_zip" name="r_zip" class="form-control" 
                                value="<?php echo $row['r_zip'] ?>" placeholder="Zip code">
                      
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                               
                                <label for="r_phone">Phone:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="r_phone" name="r_phone" class="form-control" 
                                value="<?php echo $row['r_phone'] ?>" placeholder="09123456789">
                      
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                               
                                <label for="r_fax">Fax:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="r_fax" name="r_fax" class="form-control" 
                                value="<?php echo $row['r_fax'] ?>" placeholder="04442544302">                      
                            </div>
                          </div>
                      </div>


                      <!-- Office Address :- -->


                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                        <h4><u>Office Address :-</u></h4>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_street">Street:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="o_street" name="o_street" class="form-control"
                                value="<?php echo $row['o_street'] ?>" placeholder="Street">                      
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_city">City:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="o_city" name="o_city" class="form-control" 
                                value="<?php echo $row['o_city'] ?>" placeholder="City">                      
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_state">State:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select name="o_state" id="o_state" class="form-control">
                                   <option value="">Select State</option>
                                   <option value="Andaman and Nicobar Islands" 
                                   <?php  if( 'Andaman and Nicobar Islands' == $row['o_state']) 
                                   echo "selected" ?>>Andaman and Nicobar Islands</option>
                                   <option value="Andhra Pradesh" 
                                   <?php  if( 'Andhra Pradesh' == $row['o_state']) 
                                   echo "selected" ?>>Andhra Pradesh</option>
                                   <option value="Arunachal Pradesh" 
                                   <?php  if( 'Arunachal Pradesh' == $row['o_state']) 
                                   echo "selected" ?>>Arunachal Pradesh</option>
                                   <option value="Assam" 
                                   <?php  if( 'Assam' == $row['o_state']) 
                                   echo "selected" ?>>Assam</option>
                                   <option value="Bihar" 
                                   <?php  if( 'Bihar' == $row['o_state']) 
                                   echo "selected" ?>>Bihar</option>
                                   <option value="Chandigarh" 
                                   <?php  if( 'Chandigarh' == $row['o_state']) 
                                   echo "selected" ?>>Chandigarh</option>
                                   <option value="Chhattisgarh" 
                                   <?php  if( 'Chhattisgarh' == $row['o_state']) 
                                   echo "selected" ?>>Chhattisgarh</option>
                                   <option value="Dadra and Nagar Haveli" 
                                   <?php  if( 'Dadra and Nagar Haveli' == $row['o_state']) 
                                   echo "selected" ?>>Dadra and Nagar Haveli</option>
                                   <option value="Daman and Diu" 
                                   <?php  if( 'Daman and Diu' == $row['o_state']) 
                                   echo "selected" ?>>Daman and Diu</option>
                                   <option value="Delhi" 
                                   <?php  if( 'Delhi' == $row['o_state']) 
                                   echo "selected" ?>>Delhi</option>
                                   <option value="Goa" 
                                   <?php  if( 'Goa' == $row['o_state']) 
                                   echo "selected" ?>>Goa</option>
                                   <option value="Gujarat" 
                                   <?php  if( 'Gujarat' == $row['o_state']) 
                                   echo "selected" ?>>Gujarat</option>
                                   <option value="Haryana" 
                                   <?php  if( 'Haryana' == $row['o_state']) 
                                   echo "selected" ?>>Haryana</option>
                                   <option value="Himachal Pradesh" 
                                   <?php  if( 'Himachal Pradesh' == $row['o_state']) 
                                   echo "selected" ?>>Himachal Pradesh</option>
                                   <option value="Jammu and Kashmir" 
                                   <?php  if( 'Jammu and Kashmir' == $row['o_state']) 
                                   echo "selected" ?>>Jammu and Kashmir</option>
                                   <option value="Jharkhand" 
                                   <?php  if( 'Jharkhand' == $row['o_state']) 
                                   echo "selected" ?>>Jharkhand</option>
                                   <option value="Karnataka" 
                                   <?php  if( 'Karnataka' == $row['o_state']) 
                                   echo "selected" ?>>Karnataka</option>
                                   <option value="Kerala" 
                                   <?php  if( 'Kerala' == $row['o_state']) 
                                   echo "selected" ?>>Kerala</option>
                                   <option value="Lakshadweep" 
                                   <?php  if( 'Lakshadweep' == $row['o_state']) 
                                   echo "selected" ?>>Lakshadweep</option>
                                   <option value="Madhya Pradesh" 
                                   <?php  if( 'Madhya Pradesh' == $row['o_state']) 
                                   echo "selected" ?>>Madhya Pradesh</option>
                                   <option value="Maharashtra" 
                                   <?php  if( 'Maharashtra' == $row['o_state']) 
                                   echo "selected" ?>>Maharashtra</option>
                                   <option value="Manipur" 
                                   <?php  if( 'Manipur' == $row['o_state']) 
                                   echo "selected" ?>>Manipur</option>
                                   <option value="Meghalaya" 
                                   <?php  if( 'Meghalaya' == $row['o_state']) 
                                   echo "selected" ?>>Meghalaya</option>
                                   <option value="Mizoram" 
                                   <?php  if( 'Mizoram' == $row['o_state']) 
                                   echo "selected" ?>>Mizoram</option>
                                   <option value="Nagaland" 
                                   <?php  if( 'Nagaland' == $row['o_state']) 
                                   echo "selected" ?>>Nagaland</option>
                                   <option value="Odisha" 
                                   <?php  if( 'Odisha' == $row['o_state']) 
                                   echo "selected" ?>>Odisha</option>
                                   <option value="Pondicherry" 
                                   <?php  if( 'Pondicherry' == $row['o_state']) 
                                   echo "selected" ?>>Pondicherry</option>
                                   <option value="Punjab" 
                                   <?php  if( 'Punjab' == $row['o_state']) 
                                   echo "selected" ?>>Punjab</option>
                                   <option value="Rajasthan" 
                                   <?php  if( 'Rajasthan' == $row['o_state']) 
                                   echo "selected" ?>>Rajasthan</option>
                                   <option value="Sikkim" 
                                   <?php  if( 'Sikkim' == $row['o_state']) 
                                   echo "selected" ?>>Sikkim</option>
                                   <option value="Tamil Nadu" 
                                   <?php  if( 'Tamil Nadu' == $row['o_state']) 
                                   echo "selected" ?>>Tamil Nadu</option>
                                   <option value="Telangana" 
                                   <?php  if( 'Telangana' == $row['o_state']) 
                                   echo "selected" ?>>Telangana</option>
                                   <option value="Tripura" 
                                   <?php  if( 'Tripura' == $row['o_state']) 
                                   echo "selected" ?>>Tripura</option>
                                   <option value="Uttaranchal" 
                                   <?php  if( 'Uttaranchal' == $row['o_state']) 
                                   echo "selected" ?>>Uttaranchal</option>
                                   <option value="Uttar Pradesh" 
                                   <?php  if( 'Uttar Pradesh' == $row['o_state']) 
                                   echo "selected" ?>>Uttar Pradesh</option>
                                   <option value="West Bengal" 
                                   <?php  if( 'West Bengal' == $row['o_state']) 
                                   echo "selected" ?>>West Bengal</option>

                                </select>                
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_zip">Zip:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="o_zip" name="o_zip" class="form-control"
                                value="<?php echo $row['o_zip'] ?>" placeholder="Zip code">                      
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_phone">Phone:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="o_phone" name="o_phone" class="form-control" 
                                value="<?php echo $row['o_phone'] ?>" placeholder="09123456789">                      
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 
                            col-md-offset-1 col-lg-offset-1">                               
                                <label for="o_fax">Fax:</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" id="o_fax" name="o_fax" class="form-control" 
                                value="<?php echo $row['o_fax'] ?>" placeholder="04442544302">                      
                            </div>
                          </div>                        
                      </div>
                    </div>

                    <!-- Personal Info :- -->                    
                    <h4><u>Personal Info :-</u></h4>
                    <div class="row">
                    	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	                       
	                        <label for="pic">Photo:</label>
	                    </div> 
	                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8"> 	
	                        <input type="file" id="pic" name="pic" required value=<?php
                          echo $row['photo'] ?> accept="image/*">
	                    </div>                  	
                    </div>              
					         <br>
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                         
                           <label for="notes">Extra Notes:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <textarea class="form-control" id="notes" name="notes" rows="10" value=<?php
                          echo $row['notes'] ?> placeholder="Notes"></textarea>
                      </div>
	                </div>
                  <br>

                  <!-- Preferred Communicatio -->
	                <div class="row form-group">
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                             
                               <label>Preferred communication medium:</label>
                          </div>
                          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_mail" name="comm[]" value="1" 
                                    <?php if($c1) echo "checked" ?>>
                                    <label for="comm_mail">Mail</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_message" name="comm[]" value="2" 
                                    <?php if($c2) echo "checked" ?>>
                                    <label for="comm_message">Message</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_phone" name="comm[]" value="3" 
                                    <?php if($c3) echo "checked" ?>>
                                    <label for="comm_phone">Phone Call</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_any" name="comm[]" value="4" 
                                    <?php if($c4) echo "checked" ?>>
                                    <label for="comm_any">Any</label>
                                </div>                         
                          </div>
                    </div>  
                </div>
                </fieldset>

                <!-- Buttons -->
                <div class="row form-group text-center">
                    <button class="btn btn-primary"  type="submit" name="submit" value="submit">
                    Submit</button>
          			<button class="btn btn-danger" type="reset" name="reset" value="reset">
                    Reset</button>
                <a href="display.php"><input type="button" class="btn btn-info" value="Display"></a>
                </div>                
              </form>
          </div>
        </div>
    </div>    
	</body>
</html>