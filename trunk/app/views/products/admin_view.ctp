<?php
extract($data);
$this->set('pageTitle', $Product['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Product Id', true), $Product['id']),
	array(__d('field_names', 'Product Tittle', true), $Product['tittle']),
	array(__d('field_names', 'Product Short Description', true), $Product['short_description']),
	array(__d('field_names', 'Product Long Description', true), $Product['long_description']),
	array(__d('field_names', 'Product Lat', true), $Product['lat']),
	array(__d('field_names', 'Product Long', true), $Product['long']),
	array(__d('field_names', 'Product Zoom', true), $Product['zoom']),
	array(__d('field_names', 'Product Price', true), $Product['price']),
	array(__d('field_names', 'Product Order', true), $Product['order']),
	array(__d('field_names', 'Product Video', true), $Product['video']),
	array(__d('field_names', 'Product Video Type', true), $Product['video_type']),
	array(__d('field_names', 'Product Image', true), $Product['image']),
	array(__d('field_names', 'Product Acept', true), $Product['acept']),
	array(__d('field_names', 'Product Acepted Date', true), $Product['acepted_date']),
	array(__d('field_names', 'Product Categories Id', true), $Product['categories_id']),
	array(__d('field_names', 'Product Raffles Id', true), $Product['raffles_id']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Product', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Product['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Product['id']))
));
