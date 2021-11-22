<div id="shopping-cart">

<div class="txt-heading">Shopping Cart</div>
	    <a id="btnEmpty" href = "<?= URL.'/chariot/emptyCard' ?>">Empty Cart</a>
        <a id="btnEmpty" class = "mx-2" style="background-color: green; font-weight: bold; color:honeydew; " href = "<?= URL.'/chariot/commander' ?>">Commander</a>
	<?php
		if(isset($_SESSION["cart_item"])){
			$total_quantity = 0;
			$total_price = 0;
	?>	
<!--	<table class="tbl-cart" cellpadding="10" cellspacing="1">
		<tbody>
			<tr>
				<th style="text-align:left;">NOM</th>
				<th style="text-align:left;">CODE</th>
				<th style="text-align:right;" width="5%">QUANTITE</th>
				<th style="text-align:right;" width="10%">PRIX UNIT</th>
				<th style="text-align:right;" width="10%">PRIX</th>
				<th style="text-align:center;" width="5%">Remove</th>
			</tr>
        -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Nom Produit</th>
                <th scope="col">Ref produit</th>
                <th scope="col">Quantite</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Prix TTC</th>
                <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
               
	<?php		
		foreach ($_SESSION["cart_item"] as $item){
			$item_price = ((int)$item["quantite"]* (int)$item["prix"]);
	?>
			<tr>
				<td><img height="150px" src="<?= URL . '/public/images/produits/' . $item["image"]; ?>" class="cart-item-image" /></td>
                <td><?= $item["labels"]; ?></td>
				<td><?= $item["code"]; ?></td>
				<td><?=  $item["quantite"]; ?></td>
				<td><?= "$ ".$item["prix"]; ?></td>
				<td><?= "$ ". number_format($item_price,2); ?></td>
				<td><a href="<?= URL.'/chariot/remove/'.$item["code"]; ?>" class="btnRemoveAction"><img height = "80px" src= <?= URL ."/public/images/icone-delete.png" ?> alt="Remove Item" /></a></td>
			</tr>
				
		<?php
				$total_quantity += (int)$item["quantite"];
				$total_price += ((int)$item["prix"]*(int)$item["quantite"]);
		}
		?>

			<tr>
				<td colspan="2" style = "text-align:right">Total:</td>
				<td style = "text-align:right"><?php echo $total_quantity; ?></td>
				<td style = "text-align:right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
				<td></td>
			</tr>
		</tbody>
	</table>		

	<?php } else { ?>
	
	<div class="no-records">Your Cart is Empty</div>
	<?php } ?>
	</div>
