<?php
/**
 * Xblock skin
 *
 * @file
 * @ingroup Skins
 * @author Laker Sparks (lsparks@roblox.com)
 */

if( !defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array (
	'path' => __FILE__,
	'name' => 'Xblock',
	'url' => "http://172.17.249.148:8080/mediawiki/index.php",
	'author' => 'lsparks',
	'descriptionmsg' => 'robloxwiki-desc',
);

$wgValidSkinNames['xblock'] = 'Xblock';
$wgAutoloadClasses['SkinXblock'] = dirname(__FILE__).'/Xblock.skin.php';
$wgExtensionMessagesFiles['Xblock'] = dirname(__FILE__).'/Xblock.i18n.php';

/*$wgResourceModules['skins.myskin'] = array(
	'styles' => array(
		'xblock/css/screen.css' => array( 'media' => 'screen' ),
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);*/

// register Bootstrap modules
Bootstrap::getBootstrap()->addAllBootstrapModules();
Bootstrap::getBootstrap()->addExternalModule(__DIR__, 'xblock/css/screen.less');
