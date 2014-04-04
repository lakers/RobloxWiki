<?php
/**
* Skin file for skin My Skin.
*
* @file
* @ingroup Skins
*/

//require_once( dirname( __FILE__ ) . '/../Vector.php' );

/**
 * SkinTemplate class for My Skin skin
 * @ingroup Skins
 */
class SkinXblock extends SkinVector {

	var $skinname = 'xblock', $stylename = 'xblock',
	$template = 'XblockTemplate', $useHeadElement = true;

	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );

		$out->addModuleStyles('ext.bootstrap');
		$out->addStyle('xblock/css/main.css', 'screen');
	}

	/**
	 * @param OutputPage $out
	 */
	function initPage(OutputPage $out) {
		parent::initPage($out);

		// bootstrap
		$out->addModules(array('ext.bootstrap'));
	}
}

class XblockTemplate extends BaseTemplate {
	public function execute() {
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$nav = $this->data['content_navigation'];
		
		$xmlID = '';
		foreach ( $nav as $section => $links ) {
			foreach ( $links as $key => $link ) {
				if ( $section == 'views' && !( isset( $link['primary'] ) && $link['primary'] ) ) {
					$link['class'] = rtrim( 'collapsible ' . $link['class'], ' ' );
				}

				$xmlID = isset( $link['id'] ) ? $link['id'] : 'ca-' . $xmlID;
				$nav[$section][$key]['attributes'] =
					' id="' . Sanitizer::escapeId( $xmlID ) . '"';
				if ( $link['class'] ) {
					$nav[$section][$key]['attributes'] .=
						' class="' . htmlspecialchars( $link['class'] ) . '"';
					unset( $nav[$section][$key]['class'] );
				}
				if ( isset( $link['tooltiponly'] ) && $link['tooltiponly'] ) {
					$nav[$section][$key]['key'] =
						Linker::tooltip( $xmlID );
				} else {
					$nav[$section][$key]['key'] =
						Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( $xmlID ) );
				}
			}
		}
		
		$this->data['namespace_urls'] = $nav['namespaces'];
		$this->data['view_urls'] = $nav['views'];
		$this->data['action_urls'] = $nav['actions'];
		$this->data['variant_urls'] = $nav['variants'];
		

		$this->html('headelement');?>
<div class="page-wrap">

	<?php #Navbar definition ?>
	<div class="navbar navbar-default p-navbar" role="navigation">
		<div class="container">
			<ul class="nav navbar-nav" style="font-size: 18px;font-family: News Cycle, Arial Narrow Bold, sans-serif;font-weight: 700;">
	<?php #Wiki Icon and link to homepage ?>
				<li>
					<a class="main-icon-link"  href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']) ?>"><img src="<?php $this->text('logopath')?>" class="main-icon-image"></a>
				</li>
		<?php if (count($this->data['namespace_urls']) > 1) { ?>
				<li><?php $viewhref = $this->data['view_urls']['view']['href']; $talkhref = $this->data['namespace_urls']['talk']['href']; $cmpLeng = min(strlen($viewhref), strlen($talkhref)); if(strncmp($viewhref, $talkhref, $cmpLeng) == 0) { ?>
					<a href="<?php echo array_values($this->data['namespace_urls'])[0]['href'] ?>">Page
		<?php } else { ?>
					<a href="<?php echo $talkhref ?>">Talk
		<?php } ?>
					</a>
				</li>
		<?php } if ($this->data['view_urls'] || $this->data['action_urls']) { ?>
				<li class="dropdown" id="p-navigation">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Page <b class="caret"></b></a>
					<ul class="dropdown-menu">
				<?php foreach ( $this->data['view_urls'] as $link ) { ?>
					<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
			// $link['text'] can be undefined - bug 27764
			if ( array_key_exists( 'text', $link ) ) {
				echo array_key_exists( 'img', $link ) ? '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
			}
			?>		</a>
				</li>
				<?php } ?>
				<?php foreach ( $this->data['action_urls'] as $link ) { ?>
				<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
			// $link['text'] can be undefined - bug 27764
			if ( array_key_exists( 'text', $link ) ) {
				echo array_key_exists( 'img', $link ) ? '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
			}
			?>				</a>	
						</li>
				<?php } ?>
					</ul>
				</li> <?php } ?>
				<li style="margin-bottom:0px;"><a href="#">Manual</a></li>
				<li><a href="#">API</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
		<?php $personalTools = $this->getPersonalTools();
		      $userInfo = $personalTools['userpage'];
		      if ($userInfo) { ?>
				<li>
					<a href="<?php echo $userInfo['links'][0]['href']; ?>"><?php echo $userInfo['links'][0]['text'];?></a>
				</li>
		<?php }?>
				<li class="dropdown" id="p-navigation">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
				<?php $personalToolsNoName = array_slice($personalTools, 1);
				foreach ($personalToolsNoName as $key => $item) { 
					echo $this->makeListItem($key, $item);
				} ?>
					</ul>
				</li>
		
				<li>
					<div class="form-group search-bar-box">
					<div class="input-group">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Search</button>
					</span>			
					</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
<?php 
	#super hacky. We don't want to set max width when the page is the landing page (which is what the container class does). Also don't want to show the page title in the content if it is the landing page. All other pages though should have a max width and display the title.
	if ( strcmp($this->data['title'], "RobloxLandingPage") == 0 ) { ?>
	<div>
<?php } else { ?>
	<div class="container">
	<h1 id="firstHeading" class="firstHeading">
		<span dir="auto">
			<?php $this->html('title'); ?>
		</span>
	</h1> <?php } ?>
	
	<?php if ( $this->data['subtitle'] ) { ?>
	<div id="contentSub"<?php $this->html('userlanguageattrributes')?>><?php $this->html('subtitle')?></div><?php } ?>
	<?php if ($this->data['undelete'] ) { ?>
	<div id="contentSub2"><?php $this->html('undelete'); ?></div>
	<?php } ?>
	<?php $this->html( 'bodycontent' ); ?>
	<?php if ( $this->data['catlinks'] ) { $this->html('catlinks'); } ?>
	<?php if ( $this->data['dataAfterContent'] ) { $this->html('dataAfterContent'); } ?>
	</div>
</div>
<footer class="site-footer navbar navbar-default" style="margin-bottom:0;">
<div class="container" style="clear:both;display:table;height:100%">
<span style="display:table-cell;vertical-align:middle;">
	&#169; 2014 ROBLOX Cororation. All Rights Reserved.<ul style="float:right;">
<?php
	$footerLinks = $this->getFooterLinks();
	foreach($footerLinks['places'] as $key => $value) {
		?><li style="margin:20px;display:inline;"><?php $this->html($value);?></li><?php
	}
?>
			</ul></span>
</div>
</footer>
</body>
</html>
<?php $this->printTrail(); ?>
<?php
	wfRestoreWarnings();
	}
}
