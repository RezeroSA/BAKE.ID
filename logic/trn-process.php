<?php 
$cust_name	=	$_POST['customer-name'];
$phone		=	$_POST['phone'];
$id_emp 	=	$_POST['id-employee'];
$payment 	=	$_POST['payment'];
// $total 		=	$_POST['total'];
$date		=	date("Y-m-d H:i:s");


$sql 		=	"INSERT INTO customer (name, phone) VALUES ('$cust_name', '$phone')";
$query		=	mysqli_query($db_con, $sql);

if ($query) {
	$sql2	=	"SELECT id_customer FROM customer ORDER BY id_customer DESC LIMIT 1";
	$query2 = 	mysqli_query($db_con, $sql2);
	$data2	=	mysqli_fetch_array($query2);
	$id_cust=	$data2['id_customer'];	

	$sqlz 			=	"SELECT SUM(price*amount) as subtotal FROM cart";
	$queryz 		=	mysqli_query($db_con, $sqlz);
	$dataz 			=	mysqli_fetch_array($queryz);
	$subtotal		=	$dataz['subtotal'];
	$tax			=	5/100;
	$tax_count		=	$subtotal*$tax;
	$total 			=	$subtotal+$tax_count;

	$sql3 	=	"INSERT INTO transaction (id_employee, id_customer, total, transaction_time) VALUES ('$id_emp', '$id_cust', '$total', '$date')";
	$query3	=	mysqli_query($db_con, $sql3);

	if ($query3) {
		$sql4	=	"SELECT id_transaction FROM transaction ORDER BY id_transaction DESC LIMIT 1";
		$query4 = 	mysqli_query($db_con, $sql4);
		$data4	=	mysqli_fetch_array($query4);
		$id_trn =	$data4['id_transaction'];

		$sql5 	=	"SELECT id_product, price, amount FROM cart";
		$query5	=	mysqli_query($db_con, $sql5);
		WHILE (	$data5 =	mysqli_fetch_array($query5)){
			$id_prod 	=	$data5['id_product'];
			$price_prod	=	$data5['price'];
			$amount_prod=	$data5['amount'];

			$sql6	=	"INSERT INTO detail_transaction (id_detail, id_product, price, qty) VALUES ('$id_trn', '$id_prod', '$price_prod', '$amount_prod')";
			$query6	=	mysqli_query($db_con, $sql6);
		}
	}
}
?>