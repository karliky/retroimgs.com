<div class="form-container">
<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Product', true));
} else {
	$this->set('pageTitle', __('Edit Product', true));
}

$javascript->link(array('jquery.mi_lookups'), false, 'extras');
$html->css(array('jquery.tokeninput'), null, null, false, 'extras');
if (!empty($this->data['Media']['id'])) {
	echo '<span style="height:100%;padding:10px;float:right;border:1px solid grey;">' . $html->imageLink($this->data['Media'], 'icon', 'large', array('class' =>
'popup')) . '</span>';
}
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'fieldset' => false,
	'id',
	'provider_id' => array('empty' => true),
	'category_id' => array('empty' => true),
	'Media.id',
	'MediaLink.id',
	'MediaLink.model' => array('type' => 'hidden', 'value' => 'Product'),
	'MediaLink.main' => array('type' => 'hidden', 'value' => 1),
	'Media.filename' => array('type' => 'file', 'label' => __('Upload a new image', true)),
	'MediaLink.media_id' => array('type' => 'text', 'class' => 'lookup', 'label' => __('Or select an existing image', true)),
	'name',
	'short_description',
	'description',
	'price',
	'commission',
	'video_url',
	'is_on_raffle',
	'is_approved',
));
?>
<br style="clear:left;" /></fieldset>
<?php
echo $form->end(__('Submit', true));
echo $this->element('product_commission_form');
?></div>