<?php /* SVN FILE: $Id$ */
echo $html->docType('xhtml-trans'); ?>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<?php echo $html->charset(); ?>
<title><?php echo htmlspecialchars($title_for_layout); ?></title>
<?php
if (!isset($pageTitle)) {
	$pageTitle = $title_for_layout;
}
echo $html->meta('icon');
echo $html->css(array(
	'admin_default', 'jquery.tokeninput',
	'/js/theme/ui.all',
	'form'
), null, null, false);
echo $html->css();
if (isset ($javascript)) {
	echo $javascript->link(array(
		'jquery.blockUI',
		'jquery.mi_cloner', 'jquery.mi_dialogs',
		'admin_default'
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
<?php echo $this->element('admin/header'); ?>
	<div id='container'>
		<div id='content'>
			<?php echo $this->element('flash'); ?>
			<h2><?php echo htmlspecialchars($pageTitle); ?></h2>
			<div class="container"><?php echo $content_for_layout; ?></div>
		</div>
		<?php echo $this->element('admin/menu/bar'); ?>
		<?php echo $this->element('hover_menu'); ?>
	</div><?php
echo $this->element('admin/footer');
echo $javascript->link();
?></body>
</html>