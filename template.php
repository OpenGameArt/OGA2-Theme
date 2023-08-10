<?php

function oga_theme_preprocess_html(&$vars) {
  // Setup IE meta tag to force IE rendering mode
  $meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' =>  'IE=edge,chrome=1',
      'http-equiv' => 'X-UA-Compatible',
    )
  );
 
  // Add header meta tag for IE to head
  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
}

function oga_theme_feed_icon($variables) {
  $text = t('Subscribe to @feed-title', array('@feed-title' => $variables['title']));
  if ($image = theme('image', array('path' => 'sites/all/themes/oga/rss-icon-nobg.png', 'width' => 16, 'height' => 16, 'alt' => $text))) {
    return l($image, $variables['url'], array('html' => TRUE, 'attributes' => array('class' => array('feed-icon'), 'title' => $text)));
  }
} 

/**
 * customizing counter display of public download count module
 *
 * @param $variables['type']  - either 'node' (including Views field) or 'block'
 *        $variables['value'] - total counter value
 *        $variables['path']  - path to the statistics page (if permission allows)
 */
function oga_theme_pubdlcnt_counter($variables) {
  
  $type = $variables['type'];
  $value = $variables['value'];
  $path = drupal_encode_path($variables['path']);

  /**
   * This theme function customze the counter display 
   *
   * node     filename (X downloads)
   *
   * block    * filename-1/node-title-1
   *             Total X downloads
   *          * filename-2/node-title-2
   *             Total Y downloads
   */
  if($type == 'node') {
    if($path) {
      $output = ' <a href="' . $path . '" class="dlcount">(' . $value . ' downloads)</a>';
    }
    else {
      $output = ' <span class="dlcount">(' . $value . ' downloads)</span>';
    }
  }
  else if($type == 'block') {
    $output = '<br>';
    if($path) {
      $output .= ' <a href="' . $path . '" class="dlcount">Total ' . $value . ' downloads</a>';
    }
    else {
      $output .= ' <span class="dlcount">Total ' . $value . ' downloads</span>';
    }
  }
  return $output;
}

function oga_theme_file_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);
  $icon = theme('file_icon', array('file' => $file, 'icon_directory' => $icon_directory, 'alt' =>  check_plain($file->filename)));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
      'download' => 1,
    ),
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  }
  else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }
  
  $size = $file->filesize;
  if($size > 1000000) {
    $size = sprintf("%.1f", $size / 1000000) . "M";
  } elseif($size > 1000) {
    $size = sprintf("%.1f", $size / 1000) . "K";
  } else {
    $size += "B";
  }

  return '<span class="file">' . $icon . ' ' . l($link_text, $url, $options) . ' ' . $size . '</span>';
}

function oga_theme_preprocess_search_result(&$variables) {
  global $user;
  if($user->uid == 1) {
    //dsm($variables);
  }
  $path = drupal_get_path_alias("node/{$variables['result']['node']->entity_id}");
  $output = "<img src='" . file_create_url(image_style_path('thumbnail', $variables['result']['preview']->uri)) . "'  alt='Preview'>";
  $output = l($output, $path, array('html' => true));
  $variables['info'] = $output;
}