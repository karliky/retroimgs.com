<?php
extract($data);
$this->set('pageTitle', $Product['name']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Product Id', true), $Product['id']),
	array(__d('field_names', 'Product Provider', true), $Provider?$Provider['name']:''),
	array(__d('field_names', 'Product Commission', true), $Product['commission']),
	array(__d('field_names', 'Product Category', true), $Category?$Category['name']:''),
	array(__d('field_names', 'Product Name', true), $Product['name']),
	array(__d('field_names', 'Product Short Description', true), $Product['short_description']),
	array(__d('field_names', 'Product Description', true), $Product['description']),
	array(__d('field_names', 'Product Price', true), $Product['price']),
	array(__d('field_names', 'Product Video Url', true), $Product['video_url']),
	array(__d('field_names', 'Product Is On Raffle', true), $Product['is_on_raffle']),
	array(__d('field_names', 'Product Is Approved', true), $Product['is_approved']),
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
$menu->settings(__('View', true));
foreach ($goto as $array) {
	extract($array);
	echo "if (!empty($title)) {\r\n";
	echo "\t\$menu->add(array(\r\n";
	echo "\t\t'title' => $title, 'url' => array('controller' => '$controller', 'action' => 'view', $id),\r\n";
	echo "\t));\r\n";
	echo "}\r\n";
}