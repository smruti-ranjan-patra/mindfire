<?php
$check_pic = 0;
include('states.php');
include('photo_path.php');
function check_states($st_list, $data)
{
    foreach($st_list as $value)
    {
      ?>
        <option <?php if ($value == $data): ?>selected<?php endif ?> value =<?php echo $value ?> >
        <?php echo $value ?>
        </option>
        <?php
    }
}

if (isset($_GET['id']))
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $check_pic = 1;

  include('db_connection.php');

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
  $comm1 = $comm2 = $comm3 = $comm4 = 0;
  for($i = 0; $i < $length; $i++)
  {
    if(1 == $com[$i])
      $comm1 = 1;
    if(2 == $com[$i])
      $comm2 = 1;
    if(3 == $com[$i])
      $comm3 = 1;
    if(4 == $com[$i])
      $comm4 = 1;
  }
}
else
{
  $_GET['id'] = 0;
  $row['prefix'] = 'Mr';
  $row['gender'] = 'Male';
  $row['marital_status'] = 'Single';
  $row['employment'] = 'Employed';
  $row['photo'] = '';
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
            <form action="submit.php" method="post" enctype=multipart/form-data>
            	<?php
            	if($_GET['id'])
            		echo "<h1>Submit Form</h1>";
            	else
            		echo "<h1>Registration Form</h1>";
            	?>

                <!-- Hidden Form to get the ID -->
                <input type="text" name="edit_id" hidden value="<?php
                if(isset($_GET['id']))
                    echo $_GET['id'];
                else
                    echo 0;
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
                                   <?php check_states($state_list, $row['r_state']) ?>
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
                                <select name="o_state" id="r_state" class="form-control">
                                   <option value="">Select State</option>
                                   <?php check_states($state_list,  $row['o_state']) ?>
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
                    <!-- Photo -->
                    <h4><u>Personal Info :-</u></h4>
                    <div class="row">
                    	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	                        <label for="pic">Photo:</label>
	                    </div>
	                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8"> 
	                        <input type="file" id="pic" name="pic" value="<?php echo $row['photo'] ?>">
                            <span><?php
                            if(1 == $check_pic)
                            {
                              echo "<img src=".PIC_PATH.$row['photo']." width=200 height=200>";
                            }
                            ?></span>
	                    </div>
                    </div>
                    <br>

                    <!-- Extra Notes -->
                    <div class="row form-group">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">                         
                           <label for="notes">Extra Notes:</label>
                      </div>
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                          <textarea class="form-control" id="notes" name="notes" rows="10" placeholder="Notes"><?php
                          echo $row['notes'] ?></textarea>
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
                                    <?php if($comm1) echo "checked" ?>>
                                    <label for="comm_mail">Mail</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_message" name="comm[]" value="2" 
                                    <?php if($comm2) echo "checked" ?>>
                                    <label for="comm_message">Message</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_phone" name="comm[]" value="3" 
                                    <?php if($comm3) echo "checked" ?>>
                                    <label for="comm_phone">Phone Call</label>
                                </div>
                                <div class="checkbox-inline">
                                    <input type="checkbox" id="comm_any" name="comm[]" value="4" 
                                    <?php if($comm4) echo "checked" ?>>
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