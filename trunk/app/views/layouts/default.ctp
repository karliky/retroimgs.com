<?php /* SVN FILE: $Id$ */
echo $html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo htmlspecialchars($title_for_layout); ?></title>
<?php
echo $html->meta('icon');
$stripNamed = array(
	'page' => false,
	'fields' => false,
	'order' => false,
	'limit' => false,
	'recursive' => false,
	'sort' => false,
	'direction' => false,
	'step' => false,
);
echo $html->meta('canonical', am($this->passedArgs, $stripNamed));
echo $html->css(array(
	'default',
	'/js/theme/ui.all',
	'form'
), null, null, false);
echo $html->css();

if (isset ($javascript)) {
	echo $javascript->link(array(
		'jquery.searchField', 'jquery.blockUI',
		'jquery.mi_dialogs',
		'default',
	), false);
	$locale = I18n::getInstance()->l10n->locale;
	if ($locale !== 'eng' && file_exists(APP . 'locale' . DS . $locale)) {
		echo $javascript->link('i18n.' . $locale, false, 'localization');
	}
}
echo $scripts_for_layout;
?>
</head>
<body>
	<div id="contenedor">
		<?php echo $this->element('header'); ?>
		<div id='wrapper' class="clearfix">
			<div id="content"><?php
				echo $this->element('flash');
				echo $content_for_layout;
			?></div>
			<?php echo $this->element('menu/side'); ?>
			<?php //echo $this->element('hover_menu'); ?>
		</div>
		<?php echo $this->element('footer'); ?>
	</div>
<?php echo $javascript->link(); ?>
</body>
</html>
