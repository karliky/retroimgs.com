<?php
$this->set('pageTitle', __('New Raffle', true));
?>
<div class="form-container">
<?php
echo $form->create();
echo $form->inputs(array(
	'legend' => false,
	'id',
	'available_tickets',
	'ticket_price',
	'closes',
	'parent_id',
	'is_published',
	'published',
));
echo $form->end(__('Submit', true));
?></div>
