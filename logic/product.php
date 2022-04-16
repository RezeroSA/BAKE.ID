<?php 
	include 'connection.php';

	$name 			=	$_POST['name'];
	$price 			=	$_POST['price'];
	$stock 			=	$_POST['stock'];

	// $namaFile 		= $_FILES['image']['name'];
	// $namaSementara 	= $_FILES['image']['tmp_name'];
	// $dirUpload 		= "../assets/images/product/".$namaFile;
	// $terupload 		= move_uploaded_file($namaSementara, $dirUpload);

	$nama_file_baru 	= $_FILES['image']['name'];
	$ukuran_file 		= $_FILES['image']['size'];
	$tipe_file 			= $_FILES['image']['type'];
	$lokasi_ambil_file 	= $_FILES['image']['tmp_name'];
	$lokasi_simpan_file = "../assets/images/product/".$nama_file_baru;
	move_uploaded_file($lokasi_ambil_file, $lokasi_simpan_file);

	$sql 			=	"INSERT INTO product (product_name, price, image, stock) VALUES ('$name', '$price', '$nama_file_baru', '$stock')";
	$query 			=	mysqli_query($db_con, $sql);
?>