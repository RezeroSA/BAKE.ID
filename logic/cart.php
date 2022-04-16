<?php 
include 'connection.php';

$id 	= $_POST['id-product'];
$action	= $_POST['action'];

$sql 	=	"SELECT * FROM product WHERE id_product='$id'";
$query 	=	mysqli_query($db_con, $sql);
$data 	=	mysqli_fetch_array($query);
$pname 	=	$data['product_name'];
$price	=	$data['price'];
$image	=	$data['image'];
$stock	=	$data['stock'];

$sql2 	=	"SELECT * FROM cart WHERE id_product='$id'";
$query2 =	mysqli_query($db_con, $sql2);
$data2 	=	mysqli_fetch_array($query2);
$id_chk =	$data2['id_product'];
$amount =	$data2['amount'];


if (isset($action)) {
	if ($action == "increase") {
		$amount 	= $amount+1;
		$sql3 		=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
		$query23 	=	mysqli_query($db_con, $sql3);
	} else {
		if ($amount <= 1) {
			$sql3 		=	"DELETE FROM cart WHERE id_product='$id'";
			$query23 	=	mysqli_query($db_con, $sql3);
		} else {
			$amount 	= $amount-1;
			$sql3 		=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
			$query23 	=	mysqli_query($db_con, $sql3);
		}
	}
} else {
	if ($id == $id_chk) {
		$amount = $amount+1;
		$sql3 	=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
		$query23 	=	mysqli_query($db_con, $sql3);
	} else {
		$sql3 	=	"INSERT INTO cart (id_product, product_name, price, image, amount) VALUES('$id', '$pname', '$price', '$image', '1')";
		$query3 	=	mysqli_query($db_con, $sql3);
	}	
}
?>