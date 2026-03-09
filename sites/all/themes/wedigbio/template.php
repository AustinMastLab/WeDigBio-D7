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
  // clear width and height if set.
  foreach (array('width', 'height') as $key) {
    if (isset($variables[$key])) {
      unset($variables[$key]);
    }
  }
  // Now we can call core theme_image() function directly.
  return theme_image($variables);
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