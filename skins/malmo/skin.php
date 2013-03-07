<?php
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
       <link href="' . $wgLocalStylePath . '/malmo/stylesheets/application.css" rel="stylesheet" type="text/css"/>'
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
    $bodyAttrs['class'] .= ' malmo-form ' . ENV;
  }
}
