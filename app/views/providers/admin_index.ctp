<table>
<?php
$this->set('pageTitle', __('Providers', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('name'),
	$paginator->sort('contact_person'),
	$paginator->sort('email'),
	$paginator->sort('phone'),
	$paginator->sort('balance'),
	$paginator->sort('default_commission'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Provider['id'], array('action' => 'view', $Provider['id'])),
			$Provider['name'],
			$Provider['contact_person'],
			$Provider['email'],
			$Provider['phone'],
			$Provider['balance'],
			$Provider['default_commission'],
		),
	);
	$class = $i%2?'even':'odd';
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $this->element('paging');
$menu->settings(__('Options', true), array());
$menu->add(array(
	array('title' => __('New Provider', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Providers', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Providers', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));