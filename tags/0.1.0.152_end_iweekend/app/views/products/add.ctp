

<?php
$this->set('pageTitle', __('New Product', true));
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file','class'=>'cmxform')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => "Crear producto",
	'id',
	'categories_id' => array('options' => array('Temp', 'List', 'Of', 'Options'), 'empty' => true),
	'tittle' => array('title' => __('Write the name of your product here', true)),
	'short_description',
	'long_description' => array('type' => 'textarea'),
	'lat',
	'long',
	'zoom',
	'price',
	'order',
	'video',
	'video_type',
	'image' => array('type' => 'file'),
	'acept',
	'acepted_date' => array('type' => 'date'),
));
echo '<p>'.$form->submit('Crear Producto',array('class'=>'submit',"div"=>false)).'</p>';
//echo $form->end(__('Submit', true));
echo $form->end();
$javascript->link('productsAdd', false);
?>

<form action="" method="get" class="cmxform">
	<fieldset>
	<legend>Cálculo del modelo de ingresos</legend>
	<p><label for="precioVendedor">Precio Vendedor</label>
		<input type="text" name="precioVendedor" id="precioVendedor"></p>	
		
	<p><label for="precioVenta">Precio Salida</label>
		<input type="text" name="precioVenta" id="precioVenta" disabled="disabled"></p>
		
	<p><label for="precioPapeleta">Precio Papeleta</label>
		<input type="text" name="precioPapeleta" id="precioPapeleta"></p>
	<p><label for="factorMagico">Fáctor Mágico</label>
		<input type="text" name="factorMagico" id="factorMagico"></p>
	
	<p><label for="numPapeletas">Num Papeletas</label>
		<input type="text" name="numPapeletas" id="numPapeletas" style="font-weight:bold" disabled="disabled"></p>

	<p><label for="iva">Iva</label>
		<input type="text" name="iva" id="iva" disabled="disabled"></p>
	<p><label for="hacienda">Hacienda</label>
		<input type="text" name="hacienda" id="hacienda" disabled="disabled"></p>
	<p><label for="paypal">paypal</label>
		<input type="text" name="paypal" id="paypal" disabled="disabled"><input style="width:30px" type="text" name="paypalpc" id="paypalpc" value="3.5">%</p>
	<p><label for="notario">notario</label>
		<input type="text" name="notario" id="notario" disabled="disabled"> <input style="width:30px" type="text" name="notariopc" id="notariopc" value="4">%</p>
	<p><label for="rifalia">margen rifalia</label>
		<input type="text" name="rifalia" id="rifalia" disabled="disabled"><input style="width:30px" type="text" name="margenrifalia" id="margenrifalia" value="15">%</p>
		
	<p><label for="ingsincargas">ingreso sin cargas</label>
		<input type="text" name="ingsincargas" id="ingsincargas" disabled="disabled"></p>
	<p><label for="benefadicio">bºadicional</label>
		<input type="text" name="benefadicio" id="benefadicio" disabled="disabled">
		<span id="warnMsg" style="color:red;display:none">Ojo! no este producto no sale rentable</span>
		</p>
	</fieldset>
</form>




</div>
