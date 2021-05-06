<?php
    $document = JFactory::getDocument();
?>
    <header class="u-clearfix u-header u-sticky u-white u-header" id="sec-bae1">
  <div class="u-clearfix u-sheet u-sheet-1">
    <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/Imagen_1-removebg-preview2.png",
            'href' => "https://nicepage.com",
            'default_width' => '152'
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-image u-logo u-image-1" data-image-width="530" data-image-height="227">
      <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1" data-image-width="152.0424">
    </a>
    <?php echo CoreStatements::position('hmenu', '', 1, 'hmenu'); ?>
  </div>
</header>
    