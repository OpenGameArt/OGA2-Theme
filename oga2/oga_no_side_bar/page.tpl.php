<?php /*
$page['topright'] = Top (right of title)
$page['menubar'] = Menu Bar
$page['left'] = Left sidebar
$page['content'] = Content
$page['header'] = Header
$page['footer'] = Footer
*/ 
global $base_url;
?>

<noscript><style>
node_art_form_group_author_information {
  display: block !important;
}
</style></noscript>

<div id='page'>
  <div id='topright'><?php print render($page['topright']);?></div>
  <a href='<?php print $base_path;?>' id='maintitle'></a>

  <div id='menubar'>
    <?php print render($page['menubar']);?>
    <div id='menubar-right'>
      <?php print render($page['menubar-right']);?>
    </div>
  </div>

  <div id='maincontent'>
    <div id='right' class='nosidebar'>
      <?php if($messages): ?>
      <div class='messages'><?php print $messages;?></div>
      <?php endif; ?>
      
      <?php if($tabs): ?>
      <div class='tabs'><?php print render($tabs); ?></div>
      <?php endif; ?>
      
      <?php if($action_links): ?>
      <div class='action_links'><?php print render($action_links); ?></div>    
      <?php endif; ?>
      <?php /*
      <div class='pagetitle'><h2><?php 
        print render($title_prefix);
        print $title;
        print render($title_suffix);
      ?></h2></div>
      */ ?>
      <?php print render($page['content']);?>
    </div>
  </div>
</div>
