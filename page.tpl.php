<?php 
if(drupal_is_front_page()) {
  unset($page['content']['system_main']['default_message']);
}
global $base_url;

$pageclass = '';
if(preg_match('/^(forum|latest$)/', current_path())) {
  $pageclass = " class='wide'";
}
?>

<noscript><style>
node_art_form_group_author_information {
  display: block !important;
}
</style></noscript>

<div id='page'<?php print $pageclass;?>>
  <div id='topright'><?php print render($page['topright']);?></div>
  <a href='<?php print $base_path;?>' id='maintitle'></a>

  <div id='menubar'>
    <?php print render($page['menubar']);?>
    <div id='menubar-right'>
      <?php print render($page['menubar-right']);?>
    </div>
 </div>

  <div id='maincontent'>
    <div id='left'>
      <?php print render($page['left']);?>
        <?php if($page['farright']): ?>
        <div id='farright'>
          <?php print render($page['farright']);?>
        </div>
        <?php endif; ?>
      </div>
    <div id='right'>
      <?php if($messages): ?>
      <div class='messages'><?php print $messages;?></div>
      <?php endif; ?>
      
      <?php if($tabs): ?>
      <div class='tabs'><?php print render($tabs); ?></div>
      <?php endif; ?>
      
      <?php if($action_links): ?>
      <div class='action_links'><?php print render($action_links); ?></div>    
      <?php endif; ?>
      <?php if($title != '' && !drupal_is_front_page()): ?>
      <div class='pagetitle'><h2><?php 
        print render($title_prefix);
        print $title;
        print render($title_suffix);
      ?></h2></div>
      <?php endif; ?>
      <?php print render($page['content']);?>
    </div>
	
  </div>
</div>
