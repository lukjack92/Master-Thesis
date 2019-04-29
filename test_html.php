<?php
function _e($string) {
  echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  //echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Escape Output</title>
  </head>
  <body>
    <?php _e('ążłę'); echo "ęąśł"?>
  </body>
</html>