<h2><a href="http://blog.rifalia.com/" title="El Blog">El Blog</a></h2>
<ul>
<?php
/**
 * Switch to a shorter cache time
 */
$setting = MiCache::$setting;
MiCache::config(array('duration' => '+1 hour', 'prefix' => 'mi_feeds', 'name' => 'mi_feeds'));

/**
 * Get cached feed data, print it out
 */
$data = MiCache::data('Feed', 'read', array('http://blog.rifalia.com/feed/'));
foreach ($data as $row){
	printf ('<li><a href="%s">%s</a></li>',	$row['url'], $row['title']);
}

/**
 * Cleanup by resetting to default cache setting
 */
MiCache::$setting = $setting;
?>
</ul>