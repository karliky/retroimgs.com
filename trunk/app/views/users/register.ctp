<?php /* SVN FILE: $Id$ */
echo $form->create(null, array('url' => '/' . ltrim($this->params['url']['url'], '/')));
$out = '';
$out .= $form->input('login');

/*
$firstName = $form->input('first_name', array('fieldset' => false, 'div' => 'floater'));
$lastName = $form->input('last_name', array('fieldset' => false, 'div' => 'floater floaterLast'));
$out .= $html->tag('div', $firstName . $lastName, array('class' => 'input clearFix'));
*/
$out .= $form->input('email');
$password = $form->input('password', array('fieldset' => false, 'div' => 'floater', 'error' => false));
$confirm = $form->input('confirm', array('fieldset' => false, 'div' => 'floater floaterLast', 'type' => 'password'));
$pwError = $form->error('password');
$out .= $html->tag('div', $password . $confirm . $pwError, array('class' => 'input clearFix'));

/*
$out .= $form->input('generate', array('fieldset' => false, 'type' => 'checkbox',
	'label' => __('Generate me a random password (shown on the next screen)', true)));
$strengths = array(
	'weak' => __('weak', true),
	'normal' => __('normal', true),
	'medium' => __('medium', true),
	'strong' => __('strong', true),
);
$out .= $form->input('strength', array('fieldset' => false, 'label' => __('password strength', true), 'options' => $strengths, 'default' => 'normal'));
*/
$tos = array('controller' => 'pages', 'action' => 'display', 'tos');
$out .= $form->input('tos', array('fieldset' => false, 'type' => 'checkbox',
	'label' => sprintf(__('I agree to the site %1$s', true), $html->link(__('terms of service', true), $tos, array('class' => 'popup modal noResize noDrag')))
));

echo sprintf($html->tags['fieldset'], '', sprintf($html->tags['legend'], __('Registration', true)) . $out);
echo $form->end(__('sign up', true));
?>