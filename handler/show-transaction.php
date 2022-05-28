<table class="table">
	<tr>
		<th class="no">No</th>
		<th class="customer-name">Customer Name</th>
		<th class="phone">Phone</th>
		<th class="transaction-date">Transaction Date</th>
		<th class="order">Order</th>
		<th class="amount">Amount</th>
		<th class="total">Total</th>
		<th class="payment">Payment Method</th>
	</tr>
	<div class="table-content">
		<?php 
			include '../logic/connection.php';
			$no 			=	0;
			$sql 			=	"SELECT customer.id_customer, customer.name, customer.phone, transact.id_transaction, transact.transaction_time, transact.total, transact.payment_method FROM transact INNER JOIN customer ON transact.id_customer=customer.id_customer ORDER BY transaction_time ASC";
			$keyword		=	'';
			if (isset($_POST['search'])) {
				$keyword	=	$_POST['search'];
				$sql 		=	"SELECT customer.id_customer, customer.name, customer.phone, transact.id_transaction, transact.transaction_time, transact.total, transact.payment_method FROM transact INNER JOIN customer ON transact.id_customer=customer.id_customer WHERE name LIKE '%".$keyword."%' OR phone LIKE '%".$keyword."%' OR transaction_time LIKE '%".$keyword."%' OR total LIKE '%".$keyword."%' OR payment_method LIKE '%".$keyword."%' ORDER BY transaction_time ASC";
			}
			$query 			=	mysqli_query($db_con, $sql);
			WHILE(	$data 	=	mysqli_fetch_array($query)){
			$id_transaction	=	$data['id_transaction'];
			$id_customer	=	$data['id_customer'];
			$name			=	$data['name'];
			$phone			=	$data['phone'];
			$trn_time		=	$data['transaction_time'];
			$total 			=	$data['total'];
			$pay_meth 		=	$data['payment_method'];
			$no++;
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $phone;?></td>
			<td><?php echo $trn_time;?></td>
			<td style="text-align: left;">
				<?php 
					$sql2			=	"SELECT * FROM detail_transaction WHERE id_transaction='$id_transaction'";
					$query2 		=	mysqli_query($db_con, $sql2);
					WHILE($data2			=	mysqli_fetch_array($query2)){
					$id_detail		=	$data2['id_detail'];
					$id_product 	=	$data2['id_product'];
					$qty		 	=	$data2['qty'];

					$sql3			=	"SELECT product_name FROM product WHERE id_product='$id_product'";
					$query3 		=	mysqli_query($db_con, $sql3);
					$data3	=	mysqli_fetch_array($query3);
					echo $prod_name	=	$data3['product_name'];
					echo "<br><br>";
					}
				?>
			</td>
			<td>
				<?php 
					$sql4			=	"SELECT * FROM detail_transaction WHERE id_transaction='$id_transaction'";
					$query4 		=	mysqli_query($db_con, $sql4);
					WHILE($data4			=	mysqli_fetch_array($query4)){
					echo $qty		 	=	$data4['qty'];
					echo "<br><br>";
					}
				?>
			</td>
			<td>Rp <?php echo number_format($total);?></td>
			<td><?php echo $pay_meth;?></td>
		</tr>
		<?php
			}
		?>
	</div>
</table>