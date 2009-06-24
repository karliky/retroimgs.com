<div class="producto">
	<h3><?php echo h($data['Product']['name']) ?></h3>
	<?php echo $rifalia->picture($data['Raffle']['product_id'], 'small', array('default' => true)); ?>
	<div class="descripcion">
		<p class="stock_boletos"><?php
			$remaining = $data['Raffle']['available_tickets'] - $data['Raffle']['sold_tickets'];
			if ($remaining < $data['Raffle']['available_tickets'] / 10) {
				printf(__('Only %s tickets left', true), $remaining);
			} else {
				printf(__('%s tickets available', true), $remaining);
			}
		?></p>
		<p><?php printf(__('Time remaining: %s', true), $rifalia->timeRemaining($data['Raffle']['closes'])) ?></p>
		<p class="precio"><?php printf(__('Your ticket for only %s', true), $rifalia->price($data['Raffle']['ticket_price'])) ?></p>
		<div class="boton_reserva"><?php
			echo $html->link(__('Reserve your ticket', true), array(
				'controller' => 'tickets',
				'action' => 'reserve',
				$data['Raffle']['id'],
				$data['Product']['slug'],
			));
		?></div>
	</div>
</div>