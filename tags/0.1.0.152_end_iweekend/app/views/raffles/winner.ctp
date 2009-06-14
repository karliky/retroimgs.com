<h1>Ganador de la rifa:</h1>
<p>
<?php if(empty($winner)) { ?>
	No hay ning&uacute;n ticket vendido.
<?php } else { ?>
	Ticket premiado en la rifa <?php echo $raffle; ?>: Ticket <?php echo $winner; ?>
<?php } ?>
</p>
