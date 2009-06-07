<?php
	$this->set('pageTitle', __('Añadir Producto', true));
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
	'commission',
	'price',
	'video_url',
));

echo $form->end(__('Submit', true));



$menu->settings(__('Options', true), array());
$menu->add(array(
	array('title' => __('New Product', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Products', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Products', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));





?></div>