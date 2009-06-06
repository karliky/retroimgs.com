<?php /* SVN FILE: $Id$ */
$this->set('pageTitle', __('Users', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs, 'action' => $this->action)); ?>
<table>
<?php
$th = array(
	__('Delete', true),
	__d('fieldnames', 'User Id', true),
	__d('fieldnames', 'User Username', true),
	__d('fieldnames', 'User First Name', true),
	__d('fieldnames', 'User Last Name', true),
	__d('fieldnames', 'User Email', true),
	__d('fieldnames', 'User Group', true),
	__d('fieldnames', 'User Email Verified', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['User'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$html->link('x', array('action' => 'delete', $row['User']['id'])),
			$User['id'] . $form->input($i . '.User.id', array('type' => 'hidden')),
			$form->input($i . '.User.username', array('div' => false, 'label' => false)),
			$form->input($i . '.User.first_name', array('div' => false, 'label' => false)),
			$form->input($i . '.User.last_name', array('div' => false, 'label' => false)),
			$form->input($i . '.User.email', array('div' => false, 'label' => false)),
			$form->input($i . '.User.group', array('div' => false, 'label' => false)),
			$form->input($i . '.User.email_verified', array('div' => false, 'label' => false)),
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