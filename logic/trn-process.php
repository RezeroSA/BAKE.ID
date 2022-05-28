<?php 
	require 'connection.php';
	$cust_name	=	$_POST['customer-name'];
	$phone		=	$_POST['phone'];
	$id_emp 	=	$_POST['id-employee'];
	$payment 	=	$_POST['payment'];
	// $total 		=	$_POST['total'];
	$date		=	date("Y-m-d H:i:s");

	$sql 		=	"INSERT INTO customer (name, phone) VALUES ('$cust_name', '$phone')";
	$query 		=	mysqli_query($db_con, $sql);

	if ($query) {
		$sql2	=	"SELECT id_customer FROM customer ORDER BY id_customer DESC LIMIT 1";
		$query2 =	mysqli_query($db_con, $sql2);
		$data2 	=	mysqli_fetch_array($query2);
		$id_cust=	$data2['id_customer'];

		$sql3 			=	"SELECT SUM(price*amount) as subtotal FROM cart";
		$query3 		=	mysqli_query($db_con, $sql3);
		$data3 			=	mysqli_fetch_array($query3);
		$subtotal		=	$data3['subtotal'];
		$tax			=	5/100;
		$tax_count		=	$subtotal*$tax;
		$total 			=	$subtotal+$tax_count;

		$sql4 	=	"INSERT INTO transact (id_employee, id_customer, total, payment_method, transaction_time) VALUES ('$id_emp', '$id_cust', '$total', '$payment' , '$date')";
		$query4 =	mysqli_query($db_con, $sql4);

		if ($query4) {
			$sql5	=	"INSERT INTO detail_transaction (id_product, qty) SELECT id_product, amount FROM cart";
			$query5	=	mysqli_query($db_con, $sql5);

			if ($query5) {
				$sql6	=	"SELECT * FROM cart";
				$query6	=	mysqli_query($db_con, $sql6);

				$sql7	=	"SELECT id_transaction FROM transact ORDER BY id_transaction DESC LIMIT 1";
				$query7	=	mysqli_query($db_con, $sql7);
				$data7	=	mysqli_fetch_array($query7);
				$id_tran=	$data7['id_transaction'];

				$stmt 	=	$db_con->prepare("UPDATE detail_transaction SET id_transaction='$id_tran' ORDER BY id_detail DESC LIMIT ?");
				$limit 	=	mysqli_num_rows($query6);
				$stmt->bind_param("i", $limit);
				$stmt->execute();
				$stmt->close();

				$sql8	=	"DELETE FROM cart";
				$query8	=	mysqli_query($db_con, $sql8);
			}
		}
	}
?>