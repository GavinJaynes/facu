<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap"><div id="icon-tools" class="icon32"></div>
	<h2>Frequently Asked Questions Plugin Settings</h2>

	<form class="faq-form" role="form" action="" id="facu" method="POST">
		<?php wp_nonce_field('facu_nonce', 'facu_nonce_field'); ?>

		<div class="faq-option">
			<label for="facu_page_title">Page title</label>
			<input name="facu_page_title" id="facu_page_title" type="text" value="<?php echo get_option( 'facu_plugin_page_title' ); ?>">
		</div>

		<div class="faq-option">
			<label for="facu_page_slug">The default slug for this page is "faq". If you would like to change it you can here.<br>
			<small>Note: You will need to update <a href="<?php echo get_admin_url(); ?>options-permalink.php">permalinks</a> for this to take effect</small></label>
			<input name="facu_page_slug" id="facu_page_slug" type="text" value="<?php echo get_option( 'facu_plugin_page_slug' ); ?>">
		</div>

		<div class="faq-option">
			<label for="facu_page_content">Introduction copy for page that houses the questions and answers</label>
			<textarea name="facu_page_content" id="facu_page_content" placeholder="insert text here">
			<?php echo get_option( 'facu_plugin_page_content' ); ?>
			</textarea>
		</div>

		<div class="faq-option">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
		</div>

	</form>
</div>