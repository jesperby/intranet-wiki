<?php
/**
 * QuickTemplate class for Malmo Vector skin
 * @ingroup Skins
 */
class MalmoTemplate extends BaseTemplate {
  /**
   * Outputs the entire contents of the (X)HTML page
   */
  public function execute() {
    global $wgVectorUseIconWatch, $wgLocalStylePath;

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

    <?php include("views/page-menu.php"); ?>
    <?php include("views/content.php"); ?>
    <?php $this->printTrail(); ?>
    <?php include("views/footer.php"); ?>
    <script src="<?php echo ASSET_HOST ?>/malmo-no-jquery.js"></script>
    <script src="<?php echo $wgLocalStylePath . '/malmo/javascripts' ?>/application.js"></script>
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
