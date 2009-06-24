<?php
$this->set('pageTitle', __('Memberships', true));
echo $form->create(); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Membership Id', true),
	__d('fieldnames', 'Membership User', true),
	__d('fieldnames', 'Membership Organization', true),
	__d('fieldnames', 'Membership Is Admin', true),
	__d('fieldnames', 'Membership Admin Priority', true),
	__d('fieldnames', 'Membership Is Contact', true),
	__d('fieldnames', 'Membership Contact Priority', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Membership'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Membership['id'] . $form->input($i . '.Membership.id', array('type' => 'hidden')),
			$form->input($i . '.Membership.user_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Membership.organization_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Membership.is_admin', array('div' => false, 'label' => false)),
			$form->input($i . '.Membership.admin_priority', array('div' => false, 'label' => false)),
			$form->input($i . '.Membership.is_contact', array('div' => false, 'label' => false)),
			$form->input($i . '.Membership.contact_priority', array('div' => false, 'label' => false)),
		),
	);
	$class = $i%2?'even':'odd';
	if ($this->action === 'admin_multi_add') {
		$class .= ' clone';
	}
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $form->end(__('Submit', true));