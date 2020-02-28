<?php
function print_notice() {
  include './config/settings.php';
  if ($version_advice == true){
?>
<div class="container">
  <p class="spacer-1">.</p>
  <div class="alert alert-warning" role="alert">
<h4 class="alert-heading">Snapshot Relase</h4>
<p>Thank you for trying out <strong>HideMyPlugins Web Interface</strong>. This Web Interface is a Snapshot relase, bugs and other stuff may be present...</p>
<p>This version is not intended for public use during Snapshot Relase, if you intend to use this Web Interface publicly is at your own risk...</p>
<hr>
<p class="mb-0">If you find a bug or an error contact me at <a href="https://github.com/Gamerexde/hidemyplugins-web-interface">GitHub</a>!</p>
<p>You can disable this notice by setting <strong>/config/settings.php $version_advice = true</strong> to false...</p>
  </div>
</div>
<?php
 }
}
?>
