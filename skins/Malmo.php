<?php
// Malmo skin for intranet wiki. Based on the Wikipedia Vector skin.

if (!defined('MEDIAWIKI')) die( -1 );

 // SkinTemplate class for Malmo skin
class SkinMalmo extends SkinTemplate {

	protected static $bodyClasses = array( 'vector-animateLayout' );

	var $skinname = 'malmo', $stylename = 'malmo',
		$template = 'MalmoTemplate', $useHeadElement = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;

		parent::initPage( $out );

		$min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';

    $out->addHeadItem("assets-3.0",
      '<!--[if lte IE 8]><script src="' . ASSET_HOST . '/html5shiv-printshiv.js"></script><![endif]-->
       <link href="' . ASSET_HOST . '/malmo.css" rel="stylesheet" type="text/css"/>
       <!--[if lte IE 9]><link href="' . ASSET_HOST . '/legacy/ie9.css" rel="stylesheet" type="text/css"/><![endif]-->
       <!--[if lte IE 7]><link href="' . ASSET_HOST . '/legacy/ie7.css" rel="stylesheet" type="text/css"/><![endif]-->
       <link href="' . $wgLocalStylePath . '/malmo/stylesheets/screen.css" rel="stylesheet" type="text/css"/>
       <link href="' . $wgLocalStylePath . '/malmo/stylesheets/malmo.css" rel="stylesheet" type="text/css"/>'
    );
    $out->addStyle('malmo/stylesheets/commonElements.css', 'screen');
    $out->addStyle('malmo/stylesheets/commonContent.css', 'screen');
    $out->addStyle('malmo/stylesheets/commonInterface.css', 'screen');

		$out->addModuleScripts( 'skins.malmo' );
	}

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
    $out->addModuleStyles( 'skins.malmo' );
	}

	/**
	 * Adds classes to the body element.
	 *
	 * @param $out OutputPage object
	 * @param &$bodyAttrs Array of attributes that will be set on the body element
	 */
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		if ( isset( $bodyAttrs['class'] ) && strlen( $bodyAttrs['class'] ) > 0 ) {
			$bodyAttrs['class'] .= ' ' . implode( ' ', static::$bodyClasses );
		} else {
			$bodyAttrs['class'] = implode( ' ', static::$bodyClasses );
		}
    $bodyAttrs['class'] .= ' ' . ENV;
	}
}

/**
 * QuickTemplate class for Malmo Vector skin
 * @ingroup Skins
 */
class MalmoTemplate extends BaseTemplate {

	/* Functions */

	/**
	 * Outputs the entire contents of the (X)HTML page
	 */
	public function execute() {
		global $wgVectorUseIconWatch;

		// Build additional attributes for navigation urls
		$nav = $this->data['content_navigation'];

		if ( $wgVectorUseIconWatch ) {
			$mode = $this->getSkin()->getUser()->isWatched( $this->getSkin()->getRelevantTitle() ) ? 'unwatch' : 'watch';
			if ( isset( $nav['actions'][$mode] ) ) {
				$nav['views'][$mode] = $nav['actions'][$mode];
				$nav['views'][$mode]['class'] = rtrim( 'icon ' . $nav['views'][$mode]['class'], ' ' );
				$nav['views'][$mode]['primary'] = true;
				unset( $nav['actions'][$mode] );
			}
		}

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

		$this->html( 'headelement' );
?>
    <div class="service-title"><a href="<?php echo $this->data['nav_urls']['mainpage']['href'] ?>">Wiki</a></div>

    <?php include("malmo/views/page-menu.php"); ?>
    <?php include("malmo/views/content.php"); ?>
		<?php $this->printTrail(); ?>
    <?php include("malmo/views/footer.php"); ?>


    <script src="<?php echo ASSET_HOST ?>/malmo.js"></script>
	</body>
</html>
<?php
	}
  // Get a sidebar navigation link by id
  function navigationHref($id) {
    foreach ($this->data['sidebar']['navigation'] as $item) {
      if ($item['id'] == $id) {
        return $item['href'];
      }
    }
    return false;
  }
}
