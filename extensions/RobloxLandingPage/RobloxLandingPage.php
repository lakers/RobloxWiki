<?php

$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'RobloxLandingPage',
	'author' => 'Laker Sparks',
	'url' => 'http://localhost:8080/mediawiki/index.php',
	'descriptionmsg' => 'robloxlandingpage-desc',
	'version' => '1.0',
);

$wgAutoloadClasses[ 'SpecialRobloxWiki' ] = __DIR__ . '/SpecialRobloxWiki.php'; # Location of the SpecialMyExtension class (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles[ 'RobloxLandingPage' ] = __DIR__ . '/RobloxLandingPage.i18n.php'; # Location of a messages file (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles[ 'RobloxLandingPageAlias' ] = __DIR__ . '/RobloxLandingPage.alias.php'; # Location of an aliases file (Tell MediaWiki to load this file)
$wgSpecialPages[ 'RobloxLandingPage' ] = 'SpecialRobloxWiki'; # Tell MediaWiki about the new special page and its class name
