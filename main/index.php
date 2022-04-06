<?php
	session_start();
	require '../logic/connection.php';

	// if (!isset($_SESSION['session_id']) && !isset($_SESSION['session_role'])) {
	// 	echo "<script>alert('Session has ended. Please relogin')</script>";
	// 	echo "<meta http-equiv='refresh' content='0 url=../'>";
	// }
	$id_employee	=	$_SESSION['session_id'];
	$role 			=	$_SESSION['session_role'];
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
		// Script ganti gambar button (START)
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
		// Script ganti gambar button (END)

		// function fullScreen() {
		// 	var el = document.documentElement;
		// 	if (document.readyState === 'complete') {
		// 		el.requestFullscreen();
		// 	}
		// }

		// Fungsi untuk tambah jumlah produk di summary-price (START)
		function increaseAmmount(id_product, status) {
			var id =  id_product;
			const action = status;
			$.ajax({
				type: 'POST',
				url: "../logic/trn-process.php",
				data: {'id-product': id, 'action': action},
				success: function() {
					$('.right').load("../show.php");
				}
			});
		}
		// Fungsi untuk tambah jumlah produk di summary-price (END)

		// Fungsi untuk kurangi jumlah produk di summary-price (START)
		function decreaseAmmount(id_product, status) {
			var id =  id_product;
			const action = status;
			$.ajax({
				type: 'POST',
				url: "../logic/trn-process.php",
				data: {'id-product': id, 'action': action},
				success: function() {
					$('.right').load("../show.php");
				}
			});
		}
		// Fungsi untuk kurangi jumlah produk di summary-price (END)

		function showCustomSection() {
			// document.getElementById('main-section').style.display='none';
			document.getElementById('custom-section').style.display='inline';
		}
		function showMainSection() {
			document.getElementById('custom-section').style.display='none';	
			document.getElementById('main-section').style.display='inline';
		}

		// Fungsi untuk mendapatkan data pesanan dari database (START)
		function getValue(id_product) {
			var data =  id_product;
			$.ajax({
				type: 'POST',
				url: "../logic/trn-process.php",
				data: {'id-product': data},
				success: function() {
					$('.right').load("../show.php");
				}
			});
		}
		// Fungsi untuk mendapatkan data pesanan dari database (END)

		$(document).ready(function(){
		    load_data();
		    function load_data(search){
		      $.ajax({
		        url:"../show-product.php",
		        method:"POST",
		        data: {
		          search: search
		        },
		        success:function(data){
		          $('.menu').html(data);
		        }
		      });
		    }
		    $('#search').keyup(function(){
		      var search = $("#search").val();
		      load_data(search);
		    });
		  });
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
					<!-- <?php 
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
					?> -->
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
			<!-- <div class="summary-text">
				<h3>Summary</h3>
			</div>
			<div class="summary-price">

			</div>
			<?php 
				$sql3 			=	"SELECT SUM(price*amount) as subtotal FROM transaction_process";
				$query3 		=	mysqli_query($db_con, $sql3);
				$data3 			=	mysqli_fetch_array($query3);
				$subtotal		=	$data3['subtotal'];
			?>
			<div class="summary-total">
				<hr>
				<div class="subtotal">
					<p>Subtotal</p>
					<p>Rp</p>
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
			</div> -->
		</div>
	</div>
</body>
</html>