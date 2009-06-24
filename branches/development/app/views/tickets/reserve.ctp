<?php
if (!empty($this->data['Ticket']['numbers'])) {
	echo $form->create(null, array('class' => 'cmxform'));
	echo '<fieldset>';
	echo $form->inputs(array(
		'fieldset' => false,
		'legend' => __('Reserve your tickets', true),
		'raffle_id' => array('type' => 'hidden'),
		'numbers' => array('type' => 'hidden', 'value' => implode($this->data['Ticket']['numbers'], ', ')),
	));
	$i = 0;
	foreach($this->data['Ticket']['numbers'] as $id => $code) {
		echo $form->input('Ticket.' . $i . '.id', array('value' => $id, 'type' => 'hidden'));
		echo $form->input('Ticket.' . $i . '.code', array(
			'value' => $code, 'label' => sprintf(__('Ticket #%s', true), $i + 1), 'disabled' => true));
		$i++;
	}
	echo '</fieldset>';
	echo $form->end(__('Reserve', true));
	return;
}
?>
<div id="contenido_iz">
	<div class="producto_destacado"><?php
	echo $this->element('featured_item', array('data' => $raffle, 'hideButton' => true));
	?></div>
</div>
<p><?php echo $html->clean($raffle['Product']['description']); ?></p>
<?php
echo $form->create(null, array('class' => 'cmxform clear'));
echo $form->inputs(array(
	'legend' => __('Check ticket availability', true),
	'raffle_id' => array('type' => 'hidden'),
	'quantity' => array('label' => __('How Many', true), 'default' => 1),
	'number' => array('label' => __('Or select a specific ticket number', true)),
));
echo $form->end(__('Reserve', true));