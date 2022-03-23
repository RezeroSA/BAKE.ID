<?php
	require 'connection.php';
	session_start();
	error_reporting(0);
	$input_id	=	addslashes($_POST['id']);
	$input_pass	=	addslashes($_POST['pass']);

	$sql 		=	"SELECT * FROM employee WHERE employee_code = '$input_id' && password = '$input_pass'";
	$query		=	mysqli_query($db_con, $sql);
	$data 		=	mysqli_fetch_array($query);
	$db_id 		=	$data['id_employee'];
	$db_code	=	$data['employee_code'];
	$db_pass	=	$data['password'];
	$db_role	=	$data['role'];

	if ($input_id == $db_code && $input_pass == $db_pass) {
		$_SESSION['session_id']		=	$db_id;
		$_SESSION['session_role']	=	$db_role;
		header('location: ../main/');
	} else {
		echo "<script>alert('Employee Code or Password is incorrect. Please try again')</script>";
		echo "<meta http-equiv='refresh' content='0 url=../'>";
	}
?>