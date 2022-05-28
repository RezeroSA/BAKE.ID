<?php
	session_start();
	require '../logic/connection.php';

	// if (!isset($_SESSION['session_id']) && !isset($_SESSION['session_role'])) {
	// 	echo "<script>alert('Session has ended. Please relogin')</script>";
	// 	echo "<meta http-equiv='refresh' content='0 url=../'>";
	// }
	// $id_employee	=	$_SESSION['session_id'];
	// $role 			=	$_SESSION['session_role'];
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
	<title>BAKE.ID - Transaction</title>

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
		function changeHome() {
			const y = document.getElementById('home-img');
			y.setAttribute('src', '../assets/images/home-active.png');
		}
		function changeHomeRevs() {
			const y = document.getElementById('home-img');
			y.setAttribute('src', '../assets/images/home-inactive.png');
		}
		function changeStock() {
			const y = document.getElementById('stock-img');
			y.setAttribute('src', '../assets/images/stock-white.png');
		}
		function changeStockRevs() {
			const y = document.getElementById('stock-img');
			y.setAttribute('src', '../assets/images/stock.png');
		}
		// Script Search dan Show Data Transaksi
		$(document).ready(function(){
			load_data();
			function load_data(search){
				$.ajax({
					url:"../handler/show-transaction.php",
					method:"POST",
					data: {
						search: search
					},
					success:function(data){
						$('.table-wrapper').html(data);
					}
				});
			}
			$('#search').keyup(function(){
				var search = $('#search').val();
				load_data(search);
			});
		});
	</script>
</head>
<body> 
	<div class="container">
		<div class="left">
			<a href="../main/"><img src="../assets/images/bake-id.png"></a>

			<a href="../main/" class="home" id="home" onmouseover="changeHome();" onmouseout="changeHomeRevs();"><img src="../assets/images/home-inactive.png" id="home-img">Home</a>

			<a href="transaction" class="transaction active" id="transaction"><img src="../assets/images/transaction-white.png" id="transaction-img">Transaction</a>

			<a href="stock" class="stock" id="stock" onmouseover="changeStock();" onmouseout="changeStockRevs();"><img src="../assets/images/stock.png" id="stock-img">Stock</a>

			<a href="../logic/logout" class="logout" id="logout" onmouseover="changeImg();" onmouseout="changeImgRevs();"><img src="../assets/images/logout.png" id="logout-img">Logout</a>
		</div>
		<div class="center-transaction" id="main-section">
			<div class="header-transaction">
				<p class="order-menu"><strong>Tran</strong>saction</p>
				<form action="" method="POST">
					<span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
					<input type="text" name="search" id="search" placeholder="Search">
				</form>
			</div>
			<div class="table-wrapper">
				
			</div>
		</div>
	</div>
</body>
</html>