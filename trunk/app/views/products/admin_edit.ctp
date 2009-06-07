<?php

	$this->set('pageTitle', __('Editar Producto', true));


?>
<div class="form-container">
<?php
echo $form->create("Product", array('type' => 'file')); // Default to enable file uploads

echo $form->inputs(array(
	'legend' => false,
	'id',
	'category_id',
	'provider_id',
	'name',
	'short_description',
	'description',
	'commission' => array('size'=>'1', 'label'=> '% de Comision'),
	'price' => array('size'=>'4', 'label'=> 'Precio en euros'),
	'video_url',
	'is_approved',
));


if ($this->action === 'admin_add') {
	$form->inputs('is_approved');
}
echo $form->end(__('Submit', true));
?></div>