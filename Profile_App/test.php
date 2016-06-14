<?php
include('states.php');
//print_r($state_list) ;
function check_states($st)
{	//echo "ehllo";
	foreach($st as $value)
	{?>
	    <option value="<?php echo $value; ?>">
        <?php echo $value ?></option>
        <?php
	}
}
?>
<!--  foreach($state_list as $value)
 	{
 	    echo $value."<br>";
 	} -->


<!DOCTYPE html>
<html>
<head>
	<title>ha ha</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div>
    <select name="r_state" id="r_state">
       <option value="">Select State</option>
       <option value="lol">Hello</option>
       <?php check_states($state_list); ?>        
    </select>                
</div>

</body>
</html>



