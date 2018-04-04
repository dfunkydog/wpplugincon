<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       nlsltd.com
 * @since      1.0.0
 *
 * @package    Mcpcon
 * @subpackage Mcpcon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form action='options.php' method='post'>

    <h2>My Cognition Pro Connector Options</h2>

    <?php
    settings_fields( 'mcpcon' );
    do_settings_sections( 'mcpcon' );
    submit_button();
    ?>

</form>