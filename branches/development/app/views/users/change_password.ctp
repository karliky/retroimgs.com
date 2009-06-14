<?php /* SVN FILE: $Id$ */ ?>
<div class="container form">
<?php
echo $form->create(null, array('action' => 'change_password'));
echo $form->inputs(array(
	'legend' => __('Please enter a new password', true),
	'username' => array('type' => 'hidden'),
	'current_password' => array('type' => 'password'),
	'password',
	'confirm' => array('type' => 'password'),
	'generate' => array(
		'type' => 'checkbox',
		'label' => __('Generate me a random password (shown on the next screen)', true)
	),
	'strength' => array(
		'label' => __('password strength', true),
		'options' => $strengths,
		'default' => 'normal'
	)
));
echo $form->end(__('Submit', true));
?></div>