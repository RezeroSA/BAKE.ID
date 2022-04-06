<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="icon" href="../assets/images/bake-id.ico">
<link rel="stylesheet" href="../assets/icons/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/icons/css/all.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<?php
	include 'logic/connection.php';
	$sql2		=	"SELECT * FROM transaction_process";
	$query2		=	mysqli_query($db_con, $sql2);
	WHILE($data2		=	mysqli_fetch_array($query2)){
	$image	=	$data2['image'];
	$name 	=	$data2['product_name'];
	$price	=	$data2['price'];
	$amount	=	$data2['amount'];
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
		<div class="input-button fa-solid fa-minus" id="minus" onclick="decreaseAmmount()"></div>
		<input type="number" name="item-value" id="ammount-input" value="<?php echo $amount;?>">
		<div class="input-button fa-solid fa-plus" id="plus" onclick="increaseAmmount()"></div>
	</div>
</div>
<?php 
	}
?>