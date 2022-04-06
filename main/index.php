<?php
	session_start();
	require '../logic/connection.php';

	// if (!isset($_SESSION['session_id']) && !isset($_SESSION['session_role'])) {
	// 	echo "<script>alert('Session has ended. Please relogin')</script>";
	// 	echo "<meta http-equiv='refresh' content='0 url=../'>";
	// }
	$id_employee	=	$_SESSION['session_id'];
	$role 			=	$_SESSION['session_role'];

	// $id_product_rec	=	$_GET['id-product'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" href="../assets/images/bake-id.ico">
	<link rel="stylesheet" href="../assets/icons/css/fontawesome.min.css">
	<link rel="stylesheet" href="../assets/icons/css/all.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<title>BAKE.ID - Home</title>

	<script>
		function changeImg() {
			const y = document.getElementById('logout-img');
			y.setAttribute('src', '../assets/images/logout-alt.png');
		}
		function changeImgRevs() {
			const y = document.getElementById('logout-img');
			y.setAttribute('src', '../assets/images/logout.png');
		}
		function changeTransaction() {
			const y = document.getElementById('transaction-img');
			y.setAttribute('src', '../assets/images/transaction-white.png');
		}
		function changeTransactionRevs() {
			const y = document.getElementById('transaction-img');
			y.setAttribute('src', '../assets/images/transaction.png');
		}
		function changeStock() {
			const y = document.getElementById('stock-img');
			y.setAttribute('src', '../assets/images/stock-white.png');
		}
		function changeStockRevs() {
			const y = document.getElementById('stock-img');
			y.setAttribute('src', '../assets/images/stock.png');
		}
		function fullScreen() {
			var el = document.documentElement;
			if (document.readyState === 'complete') {
				el.requestFullscreen();
			}
		}
		function increaseAmmount() {
			var amt = parseInt(document.getElementById('ammount-input').value);
			document.getElementById('ammount-input').value = amt+1;
		}
		function decreaseAmmount() {
			var amt = parseInt(document.getElementById('ammount-input').value);
			document.getElementById('ammount-input').value = amt-1;
		}
		function showCustomSection() {
			// document.getElementById('main-section').style.display='none';
			document.getElementById('custom-section').style.display='inline';
		}
		function showMainSection() {
			document.getElementById('custom-section').style.display='none';	
			document.getElementById('main-section').style.display='inline';
		}
		function getValue(id_product) {
			var data =  id_product;
			// alert(data);
			$.ajax({
				type: 'POST',
				url: "../logic/trn-process.php",
				data: {'id-product': data},
				success: function() {
					$('.summary-price').load("../show.php");
				}
			});
		}
	</script>
