<table>
<?php
$this->set('pageTitle', __('Signups', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('email'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Signup['id'], array('action' => 'view', $Signup['id'])),
			$Signup['email'],
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
	array('title' => __('New Signup', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Signups', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Signups', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));