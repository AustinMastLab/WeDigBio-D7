<?php

/**
 * @file
 * Template to display Bootstrap Carousels.
 */
if (!empty($title)): ?>
  <h3><?php print $title ?></h3>
<?php endif ?>

<div id="views-bootstrap-carousel-<?php print $id ?>" class="<?php print $classes ?>" <?php print $attributes ?>>
  <?php if ($indicators): ?>
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
      <?php foreach ($rows as $key => $value): ?>
        <li data-target="#views-bootstrap-carousel-<?php print $id ?>" data-slide-to="<?php print $key ?>" class="<?php if ($key == $first_key) {print 'active';
        } ?>"></li>
      <?php endforeach ?>
    </ol>
  <?php endif ?>

  <!-- Carousel items -->
  <?php $carousel_label_id = 'views-bootstrap-carousel-label-' . $id; ?>
  <h2 id="<?php print $carousel_label_id; ?>" class="sr-only">
    <?php print !empty($title) ? check_plain($title) : 'Carousel'; ?>
  </h2>
  <div class="carousel-inner" role="region" aria-labelledby="<?php print $carousel_label_id; ?>">
    <?php foreach ($rows as $key => $row): ?>
      <div class="item <?php if ($key == $first_key) {print 'active';
      } ?>">
        <?php print $row ?>
      </div>
    <?php endforeach ?>
  </div>

  <?php if ($navigation): ?>
    <!-- Carousel navigation -->
    <button
      class="carousel-control left"
      type="button"
      data-target="#views-bootstrap-carousel-<?php print $id ?>"
      data-slide="prev"
      aria-controls="views-bootstrap-carousel-<?php print $id ?>">
      <span class="icon-prev" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button
      class="carousel-control right"
      type="button"
      data-target="#views-bootstrap-carousel-<?php print $id ?>"
      data-slide="next"
      aria-controls="views-bootstrap-carousel-<?php print $id ?>">
      <span class="icon-next" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  <?php endif ?>
</div>