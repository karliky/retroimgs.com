<?php /* SVN FILE: $Id$ */
$this->set('pageTitle', __('Users', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs, 'action' => $this->action)); ?>
<table>
<?php
$th = array(
	__('Delete', true),
	__d('fieldnames', 'User Id', true),
	__d('fieldnames', 'User Login', true),
	__d('fieldnames', 'User Email', true),
	__d('fieldnames', 'User IsAdmin', true),
	__d('fieldnames', 'User IsEnabled', true),
	__d('fieldnames', 'User IsEmailVerified', true),
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
			$form->input($i . '.User.login', array('div' => false, 'label' => false)),
			$form->input($i . '.User.email', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_admin', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_enabled', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_email_verified', array('div' => false, 'label' => false)),
			$form->input($i . '.User.balance', array('div' => false, 'label' => false)),
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