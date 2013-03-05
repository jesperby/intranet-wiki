<footer class="bigfoot">
  <nav>
    <ul class="list-1">
      <li><a href="<?php echo $this->data['nav_urls']['mainpage']['href'] ?>">Huvudsida</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['upload']['href'] ?>">Ladda upp fil</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['specialpages']['href'] ?>">Specialsidor</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['recentchangeslinked']['href'] ?>">Senaste ändringar</a></li>
    </ul>

    <ul class="list-2">
      <?php
        $tools = $this->getPersonalTools();
        // Is user logged in?
        if (array_key_exists( "userpage", $tools )) {
          foreach( $tools as $key => $item ) {
            echo $this->makeListItem( $key, $item );
          }
        } else { ?>
        <li>
          <a href="<?php echo $tools['anonlogin']['links'][0]['href'] ?>"><?php echo $tools['anonlogin']['links'][0]['text'] ?></a>
        </li>
      <?php } ?>
    </ul>

    <ul class="list-3">
      <li><a href="<?php echo $this->navigationHref('n-help'); ?>">Hjälp</a></li>
    </ul>
  </nav>
</footer>

