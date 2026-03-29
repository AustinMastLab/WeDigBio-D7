<?php

/**
 * @file
 * Template for event calendar nodes.
 */

$event_title = html_entity_decode(strip_tags($title), ENT_QUOTES, 'UTF-8');
$event_label = $event_title;
if (!empty($node->nid)) {
  $event_label .= ', event ' . $node->nid;
}
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <header>
    <?php if (!$page): ?>
      <h2<?php print drupal_attributes($title_attributes_array); ?>>
        <a href="<?php print $node_url; ?>" aria-label="<?php print check_plain($event_label); ?>" title="<?php print check_plain($event_label); ?>">
          <?php print $event_title; ?>
        </a>
      </h2>
    <?php else: ?>
      <h1<?php print drupal_attributes($title_attributes_array); ?>>
        <?php print $event_title; ?>
      </h1>
    <?php endif; ?>

    <?php if ($display_submitted): ?>
      <p class="submitted">
        <?php print $submitted; ?>
      </p>
    <?php endif; ?>
  </header>

  <div class="content"<?php print drupal_attributes($content_attributes_array); ?>>
    <?php
    if (!empty($content['field_event_image'])) {
      $field_event_image = render($content['field_event_image']);

      if (strpos($field_event_image, '<a ') !== FALSE) {
        $field_event_image = preg_replace(
          '/<a\b([^>]*)>/i',
          '<a$1 aria-label="' . check_plain($event_label) . '" title="' . check_plain($event_label) . '">',
          $field_event_image,
          1
        );
      }

      print $field_event_image;
      unset($content['field_event_image']);
    }

    hide($content['links']);
    hide($content['comments']);
    print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>
</article>