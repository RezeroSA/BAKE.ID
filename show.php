<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="icon" href="../assets/images/bake-id.ico">
<link rel="stylesheet" href="../assets/icons/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/icons/css/all.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<div class="summary-text">
	<h3>Summary</h3>
</div>
<div class="summary-price">
	<?php
	include 'logic/connection.php';
	$sql2		=	"SELECT * FROM transaction_process";
	$query2		=	mysqli_query($db_con, $sql2);
	WHILE($data2		=	mysqli_fetch_array($query2)){
	$id_product =	$data2['id_product'];
	$image		=	$data2['image'];
	$name 		=	$data2['product_name'];
	$price		=	$data2['price'];
	$amount		=	$data2['amount'];
?>
<div class="item">
	<div class="item-img">
		<img src="../assets/images/product/<?php echo $image;?>">
	</div>
	<div class="item-name-price">
		<h4>
			<?php
				echo $name;
			?>
		</h4>
		<p>Rp <?php echo number_format($price);?></p>
	</div>
	<div class="item-value">
		<div class="input-button fa-solid fa-minus" id="minus" onclick="decreaseAmmount(<?php echo $id_product;?>, 'decrease')"></div>
		<input type="number" name="item-value" id="ammount-input" value="<?php echo $amount;?>" readonly>
		<div class="input-button fa-solid fa-plus" id="plus" onclick="increaseAmmount(<?php echo $id_product;?>, 'increase')"></div>
	</div>
</div>
<?php 
	}
?>
</div>
<?php 
	$sql3 			=	"SELECT SUM(price*amount) as subtotal FROM transaction_process";
	$query3 		=	mysqli_query($db_con, $sql3);
	$data3 			=	mysqli_fetch_array($query3);
	$subtotal		=	$data3['subtotal'];
	$tax			=	5/100;
	$tax_count		=	$subtotal*$tax;
	$total 			=	$subtotal+$tax_count;
?>
<div class="summary-total">
	<hr>
	<div class="subtotal">
		<p>Subtotal</p>
		<p>Rp <?php echo number_format($subtotal);?></p>
	</div>
	<div class="tax">
		<p>Tax</p>
		<p>5%</p>
	</div>
	<hr>
	<div class="total">
		<p>Total</p>
		<p>Rp <?php echo number_format($total);?></p>
	</div>
</div>
<div class="summary-button">
	<a href="" class="proceed-button">Proceed</a>
</div>