<?php
/**
 * Resource loader module based on local LESS files.
 *
 * Inherits functionlity for handling local JS files.
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

/**
 * ResourceLoader module based on local JavaScript/CSS files.
 */
class ResourceLoaderLessFileModule extends ResourceLoaderFileModule {

	/**
	 * Get the URL or URLs to load for this module's CSS in debug mode.

	 * Re-enable the default behavior which is to return a load.php?only=styles
	 * URL for the module. Browsers do not directly support LESS files, so we do
	 * not want to load the files directly.
	 *
	 * @param $context ResourceLoaderContext
	 * @return array
	 */
	public function getStyleURLsForDebug( ResourceLoaderContext $context ) {
		return ResourceLoaderModule::getStyleURLsForDebug( $context );
	}

	/**
	 * Reads a style file.
	 *
	 * This method can be used as a callback for array_map()
	 *
	 * @param string $path File path of style file to read
	 * @param $flip bool
	 *
	 * @return String: CSS data in script file
	 * @throws MWException if the file doesn't exist
	 */
	protected function readStyleFile( $path, $flip ) {
		$localPath = $this->getLocalPath( $path );
		if ( !file_exists( $localPath ) ) {
			$msg = __METHOD__ . ": style file not found: \"$localPath\"";
			wfDebugLog( 'resourceloader', $msg );
			throw new MWException( $msg );
		}


		$lessCompiler = new lessc();

		$style = $lessCompiler->compileFile( $localPath );


		if ( $flip ) {
			$style = CSSJanus::transform( $style, true, false );
		}
		$dirname = dirname( $path );
		if ( $dirname == '.' ) {
			// If $path doesn't have a directory component, don't prepend a dot
			$dirname = '';
		}
		$dir = $this->getLocalPath( $dirname );
		$remoteDir = $this->getRemotePath( $dirname );
		// Get and register local file references
		$this->localFileRefs = array_merge(
			$this->localFileRefs,
			CSSMin::getLocalFileReferences( $style, $dir )
		);
		return CSSMin::remap(
			$style, $dir, $remoteDir, true
		);
	}

}
