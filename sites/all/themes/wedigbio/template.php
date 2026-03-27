<?php

/**
 * @file
 * template.php
 */

// Remove Height and Width Inline Styles from Drupal Images
function wedigbio_preprocess_image(&$variables) {
  $attributes = &$variables['attributes'];
  foreach (array('width', 'height') as $key) {
    unset($attributes[$key]);
    unset($variables[$key]);
  }
}

function wedigbio_theme_image($variables) {
  foreach (array('width', 'height') as $key) {
    if (isset($variables[$key])) {
      unset($variables[$key]);
    }
  }
  return theme_image($variables);
}

function wedigbio_preprocess_field(&$variables) {
  if (empty($variables['element']['#field_name']) || empty($variables['items'])) {
    return;
  }

  $taxonomy_types = array(
    'field_keywords' => 'event keyword',
    'field_geographic_scope_of_specim' => 'geographic scope',
    'field_taxonomic_scope_of_specime' => 'taxonomic scope',
    'field_temporal_scope_of_specimen' => 'temporal scope',
  );

  $field_name = $variables['element']['#field_name'];

  if (!isset($taxonomy_types[$field_name])) {
    return;
  }

  $taxonomy_type = $taxonomy_types[$field_name];

  foreach ($variables['items'] as $delta => $item) {
    if (empty($item['#type']) || $item['#type'] !== 'link') {
      continue;
    }

    if (empty($item['#title'])) {
      continue;
    }

    $label = trim(strip_tags($item['#title']));
    if ($label === '') {
      continue;
    }

    $aria_label = $label . ', ' . $taxonomy_type;

    if (!isset($variables['items'][$delta]['#options'])) {
      $variables['items'][$delta]['#options'] = array();
    }
    if (!isset($variables['items'][$delta]['#options']['attributes'])) {
      $variables['items'][$delta]['#options']['attributes'] = array();
    }

    $variables['items'][$delta]['#options']['attributes']['aria-label'] = $aria_label;
    $variables['items'][$delta]['#options']['attributes']['title'] = $aria_label;
  }
}

function wedigbio_preprocess_page(&$variables) {
  $alias = drupal_get_path_alias(current_path());

  if ($alias === 'content/frequently-asked-questions') {
    drupal_add_js(
      drupal_get_path('theme', 'wedigbio') . '/js/faq-a11y-fix.js',
      array('scope' => 'footer')
    );
  }

  if ($alias === 'team-members') {
    drupal_add_js(
      drupal_get_path('theme', 'wedigbio') . '/js/team-carousel-a11y-fix.js',
      array('scope' => 'footer')
    );
  }
}

function wedigbio_form_user_login_alter(&$form, &$form_state, $form_id) {
  if (isset($form['name'])) {
    $form['name']['#attributes']['autocomplete'] = 'username';
  }
  if (isset($form['pass'])) {
    $form['pass']['#attributes']['autocomplete'] = 'current-password';
  }
}

function wedigbio_form_user_pass_alter(&$form, &$form_state, $form_id) {
  if (isset($form['name'])) {
    $form['name']['#attributes']['autocomplete'] = 'username';
  }
}