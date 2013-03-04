<footer class="bigfoot">
  <nav>
    <ul class="list-1">
      <li><a href="<?php echo $this->data['nav_urls']['mainpage']['href'] ?>">Huvudsida</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['upload']['href'] ?>">Ladda upp fil</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['specialpages']['href'] ?>">Specialsidor</a></li>
      <li><a href="<?php echo $this->data['nav_urls']['recentchangeslinked']['href'] ?>">Senaste ändringar</a></li>
    </ul>

    <ul class="list-2">
      <?php foreach( $this->getPersonalTools() as $key => $item ) { ?>
        <?php echo $this->makeListItem( $key, $item ); ?>
      <?php } ?>
    </ul>

    <ul class="list-3">
      <li><a href="<?php echo $this->navigationHref('n-help'); ?>">Hjälp</a></li>
    </ul>

  </nav>
</footer>

