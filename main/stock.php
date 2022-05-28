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
	<title>BAKE.ID - Stock</title>

	<script>
		// Script ganti gambar button
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

		// Script Search dan Show Data
		$(document).ready(function(){
			load_data();
			function load_data(search){
				$.ajax({
					url:"../handler/show-stock.php",
					method:"POST",
					data: {
						search: search
					},
					success:function(data){
						$('.product-wrapper').html(data);
					}
				});
			}
			$('#search').keyup(function(){
				var search = $('#search').val();
				load_data(search);
			});
		});

		// Script Untuk Kelola Stock Produk
		function stockHandler(id_product, status) {
			var id = id_product;
			var status = status;
			// alert(id + status + value);
			$.ajax({
				type: 'POST',
				url: '../logic/stock-handler.php',
				data: {'id-product':id_product, 'status': status },
				success: function() {
					$('.product-wrapper').load('../handler/show-stock.php');
				}
			})
		}

		//Script untuk hapus produk
		function deleteProduct(id_product) {
			var id = id_product;
			$.ajax({
				type: 'POST',
				url: '../logic/delete-product.php',
				data: {'id-product':id},
				success: function() {
					$('.product-wrapper').load('../handler/show-stock.php');
				}
			})
		}
	</script>
</head>
<body> 
	<div class="container">
		<div class="left">
			<a href="../main/"><img src="../assets/images/bake-id.png"></a>

			<a href="../main/" class="home" id="home" onmouseover="changeHome();" onmouseout="changeHomeRevs();"><img src="../assets/images/home-inactive.png" id="home-img">Home</a>

			<a href="transaction" class="transaction" id="transaction" onmouseover="changeTransaction();" onmouseout="changeTransactionRevs();"><img src="../assets/images/transaction.png" id="transaction-img">Transaction</a>

			<a href="stock" class="stock active" id="stock"><img src="../assets/images/stock-white.png" id="stock-img">Stock</a>

			<a href="../logic/logout" class="logout" id="logout" onmouseover="changeImg();" onmouseout="changeImgRevs();"><img src="../assets/images/logout.png" id="logout-img">Logout</a>
		</div>
		<div class="center-stock" id="main-section">
			<div class="header-stock">
				<p class="order-menu"><strong>Product</strong> Stock</p>
				<form action="" method="POST">
					<span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
					<input type="text" name="search" id="search" placeholder="Search">
				</form>
			</div>
			<div class="content">
				<div class="add-product">
					<a id="open-modal">Add New Product&nbsp;<span class="fa-solid fa-plus"></span></a>
				</div>
				<div class="product-wrapper">
					
				</div>
			</div>
		</div>
	</div>
	<!-- Add New Product Modal -->
	<div class="add-product-overlay" id="add-product-overlay"></div>
	<div class="add-product-modal" id="add-product-modal">
	  <button class="modal-close-btn" id="close-btn"></button>
	  <div class="new-product">
	  	<p><strong>New</strong> Product</p>
	  </div>
	  <div class="add-product-form">
	  	<form method="POST" class="form-input" enctype="multipart/form-data">
	  		<input type="text" name="name" placeholder="Product Name" required id="name">
	  		<input type="text" name="price" placeholder="Product Price" required id="price">
	  		<input type="text" name="stock" placeholder="Initial Stock (optional)" id="stocks">
	  		<div class="replace-input-file" id="image">
	  			<p>Upload an image here</p>
	  		</div>
	  		<input type="file" name="image" id="input-file">
	  		<a class="save">Submit</a>
	  	</form>
	  </div>
	</div>
	<!-- Success Add New Product Modal -->
	<div class="overlay" id="overlay"></div>
	<div class="modal" id="modal">
	  <button class="modal-close-btn" id="close-btn"></button>
	  <img src="../assets/images/successful.png">
	  <h4>Product Added Successfully</h4>
	  <p>Tap anywhere to close</p>
	  <!-- <a class="print-receipt">Print Receipt</a> -->
	</div>
	<script>
		// Modal Add New Product (Start)
		document.getElementById('open-modal').addEventListener('click', function() {
		  document.getElementById('add-product-overlay').classList.add('is-visible');
		  document.getElementById('add-product-modal').classList.add('is-visible');
		});

		document.getElementById('close-btn').addEventListener('click', function() {
		  document.getElementById('add-product-overlay').classList.remove('is-visible');
		  document.getElementById('add-product-modal').classList.remove('is-visible');
		});
		document.getElementById('add-product-overlay').addEventListener('click', function() {
		  document.getElementById('add-product-overlay').classList.remove('is-visible');
		  document.getElementById('add-product-modal').classList.remove('is-visible');
		});
		// Modal Add New Product (End)
		$('.replace-input-file').click(function() {
			$('#input-file').click();
		});

		function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
	                $('#image').css("background-image", 'url(' + e.target.result + ')');
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    
	    $("#input-file").change(function(){
	        readURL(this);
	    });

	    //Script Input Produk Baru
		$(document).ready(function() {
			$('.save').click(function() {
				if (document.getElementById('name').value=='' || document.getElementById('price').value=='' || document.getElementById('input-file').value=='') {
					alert('Please fill the form provided!');
				} else {
					const image = $('#input-file').prop('files')[0];

					let formData = new FormData();
					formData.append('name', $('#name').val());
					formData.append('price', $('#price').val());
					formData.append('stock', $('#stocks').val());
					formData.append('image', image);

					$.ajax({
						type: 'POST',
						url: '../logic/product.php',
						data: formData,
						success: function() {
							document.getElementById('name').value='';
							document.getElementById('price').value='';
							document.getElementById('stocks').value='';
							document.getElementById('input-file').value='';
							document.getElementById('image').style.backgroundImage = 'unset';

							document.getElementById('add-product-overlay').classList.remove('is-visible');
							document.getElementById('add-product-modal').classList.remove('is-visible');
							
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
							$('.product-wrapper').load('../handler/show-stock');
						},
						cache: false,
						contentType: false,
						processData: false,
					});
				};
			});
		});
	</script>
</body>
</html>