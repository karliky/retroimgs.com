<table>
<?php
$this->set('pageTitle', __('Memberships', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('User.username'),
	$paginator->sort('Organization.name'),
	$paginator->sort('is_admin'),
	$paginator->sort('admin_priority'),
	$paginator->sort('is_contact'),
	$paginator->sort('contact_priority'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Membership['id'], array('action' => 'view', $Membership['id'])),
			$User?$User['username']:'',
			$Organization?$Organization['name']:'',
			$Membership['is_admin'],
			$Membership['admin_priority'],
			$Membership['is_contact'],
			$Membership['contact_priority'],
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
	array('title' => __('New Membership', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Memberships', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Memberships', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));