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
		$out->addModuleStyles( "skins.xblock" );
	}

}

class XblockTemplate extends BaseTemplate {
	public function execute() {
		$this->html('headelement');?>
<div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
<div id="content" class="mw-body aclass" role="main" style="margin-left:0px;">
	<a id="top"></a>

	<div id="bodyContent">
		<!--<?php if ( $this->data['isarticle'] ) { ?>
		<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>
		<?php } ?>
		<div id="contentSub"<?php $this->html( 'userlangattributes' ) ?>><?php $this->html( 'subtitle' ) ?></div>
		<?php if ( $this->data['undelete'] ) { ?>
		<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
		<?php } ?>
		<?php if ( $this->data['newtalk'] ) { ?>
		<div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
		<?php } ?>
		<div id="jump-to-nav" class="mw-jump">
			<?php $this->msg( 'jumpto' ) ?>
			<a href="#mw-navigation"><?php $this->msg( 'jumptonavigation' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
			<a href="#p-search"><?php $this->msg( 'jumptosearch' ) ?></a>
		</div>-->
		<?php $this->html( 'bodycontent' ) ?>
		<!--<?php if ( $this->data['printfooter'] ) { ?>
		<div class="printfooter">
		<?php $this->html( 'printfooter' ); ?>
		</div>
		<?php } ?>
		<?php if ( $this->data['catlinks'] ) { ?>
		<?php $this->html( 'catlinks' ); ?>
		<?php } ?>
		<?php if ( $this->data['dataAfterContent'] ) { ?>
		<?php $this->html( 'dataAfterContent' ); ?>
		<?php } ?>
		<div class="visualClear"></div>
		<?php $this->html( 'debughtml' ); ?>-->
	</div>
</div>
<div id="mw-navigation">
	<h2><?php $this->msg('navigation-heading') ?></h2>
	<div id="mw-head">
		<button type="button">Home</button>
		<button type="button">Page/Talk</button>
		<button type="button">Manage</button>
		<button type="button">Watch</button>
		<button type="button">Advanced</button>
		<button type="button">Wiki Tools</button>
		<button type="button">Settings</button>
		<div id="p-search" role="search">
			<h3<?php $this->html('userlangattributes') ?><label for="searchInput"><?php $this->msg('search')?></label></h3>
			<form action="<?php $this->text('wgScript')?>" id="searchform">
				<div id="simpleSearch">
					<?php echo $this->makeSearchInput(array('id'=>'searchInput', 'type'=>'text')); ?>
					<?php echo $this->makeSearchButton('image', array('id'=>'searchButton', 'src'=>$this->getSkin()->getSkinStylePath('images/search-ltr.png'), 'width'=>'12', 'height' => '13' )); ?>
				</div>

			</form>
		</div>

	</div>
	
</div>

<?php
	}
}
