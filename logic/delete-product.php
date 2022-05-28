<?php 
	require 'connection.php';
	$id 	=	$_POST['id-product'];

	$sql 	=	"SELECT image FROM product WHERE id_product = '$id'";
	$query 	=	mysqli_query($db_con, $sql);
	$data 	=	mysqli_fetch_array($query);
	$image 	=	$data['image'];

	@unlink('../assets/images/product/'.$image);
	
	$sql2 	=	"DELETE FROM product WHERE id_product = '$id'";
	$query2 =	mysqli_query($db_con, $sql2);
?>