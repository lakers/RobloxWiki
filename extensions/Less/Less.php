<?php
/**
 * An extension providing the lessphp compiler
 *
 * lessphp is a compiler for LESS written in PHP.
 *
 * @see https://www.mediawiki.org/wiki/Extension:Less
 * @see http://leafo.net/lessphp/
 *
 * @author Stephan Gambke
 * @version 0.1 alpha
 *
 * @defgroup Less Less
 */

/**
 * The main file of the Less extension
 *
 * @copyright (C) 2013, Stephan Gambke
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 (or later)
 *
 * This file is part of the MediaWiki extension Less.
 * The Less extension is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * The Less extension is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
  *
 * @file
 * @ingroup Less
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is part of a MediaWiki extension, it is not a valid entry point.' );
}

/**
 * The extension version
 */
define( 'LESS_VERSION', '0.1 alpha' );

// register the extension
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Less',
	'author' => '[http://www.mediawiki.org/wiki/User:F.trott Stephan Gambke]',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Less',
	'descriptionmsg' => 'bootstrap-desc',
	'version' => LESS_VERSION,
);


// server-local path to this file
$dir = dirname( __FILE__ );

// register message files
$wgExtensionMessagesFiles['Less'] = $dir . '/Less.i18n.php';

// register class files with the Autoloader
$wgAutoloadClasses['lessc'] = $dir . '/lessphp/lessc.inc.php';
$wgAutoloadClasses['ResourceLoaderLessFileModule'] = $dir . '/ResourceLoaderLessFileModule.php';
