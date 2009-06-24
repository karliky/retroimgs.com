<ul id="contenedor_destacado"><?php
foreach($data as $row) {
	echo '<li class="producto_destacado">' . $this->element('featured_item', array('data' => $row)) . '</li>';
}
?></ul>