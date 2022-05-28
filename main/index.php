<?php
	session_start();
	require '../logic/connection.php';

	if (!isset($_SESSION['session_id']) && !isset($_SESSION['session_role'])) {
		echo "<script>alert('Session has ended. Please relogin')</script>";
		echo "<meta http-equiv='refresh' content='0 url=../'>";
	}
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
		function changeHome() {
			const y = document.getElementById('home-img');
			y.setAttribute('src', '../assets/images/home-active.png');
		}
		function changeHomeRevs() {
			const y = document.getElementById('home-img');
			y.setAttribute('src', '../assets/images/home-inactive.png');
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

		// Fungsi untuk tambah jumlah produk di summary-price (START)
		function increaseAmmount(id_product, status) {
			var id =  id_product;
			const action = status;
			$.ajax({
				type: 'POST',
				url: "../logic/cart.php",
				data: {'id-product': id, 'action': action},
				success: function() {
					$('.data').load("../handler/show-cart.php");
					$('.menu').load("../handler/show-product.php");
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
				url: "../logic/cart.php",
				data: {'id-product': id, 'action': action},
				success: function() {
					$('.data').load("../handler/show-cart.php");
					$('.menu').load("../handler/show-product.php");
				}
			});
		}
		// Fungsi untuk kurangi jumlah produk di summary-price (END)

		// function showCustomSection() {
		// 	// document.getElementById('main-section').style.display='none';
		// 	document.getElementById('custom-section').style.display='inline';
		// }
		// function showMainSection() {
		// 	document.getElementById('custom-section').style.display='none';	
		// 	document.getElementById('main-section').style.display='inline';
		// }

		// Fungsi untuk mendapatkan data cart dari database (START)
		function getValue(id_product) {
			var data =  id_product;
			$.ajax({
				type: 'POST',
				url: "../logic/cart.php",
				data: {'id-product': data},
				success: function() {
					$('.data').load("../handler/show-cart.php");
					$('.menu').load("../handler/show-product.php");
				}
			});
		}

		// Fungsi untuk mendapatkan data cart dari database (END)

		$(document).ready(function(){
		    load_data();
		    function load_data(search){
		      $.ajax({
		        url:"../handler/show-product.php",
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

		// $(document).ready(function(){
		//     load_data();
		//     function load_data(search){
		//       $.ajax({
		//         url:"../handler/show-product.php",
		//         method:"POST",
		//         data: {
		//           search: search
		//         },
		//         success:function(data){
		//           $('.menu').html(data);
		//         }
		//       });
		//     }
		//     $('#product').click(function(){
		//       var search = $("#search").val();
		//       load_data(search);
		//     });
		// });

		// Fungsi untuk payment method (START)
		function paymentMethod(payment, id_emp) {
			var custName = document.getElementById('cust-name').value;
			var phone = document.getElementById('phone').value;
			var payment = payment;
			var idEmp  = id_emp;
			// alert(total);
			$.ajax({
				type: 'POST',
				url: "../logic/trn-process.php",
				data: {'customer-name': custName, 'phone': phone, 'payment': payment, 'id-employee': idEmp},
				success: function() {
					$('.data').load("../handler/show-cart.php");

					document.getElementById('cust-name').value='';
					document.getElementById('phone').value='';

					document.getElementById('payment-overlay').classList.remove('is-visible');
		  			document.getElementById('payment-method').classList.remove('is-visible');

					document.getElementById('overlay').classList.add('is-visible');
		  			document.getElementById('modal').classList.add('is-visible');

		  			document.getElementById('close-btn').addEventListener('click', function() {
					  document.getElementById('overlay').classList.remove('is-visible');
					  document.getElementById('modal').classList.remove('is-visible');
					});
					document.getElementById('overlay').addEventListener('click', function() {
					  document.getElementById('overlay').classList.remove('is-visible');
					  document.getElementById('modal').classList.remove('is-visible');
					});
				}
			});
		}
	</script>
</head>
<body> 
	<div class="container">
		<div class="left">
			<a href="../main/"><img src="../assets/images/bake-id.png"></a>

			<a href="../main/" class="home active" id="home"><img src="../assets/images/home-active.png" id="home-img">Home</a>

			<a href="transaction" class="transaction" id="transaction" onmouseover="changeTransaction();" onmouseout="changeTransactionRevs();"><img src="../assets/images/transaction.png" id="transaction-img">Transaction</a>

			<a href="stock" class="stock" id="stock" onmouseover="changeStock();" onmouseout="changeStockRevs();"><img src="../assets/images/stock.png" id="stock-img">Stock</a>

			<a href="../logic/logout" class="logout" id="logout" onmouseover="changeImg();" onmouseout="changeImgRevs();"><img src="../assets/images/logout.png" id="logout-img">Logout</a>
		</div>
		<!-- <button class="btn" id="btn-modal">開く</button> -->
		<div class="center" id="main-section">
			<div class="header">
				<p class="order-menu"><strong>Order</strong> Menu</p>
				<form action="" method="POST">
					<span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
					<input type="text" name="search" id="search" placeholder="Search">
				</form>
			</div>
			<div class="regular-custom">
				<a class="regular">MENU</a>
				<!-- <a class="custom" id="custom-toggle" onclick="showCustomSection()">CUSTOM</a> -->
			</div>
			<div class="menu">

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
				<!-- <a class="custom-custom">CUSTOM</a> -->
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
			<div class="data">
				<div class="summary-price">
					<?php
					include '../logic/connection.php';
					$sql2		=	"SELECT * FROM cart";
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
					$sql3 			=	"SELECT SUM(price*amount) as subtotal FROM cart";
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
						<p id="total">Rp <?php echo number_format($total);?></p>
					</div>
				</div>
			</div>
			<div class="summary-button">
				<a id="open-purchase-confirmation" class="proceed-button">Proceed</a>
			</div>
		</div>
	</div>
	//Payment Successful Modal
	<div class="overlay" id="overlay"></div>
	<div class="modal" id="modal">
	  <button class="modal-close-btn" id="close-btn"></button>
	  <img src="../assets/images/successful.png">
	  <h4>Payment Successful</h4>
	  <p>Tap anywhere to close or want to print the receipt?</p>
	  <a class="print-receipt">Print Receipt</a>
	</div>

	//Purchase Confirmation Modal
	<div class="purchase-overlay" id="purchase-overlay"></div>
	<div class="purchase-confirmation" id="purchase-confirmation">
	  <button class="modal-close-btn" id="close-btn"></button>
	  <p><strong>Purchase</strong> Confirmation</p>
	  <p class="warning">Please check the order(s) once again. Next Step can't be undone!</p>
	  	<input class="cust-name" type="text" name="cust_name" placeholder="Customer Name" id="cust-name" required>
	  	<input class="phone" type="text" name="phone" placeholder="Phone" id="phone" required>
	  	<button type="submit" id="submit">Next</button>
	</div>

	//Payment Method Modal
	<div class="payment-overlay" id="payment-overlay"></div>
	<div class="payment-method" id="payment-method">
	  <button class="modal-close-btn" id="close-btn"></button>
	  <p><strong>Payment</strong> Method</p>
	  <div class="method">
	  	<button class="cash" type="submit" id="cash" onclick="paymentMethod('Cash', <?php echo $id_employee;?>)"></button>
	  	<button class="online-payment" type="submit" id="online-payment" onclick="paymentMethod('Online Payment', <?php echo $id_employee;?>)"></button>
	  </div>
	</div>

	//Fullscreen Modal
	<div class="overlay-fullscreen" id="overlay-fullscreen"></div>
	<div class="modal-fullscreen" id="modal-fullscreen">
	  <img src="../assets/images/fullscreen.png">
	  <h4>Oops looks like your screen is not in the fullscreen mode</h4>
	  <p>The system need has to be fullscreen to work properly</p>
	  <!-- <a class="fullscreen-button" id="fullscreen-toggle" onclick="toggleFullscreen()">Yes, please</a> -->
	  <a class="fullscreen-button" id="fullscreen-toggle">Press F11 or Fn+F11 on your keyboard</a>
	</div>

	<script>
		document.getElementById('open-purchase-confirmation').addEventListener('click', function() {
		  document.getElementById('purchase-overlay').classList.add('is-visible');
		  document.getElementById('purchase-confirmation').classList.add('is-visible');
		});

		document.getElementById('close-btn').addEventListener('click', function() {
		  document.getElementById('purchase-overlay').classList.remove('is-visible');
		  document.getElementById('purchase-confirmation').classList.remove('is-visible');
		});
		document.getElementById('purchase-overlay').addEventListener('click', function() {
		  document.getElementById('purchase-overlay').classList.remove('is-visible');
		  document.getElementById('purchase-confirmation').classList.remove('is-visible');
		});

		document.getElementById('submit').addEventListener('click', function(){
			if (document.getElementById('cust-name').value === '' || document.getElementById('phone').value === '') {
				alert('Please fill all form provided!');
			} else {
				document.getElementById('purchase-overlay').classList.remove('is-visible');
			  	document.getElementById('purchase-confirmation').classList.remove('is-visible');

			  	document.getElementById('payment-overlay').classList.add('is-visible');
		  		document.getElementById('payment-method').classList.add('is-visible');

		  		document.getElementById('close-btn').addEventListener('click', function() {
				  document.getElementById('payment-overlay').classList.remove('is-visible');
				  document.getElementById('payment-method').classList.remove('is-visible');
				});
				document.getElementById('payment-overlay').addEventListener('click', function() {
				  document.getElementById('payment-overlay').classList.remove('is-visible');
				  document.getElementById('payment-method').classList.remove('is-visible');
				});
			}
		});

		// window.addEventListener('load', function(){
		//   if (!window.matchMedia('(display-mode: fullscreen)').matches || window.document.fullscreenElement) {

		// 	document.getElementById('overlay-fullscreen').classList.add('is-visible');
		// 	document.getElementById('modal-fullscreen').classList.add('is-visible');

		//   }
		// });

		// if (document.addEventListener)
		// {
		//  document.addEventListener('fullscreenchange', exitHandler, false);
		//  document.addEventListener('mozfullscreenchange', exitHandler, false);
		//  document.addEventListener('MSFullscreenChange', exitHandler, false);
		//  document.addEventListener('webkitfullscreenchange', exitHandler, false);
		// }

		// function exitHandler()
		// {
		//  if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement)
		//  {
		//  	document.getElementById('overlay-fullscreen').classList.add('is-visible');
		// 	document.getElementById('modal-fullscreen').classList.add('is-visible');
		//  }
		// }
	</script>
</body>
</html>