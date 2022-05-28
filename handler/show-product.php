<?php 
	include '../logic/connection.php';

	$sql2		=	"SELECT * FROM product ORDER BY product_name ASC";
	$keyword="";
	if (isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $sql2 = "SELECT * FROM product WHERE product_name LIKE '%".$keyword."%' OR price LIKE '%".$keyword."%' ORDER BY product_name ASC";
    }
    $query2 	=	mysqli_query($db_con, $sql2);
    WHILE($data2=	mysqli_fetch_array($query2)){
    $id_product	=	$data2['id_product'];
	$prod_name	=	$data2['product_name'];
	$price		=	$data2['price'];
	$image		=	$data2['image'];
	$stock		=	$data2['stock'];
	if ($stock == 0) {
?>
<a class="product-out-of-stock" type="button" disabled>
	<div class="status">
		<h2>OUT OF STOCK</h2>
	</div>
	<div class="product-information">
		<p hidden id="kata"><?php echo $id_product;?></p>
		<img src="../assets/images/product/<?php echo $image;?>">
		<h4 class="product-name"><?php echo $prod_name;?></h4>
		<p class="price">Rp <?php echo number_format($price);?></p>
	</div>
</a>		
<?php 
		} else {?>
			<a class="product" id="product" value="<?php echo $id_product;?>" onclick="getValue('<?php echo $id_product;?>')">
				<p hidden id="kata"><?php echo $id_product;?></p>
				<img src="../assets/images/product/<?php echo $image;?>">
				<h4 class="product-name"><?php echo $prod_name;?></h4>
				<p class="price">Rp <?php echo number_format($price);?></p>
			</a>
<?php
		}
	}
?>