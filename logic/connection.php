<?php
	$db_host	=	'localhost';
	$db_user	=	'root';
	$db_pass	=	'';
	$db_name	=	'toko_kue';

	$db_con 	=	mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if (mysqli_connect_error()) {
		echo "<script>alert('Database Connection Failed. Please Contact the Software Engineer')</script>";
	}
?>