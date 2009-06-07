<h1>Datos de la rifa:</h1>
<p>
	Tickets totales: <?php echo $availableTickets; ?>
</p>
<p>
	Tickets vendidos: <?php echo $soldTickets; ?>
</p>
<p>
	Tickets restantes: <?php echo $remainingTickets; ?>
</p>
<p>
	Comprar!!
</p>
<p>
	<b>Producto:</b><br/>
	Short desc: <?php echo $productShortDescription ?><br/>
	Desc: <?php echo $productDescription ?><br/>
	Precio: <?php echo $price ?><br/>
</p>
<p>
	<b>Resultado de la rifa:</b><br/>
	<?php if(empty($winner_id)) { ?>
		Rifa abierta!! (Comprar)
	<?php } else { ?>
		El ganador ha sido: <?php echo $winner_user ?><br/>
		Boleto ganador: <?php echo $winner_code ?>
	<?php } ?>
</p>
