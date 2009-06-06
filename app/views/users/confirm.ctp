<?php /* SVN FILE: $Id$ */ ?>
<div class="container form">
<?php
echo $form->create(null, array('url' => '/' . $this->params['url']['url']));
$inputs = array('legend' => __('Please enter your email token', true), $fields['email']);
if ($fields['confirmation']) {
	$inputs[] = $fields['confirmation'];
}
$inputs['token'] = array('legend' => __('token', true), 'size' => 40, 'default' => $token);
echo $form->inputs($inputs);
echo $form->end(__('Submit', true));
?></div>