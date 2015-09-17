<?php
/**
 * Config form
 *
 * @package KudlIdentityClient
 * @author Michael Slone
 * @copyright Copyright (C) 2015 Michael Slone <m.slone@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

$view = get_view()
?>

<div class="field">
  <div class="two columns alpha">
    <label for="kudl_identity_library_path">Path to KUDL Identity library</label>
  </div>
  <div class="inputs five columns omega">
    <p class="explanation">The absolute path to the KUDL Identity library on the server.</p>
    <?php echo $view->formText('kudl_identity_library_path', get_option('kudl_identity_library_path')); ?>
  </div>
</div>
