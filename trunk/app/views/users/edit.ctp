<?php /* SVN FILE: $Id$ */ ?>
<div class="container form">
<?php
$action = in_array($this->action, array('add', 'admin_add'))?'Add':'Edit';
$action = Inflector::humanize($action);
$profilePic = '';
if (!empty($data['User']['pic'])) {
	$profilePic = $this->element('thumb', array('data' => $data['User'], 'size' => 'thumb'));
}
echo $form->create(null, array('type' => 'file'));
echo $form->inputs(array(
	'legend' => __('Edit your profile', true),
	'id',
	'pic' => array('type' => 'file', 'before' => $profilePic, 'label' => __('Your profile picture', true)),
	'email',
	'first_name',
	'last_name',
));
echo $form->end('Submit');
echo $this->element('editor', array('process' => 'div#content textarea'));
?></div>