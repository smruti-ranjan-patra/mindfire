<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$host = 'localhost';
	$userName = 'root';
	$password = 'mindfire';
	$dbName = 'registration';
	$conn = mysqli_connect($host,$userName,$password,$dbName);

	if(isset($_GET['id']))
	{
		$del_add = 'DELETE FROM address WHERE emp_id = '. $_GET['id'];
	    mysqli_query($conn,$del_add);

		$del_emp = 'DELETE FROM employee WHERE id = '.$_GET['id'];
		mysqli_query($conn,$del_emp);
	}
	header("Location: display.php");

?>