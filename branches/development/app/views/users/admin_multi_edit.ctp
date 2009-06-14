<?php
$this->set('pageTitle', __('Users', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'User Id', true),
	__d('fieldnames', 'User Login', true),
	__d('fieldnames', 'User Email', true),
	__d('fieldnames', 'User Address', true),
	__d('fieldnames', 'User Phone', true),
	__d('fieldnames', 'User Balance', true),
	__d('fieldnames', 'User Is Admin', true),
	__d('fieldnames', 'User Is Enabled', true),
	__d('fieldnames', 'User Is Email Verified', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['User'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$User['id'] . $form->input($i . '.User.id', array('type' => 'hidden')),
			$form->input($i . '.User.login', array('div' => false, 'label' => false)),
			$form->input($i . '.User.email', array('div' => false, 'label' => false)),
			$form->input($i . '.User.address', array('div' => false, 'label' => false)),
			$form->input($i . '.User.phone', array('div' => false, 'label' => false)),
			$form->input($i . '.User.balance', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_admin', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_enabled', array('div' => false, 'label' => false)),
			$form->input($i . '.User.is_email_verified', array('div' => false, 'label' => false)),
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