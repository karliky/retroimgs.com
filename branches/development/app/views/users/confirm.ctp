<?php /* SVN FILE: $Id$ */ ?>
<div class="container form">
<fieldset>
<legend>Introduce los datos personales</legend>
<?php
echo $form->create(null, array('url' => '/' . $this->params['url']['url'], "class"=>"cmxform"));
?>

<?php

$inputs = array('legend' => __('Introduzca el token del email', true), $fields['email']);

if ($fields['confirmation']) {
	$inputs[] = $fields['confirmation'];
}

$inputs['token'] = array('legend' => __('token', true), 'size' => 40, 'default' => $token, "div"=>false);
echo "<p>".$form->inputs($inputs, array('div'=>false))."</p>";
//echo $form->end(__('Submit', true));

?>
</fieldset>
</div>