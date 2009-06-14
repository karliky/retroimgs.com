<?php
$this->set('pageTitle', __('New Raffle', true));
?>
<div class="form-container">
<?php
echo $form->create(null,array("class"=>"cmxform"));
echo $form->inputs(array(
	'legend' => "Edición de rifa",
	'id',
	'product_id',
	'available_tickets',
	'ticket_price',
	'closes',
	//'parent_id',
	'is_published',
	'published',
));

echo '<p>'.$form->submit('Enviar',array('class'=>'submit',"div"=>false)).'</p>';
echo $form->end();
?></div>
