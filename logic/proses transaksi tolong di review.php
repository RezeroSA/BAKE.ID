<?php 
include 'connection.php';

$cust_name	=	$_POST['customer-name'];
$phone		=	$_POST['phone'];
$id_emp 	=	$_POST['id-employee'];
$payment 	=	$_POST['payment'];
$date		=	date("Y-m-d H:i:s")

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

if (isset($cust_name) || isset($phone)) {
	$sql4 	=	"INSERT INTO customer (name, phone) VALUES ('$cust_name', '$phone')";
	$query4	=	mysqli_query($db_con, $sql4);

	$sql5	=	"SELECT id_customer FROM customer ORDER BY id_customer DESC LIMIT 1";
	$query5 = 	mysqli_query($db_con, $sql5);
	$data5	=	mysqli_fetch_array($query5);
	$id_cust=	$data5['id_customer'];

	$sql6 	=	"SELECT * FROM cart";
	$query6 =	mysqli_query($db_con, $sql6);
	WHILE($data6 	=	mysqli_fetch_array($query6)){
		$id_product =	$data6['id_product'];
		$amount 	=	$data6['amount'];
		$price		=	$data6['price'];
		$total 		=	$amount*$price;

		$sql6 =	"INSERT INTO transaction (id_employee, id_customer, id_product, qty, price, total, cart) VALUES ('$id_emp', '$id_cust', '$id_product', '$amount', '$price', '$total', '$date')";
		$query6 = mysqli_query($db_con, $sql6);
	}
} else {
	if (isset($action)) {
		if ($action == "increase") {
			$amount 	= $amount+1;
			$sql3 		=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
			$query3 	=	mysqli_query($db_con, $sql3);
		} else {
			if ($amount <= 1) {
				$sql3 		=	"DELETE FROM cart WHERE id_product='$id'";
				$query3 	=	mysqli_query($db_con, $sql3);
			} else {
				$amount 	= $amount-1;
				$sql3 		=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
				$query3 	=	mysqli_query($db_con, $sql3);
			}
		}
	} else {
		if ($id == $id_chk) {
			$amount = $amount+1;
			$sql3 	=	"UPDATE cart SET amount='$amount' WHERE id_product='$id'";
			$query3 	=	mysqli_query($db_con, $sql3);
		} else {
			$sql3 	=	"INSERT INTO cart (id_product, product_name, price, image, amount) VALUES('$id', '$pname', '$price', '$image', '1')";
			$query3 	=	mysqli_query($db_con, $sql3);
		}	
	}
}
?>