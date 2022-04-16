<?php
	include 'connection.php';

	$id_product 	=	$_POST['id-product'];
	$status			=	$_POST['status'];

	$sql 	=	"SELECT stock FROM product WHERE id_product='$id_product'";
	$query 	=	mysqli_query($db_con, $sql);
	$data 	=	mysqli_fetch_array($query);
	$stock 	=	$data['stock'];

	if (isset($id_product) && isset($status)) {
		if ($status == 'increase') {
			$stock  =	$stock+1;
			$sql2	=	"UPDATE product SET stock='$stock' WHERE id_product='$id_product'";
			$query 	=	mysqli_query($db_con, $sql2);
		} else {
			$stock  =	$stock-1;
			$sql2	=	"UPDATE product SET stock='$stock' WHERE id_product='$id_product'";
			$query 	=	mysqli_query($db_con, $sql2);
		}
	}
?>