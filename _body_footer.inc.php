<?php
/**
 * This is the footer include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * This is meant to be included in a page template.
 *
 * @package evoskins
 * @subpackage integral
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );
?>
<!-- =================================== START OF FOOTER =================================== -->
  <div id="pageFooter"><!-- begins pageFooter -->
  <?php skin_container( NT_( 'Footer' ), array( 
				// The following params will be used as defaults for widgets included in this container:
    ) ) ;
  ?>

  <p class="baseline">
  <?php // Display footer text (text can be edited in Blog Settings):
    $Blog->footer_text( array(
      'before' => '',
      'after'  => '&bull; ',
    ) ) ;
  ?>

  <?php
    // Display a link to contact the owner of this blog (if owner accepts messages):
    $Blog->contact_link( array(
        'before'      => '',
        'after'       => ' &bull; ',
        'text'   => T_('Contact'),
        'title'  => T_('Send a message to the owner of this blog...'),
    ) );
  ?>
  <?php display_param_link( $skin_links ) ; echo ' '.T_( 'by' ); ?> <a href="http://www.315-web.com/" title="315Web Design">315web Design</a> adapted from the <a href="http://freecsstemplates.org/preview/firming">firming template</a> by <a href="http://freecsstemplates.org/">Free CSS Templates</a>  &bull;

		<?php
			// Display additional credits (see /conf/):
			// If you can add your own credits without removing the defaults, you'll be very cool :))
			// Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
			credits( array(
					'list_start'  => T_('Credits').': ',
					'list_end'    => ' ',
					'separator'   => '|',
					'item_start'  => ' ',
					'item_end'    => ' ',
				) );
		?>
    </p>
  </div>
</div>
<?php 
// vi: ts=2 sw=2 nu et fenc=utf-8
?>