</head>
<body> 
	<div class="container">
		<div class="left">
			<a href="../main/"><img src="../assets/images/bake-id.png"></a>

			<a href="../main/" class="home" id="home" onmouseover="changeHome();" onmouseout="changeHomeRevs();"><img src="../assets/images/home-active.png" id="home-img">Home</a>

			<a href="transaction" class="transaction" id="transaction" onmouseover="changeTransaction();" onmouseout="changeTransactionRevs();"><img src="../assets/images/transaction.png" id="transaction-img">Transaction</a>

			<a href="stock" class="stock" id="stock" onmouseover="changeStock();" onmouseout="changeStockRevs();"><img src="../assets/images/stock.png" id="stock-img">Stock</a>

			<a href="../logic/logout" class="logout" id="logout" onmouseover="changeImg();" onmouseout="changeImgRevs();"><img src="../assets/images/logout.png" id="logout-img">Logout</a>
		</div>
		<div class="center" id="main-section">
			<div class="header">
				<p class="order-menu"><strong>Order</strong> Menu</p>
				<form action="" method="POST">
					<span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
					<input type="text" name="search" id="search" placeholder="Search">
				</form>
			</div>
			<div class="regular-custom">
				<a class="regular">REGULAR</a>
				<a class="custom" id="custom-toggle" onclick="showCustomSection()">CUSTOM</a>
			</div>
			<div class="menu">
					<?php 
						$sql2		=	"SELECT * FROM product";
						$query2		=	mysqli_query($db_con, $sql2);
						WHILE($data2		=	mysqli_fetch_array($query2)){
						$id_product	=	$data2['id_product'];
						$prod_name	=	$data2['product_name'];
						$price		=	$data2['price'];
						$image		=	$data2['image'];
					?>
					<a class="product" value="<?php echo $id_product;?>" onclick="getValue('<?php echo $id_product;?>')">
						<p hidden id="kata"><?php echo $id_product;?></p>
						<img src="../assets/images/product/<?php echo $image;?>">
						<h4 class="product-name"><?php echo $prod_name;?></h4>
						<p class="price">Rp <?php echo number_format($price);;?></p>
					</a>
					<?php 
						}
					?>
			</div>
		</div>
		<div class="center-custom" id="custom-section">
			<div class="header-custom">
				<p class="order-menu-custom"><strong>Order</strong> Menu</p>
				<form action="" method="POST">
					<span class="icon-custom"><i class="fa-solid fa-magnifying-glass"></i></span>
					<input type="text" name="search" id="search" placeholder="Search">
				</form>
			</div>
			<div class="regular-custom-custom">
				<a class="regular-custom" id="main-toggle" onclick="showMainSection()">REGULAR</a>
				<a class="custom-custom">CUSTOM</a>
			</div>
			<!-- <div class="menu-custom">
				<a href="" class="product-custom">
					<img src="../assets/images/baguette.png">
					<h4 class="product-name-custom">Baguette</h4>
					<p class="price-custom">Rp 20.000</p>
				</a>
				<a href="" class="product-custom">
					<img src="../assets/images/bread.png">
					<h4 class="product-name-custom">Bread</h4>
					<p class="price-custom">Rp 10.000</p>
				</a>
				<a href="" class="product-custom">
					<img src="../assets/images/croissant.png">
					<h4 class="product-name-custom">Croissant</h4>
					<p class="price-custom">Rp 15.000</p>
				</a> 
				<a href="" class="product-custom">
					<img src="../assets/images/bday-choco.png">
					<h4 class="product-name-custom">Birthday Cake - Choco</h4>
					<p class="price-custom">Rp 120.000</p>
				</a>
				<a href="" class="product-custom">
					<img src="../assets/images/meat-baguette.png">
					<h4 class="product-name-custom">Meat Baguette</h4>
					<p class="price">Rp 65.000</p>
				</a>
				<a href="" class="product-custom">
					<img src="../assets/images/bday-pink.png">
					<h4 class="product-name-custom">Birthday Cake - Pink</h4>
					<p class="price-custom">Rp 110.000</p>
				</a>
			</div> -->
		</div>
		<div class="right">
			<div class="summary-text">
				<h3>Summary</h3>
			</div>
			<div class="summary-price">
				<!-- <div class="item"> -->
					<!-- <div class="item-img">
						<img src="../assets/images/baguette.png">
					</div>
					<div class="item-name-price">
						<h4>Baguette</h4>
						<p>Rp 20.000</p>
					</div>
					<div class="item-value">
						<div class="input-button fa-solid fa-minus" id="minus" onclick="decreaseAmmount()"></div>
						<input type="number" name="item-value" id="ammount-input">
						<div class="input-button fa-solid fa-plus" id="plus" onclick="increaseAmmount()"></div>
					</div> -->
				<!-- </div> -->
			</div>
			<div class="summary-total">
				<hr>
				<div class="subtotal">
					<p>Subtotal</p>
					<p>Rp 160.000</p>
				</div>
				<div class="tax">
					<p>Tax</p>
					<p>5%</p>
				</div>
				<hr>
				<div class="total">
					<p>Total</p>
					<p>Rp. 168.000</p>
				</div>
			</div>
			<div class="summary-button">
				<a href="" class="proceed-button">Proceed</a>
			</div>
		</div>
	</div>
</body>
</html>