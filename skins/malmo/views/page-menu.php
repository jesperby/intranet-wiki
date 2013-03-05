<?php global $wgVectorUseSimpleSearch; ?>

<div id="mw-head" class="noprint clearfix">
  <div id="p-search">
    <h5<?php $this->html( 'userlangattributes' ) ?>><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h5>
    <form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
      <?php if ( $wgVectorUseSimpleSearch && $this->getSkin()->getUser()->getOption( 'vector-simplesearch' ) ): ?>
      <div id="simpleSearch" class="input-append">
        <input name="search" title="Sök på Kominwiki [f]" accesskey="f" id="searchInput" type="text" placeholder="Sök wikisida"/>
        <?php echo $this->makeSearchButton( 'image', array( 'class' => 'btn', 'id' => 'searchButton', 'src' => $this->getSkin()->getSkinStylePath( 'images/search-ltr.png' ) ) ); ?>
      <?php else: ?>
      <div>
        <?php echo $this->makeSearchInput( array( 'id' => 'searchInput', 'type' => 'text' ) ); ?>
        <?php echo $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) ); ?>
        <?php echo $this->makeSearchButton( 'fulltext', array( 'id' => 'mw-searchButton', 'class' => 'searchButton' ) ); ?>
      <?php endif; ?>
        <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
      </div>
    </form>
  </div>


  <div id="p-views" class="vectorTabs<?php if ( count( $this->data['view_urls'] ) == 0 ) { echo ' emptyPortlet'; } ?>">
    <ul<?php $this->html('userlangattributes') ?>>
    <li><a href="<?php echo $this->data['namespace_urls']['main']['href'] ?>"><?php echo $this->data['namespace_urls']['main']['text']?></a></li>
      <?php foreach ( $this->data['view_urls'] as $link ): ?>
        <?php if( $link['text'] == 'Visa' ) { continue; } ?>
        <li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
          if ( array_key_exists( 'text', $link ) ) {
            echo array_key_exists( 'img', $link ) ?  '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
          }
          ?></a></li>
      <?php endforeach; ?>

      <?php if (isset($this->data['content_navigation']['namespaces']['talk'])): ?>
        <li><a href="<?php echo htmlspecialchars( $this->data['content_navigation']['namespaces']['talk']['href'] ) ?>"><?php echo $this->data['content_navigation']['namespaces']['talk']['text'] ?></a></li>
      <?php endif; ?>
      <?php if (isset($this->data['content_navigation']['namespaces']['help_talk'])): ?>
        <li><a href="<?php echo htmlspecialchars( $this->data['content_navigation']['namespaces']['help_talk']['href'] ) ?>"><?php echo $this->data['content_navigation']['namespaces']['help_talk']['text'] ?></a></li>
      <?php endif; ?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Åtgärder<span class="icon-caret-down"></span></a>
        <menu aria-labelledby="actions-menu" class="dropdown-menu" role="menu">
          <?php foreach ( $this->data['action_urls'] as $link ): ?>
            <li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></li>
          <?php endforeach; ?>
        </menu>
      </li>
    </ul>
  </div>
</div>

