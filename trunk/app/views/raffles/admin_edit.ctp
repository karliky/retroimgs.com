<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Raffle', true));
} else {
	$this->set('pageTitle', __('Edit Raffle', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('class'=>'cmxform','type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => "Edición de rifa",
	'id',
	'available_tickets',
	'ticket_price',
	'sold_tickets',
	'closes',
	'parent_id',
	'is_published',
	'published',
	'is_assigned',
	'assigned',
	'winner_id' => array('empty' => true),
	'winner_code',
	'is_cancelled',
	'cancelled',
));
echo $form->end(__('Submit', true));
?></div>