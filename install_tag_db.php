<?php
define('SKIP_ROUTE', 1);
include './index.php';

$sql = "CREATE TABLE IF NOT EXISTS `{$tablepre}tag` (
  `tagid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL DEFAULT '',
  `count` int(11) unsigned NOT NULL DEFAULT '0',
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tagid`),
  KEY `name` (`name`),
  KEY `enable` (`enable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
db_exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS `{$tablepre}thread_tag` (
  `tagid` int(11) unsigned NOT NULL DEFAULT '0',
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`, `tid`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
db_exec($sql);

echo "Tables created successfully.";
?>
