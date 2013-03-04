<div id="content" class="body-copy">
  <div id="mw-js-message" style="display:none;"<?php $this->html( 'userlangattributes' ) ?>></div>

  <?php if ( $this->data['sitenotice'] ): ?>
    <div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
  <?php endif; ?>

  <h1 id="firstHeading" class="firstHeading"><span dir="auto"><?php $this->html( 'title' ) ?></span></h1>
  <div id="bodyContent">
    <div id="contentSub"<?php $this->html( 'userlangattributes' ) ?>><?php $this->html( 'subtitle' ) ?></div>

    <?php if ( $this->data['undelete'] ): ?>
      <div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
    <?php endif; ?>

    <?php if( $this->data['newtalk'] ): ?>
      <div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
    <?php endif; ?>

    <?php $this->html( 'bodycontent' ) ?>

    <?php if ( $this->data['printfooter'] ): ?>
      <div class="printfooter">
        <?php $this->html( 'printfooter' ); ?>
      </div>
    <?php endif; ?>

    <?php if ( trim(strip_tags($this->data['catlinks'])) ): ?>
      <?php $this->html( 'catlinks' ); ?>
    <?php endif; ?>

    <?php if ( $this->data['dataAfterContent'] ): ?>
      <?php $this->html( 'dataAfterContent' ); ?>
    <?php endif; ?>

    <?php $this->html( 'debughtml' ); ?>
  </div>

  <ul class="page-info">
    <li><?php $this->html( 'lastmod' ) ?></li>
    <li><a href="<?php echo $this->data['nav_urls']['whatlinkshere']['href'] ?>">Länkar till denna sida</a></li>
  </ul>
</div>
