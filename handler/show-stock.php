<?php 
	include '../logic/connection.php';
	$sql 			=	"SELECT * FROM product";
	$keyword		=	'';
	if (isset($_POST['search'])) {
		$keyword	=	$_POST['search'];
		$sql 		=	"SELECT * FROM product WHERE product_name LIKE '%".$keyword."%' OR price LIKE '%".$keyword."%' ORDER BY product_name ASC";
	}
	$query 			=	mysqli_query($db_con, $sql);
	WHILE(	$data 	=	mysqli_fetch_array($query)){
	$id_product 	=	$data['id_product'];
	$name 			=	$data['product_name'];
	$price 			=	$data['price'];
	$image			=	$data['image'];
	$stock 			=	$data['stock'];
?>
<div class="product">
	<img src="../assets/images/product/<?php echo $image;?>">
	<div class="name-price">
		<h4><?php echo $name;?></h4>
		<p>Rp <?php echo number_format($price);?></p>
	</div>
	<div class="delete fa-solid fa-trash" onclick="deleteProduct(<?php echo $id_product;?>)">
		
	</div>
	<div class="stock-input">
		<div class="input-button fa-solid fa-minus" id="minus" onclick="stockHandler(<?php echo $id_product;?>, 'decrease')"></div>
		<input type="number" name="item-value" id="stock-input" value="<?php echo $stock;?>" readonly>
		<div class="input-button fa-solid fa-plus" id="plus" onclick="stockHandler(<?php echo $id_product;?>, 'increase')"></div>
	</div>
</div>
<?php
	}
?>