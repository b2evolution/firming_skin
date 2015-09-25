<?php
/**
 * This is the main/default page template for the "firming" skin.
 *
 * This skin only uses one single template which includes most of its features.
 * It will also rely on default includes for specific dispays (like the comment form).
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage firming
 *
 * Design by Free CSS Templates
 * http://www.freecsstemplates.org
 * Released for free under a Creative Commons Attribution 2.5 License
 * 
 * Name       : Firming
 * Description: A two-column, fixed-width design suitable for small websites and blogs.
 * Version    : 1.0
 * Released   : 20080129
 * EvoSkin ported by Larry Nieves, aka El Cardenalera, aka El Liberal Venezolano
 * http://www.315-web.com/ and http://cronicaslinuxeras.com/
 * EvoSkin Release: 20080226
 */

if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// -------------------------------- END OF HEADER --------------------------------
?>

<div id="wrapper">
	<div id="menu">
	<?php
		// ------------------------- "Page Top" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Page Top'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'         => '<div class="$wi_class$">',
				'block_end'           => '</div>',
				'block_display_title' => false,
				'list_start'          => '<ul>',
				'list_end'            => '</ul>',
				'item_start'          => '<li>',
				'item_end'            => '</li>',
			) );
		// ----------------------------- END OF "Page Top" CONTAINER -----------------------------
	?>
					<?php if ( true /* change to false to hide the blog list */ ) { ?>
				<?php
				  // START OF BLOG LIST
				  skin_widget( array(
						'widget' => 'colls_list_public',
						'block_start' => '',
						'block_end' => '',
						'block_display_title' => false,
						'list_start'          => '<ul>',
						'list_end'            => '</ul>',
						'item_start'          => '<li>',
						'item_end'            => '</li>',
						'item_selected_start' => '<li class="selected">',
						'item_selected_end' => '</li>',
					  ) );
				?>
				<?php } ?>
	</div>
	<div id="logo">
		<h1><?php blog_home_link( '', '', $Blog->get_name() ) ?></h1>
		<h2><?php $Blog->tagline( ) ?></h2>
	</div>
	<hr />
	<!-- =================================== START OF MAIN AREA =================================== -->
	<div id="page">
		<div class="bPosts">
		<?php
			// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
			messages( array(
				'block_start' => '<div class="action_messages">',
				'block_end'   => '</div>',
			) );
			// --------------------------------- END OF MESSAGES ---------------------------------
		?>

		<?php
			// ------------------- PREV/NEXT POST LINKS (SINGLE POST MODE) -------------------
			item_prevnext_links( array(
				'template'		=> '$next$$prev$',
				'block_start' => '<table class="prevnext_post"><tr>',
				'prev_start'  => '<td class="right">',
				'prev_end'    => '</td>',
				'next_start'  => '<td>',
				'next_end'    => '</td>',
				'block_end'   => '</tr></table>',
				'prev_text'		=> '$title$&raquo;',
				'next_text'		=> '&laquo;$title$',
			) );
			// ------------------------- END OF PREV/NEXT POST LINKS -------------------------
		?>

		<?php
			// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
			request_title( array(
				'title_before'=> '<h2>',
				'title_after' => '</h2>',
				'title_none'  => '',
				'glue'        => ' - ',
				'title_single_disp' => false,
				'format'      => 'htmlbody',
			) );
			// ----------------------------- END OF REQUEST TITLE ----------------------------
		?>

		<?php
			// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
			mainlist_page_links( array(
				'block_start' => '<p class="center">'.T_('Pages:').' <strong>',
				'block_end' => '</strong></p>',
			) );
			// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
		?>
		<?php
			// --------------------------------- START OF POSTS -------------------------------------
			// Display message if no post:
			display_if_empty();

			while( $Item = & mainlist_get_item() )
			{	// For each blog post, do everything below up to the closing curly brace "}"
		?>

			<?php
				// ------------------------------ DATE SEPARATOR ------------------------------
				$MainList->date_if_changed( array(
					'before'      => '<h2>',
					'after'       => '</h2>',
					'date_format' => '#',
				) );
			?>

		<div id="<?php $Item->anchor_id() ?>" class="bPost bPost<?php $Item->status_raw() ?>" lang="<?php $Item->lang() ?>">

			<?php
				$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
			?>

			<h2 class="bTitle"><?php $Item->title(); ?></h2>
			<div class="bSmallHead">
			<?php
				$Item->wordcount();
				echo ' '.T_('words');
				// echo ', ';
				// $Item->views();

				$Item->locale_flag( array(
						'before'    => ' &nbsp; ',
						'after'     => '',
					) );
			?>

			<?php
				$Item->categories( array(
					'before'          => T_('Categories').': ',
					'after'           => ' ',
					'include_main'    => true,
					'include_other'   => true,
					'include_external'=> true,
					'link_categories' => true,
				) );
			?>
			</div>


			<?php
				// ---------------------- POST CONTENT INCLUDED HERE ----------------------
				skin_include( '_item_content.inc.php', array(
						'image_size'	=>	'fit-400x320',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// -------------------------- END OF POST CONTENT -------------------------
			?>

			<?php
				// List all tags attached to this post:
				$Item->tags( array(
						'before' =>         '<div class="bSmallPrint">'.T_('Tags').': ',
						'after' =>          '</div>',
						'separator' =>      ', ',
					) );
			?>

			<div class="bSmallPrint">
				<?php
				$Item->author( array(
						'before'    => ''.T_('by').' ',
						'after'     => '',
					) );
				$Item->msgform_link();
        ?> <span title="<?php echo T_( 'Modified' )?>: <?php
          $Item->mod_date()?> <?php $Item->mod_time()?>"><?php $Item->issue_time( array(
						'before'    => ', ' . T_( 'at ' ) . ' ',
						'after'     => '',
					));
			?></span>
				<?php
					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'comments',
									'link_before' => '',
									'link_after' => '',
									'link_text_zero' => T_( 'Comments' ),
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'trackbacks',
									'link_before' => ' &bull; ',
									'link_after' => '',
									'link_text_zero' => T_( 'Trackbacks' ),
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

					$Item->edit_link( array( // Link to backoffice for editing
							'before'    => ' &bull; ',
							'after'     => '',
							'text'			=> get_icon( 'edit' ),
						) );
				?>
			</div>

			<?php
				// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
				skin_include( '_item_feedback.inc.php', array(
						'before_section_title' => '<h4>',
						'after_section_title'  => '</h4>',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
			?>

			<?php
				locale_restore_previous();	// Restore previous locale (Blog locale)
			?>
		</div>
		<?php
		} // ---------------------------------- END OF POSTS ------------------------------------
	?>

	<?php
		// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
		mainlist_page_links( array(
				'block_start' => '<p class="center"><strong>',
				'block_end' => '</strong></p>',
   			'prev_text' => '&lt;&lt;',
   			'next_text' => '&gt;&gt;',
			) );
		// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
	?>


	<?php
		// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
		skin_include( '$disp$', array(
				'disp_posts'  => '',		// We already handled this case above
				'disp_single' => '',		// We already handled this case above
				'disp_page'   => '',		// We already handled this case above
			) );
		// Note: you can customize any of the sub templates included here by
		// copying the matching php file into your skin directory.
		// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
	?>

		</div>
		<!-- end #content -->
		<!-- =================================== START OF SIDEBAR =================================== -->
		<div id="sidebar" class="bSideBar">
		<?php
			// ------------------------- "Sidebar" CONTAINER EMBEDDED HERE --------------------------
			// Display container contents:
			skin_container( NT_('Sidebar'), array(
				// The following (optional) params will be used as defaults for widgets included in this container:
				// This will enclose each widget in a block:
				'block_start' => '<ul class="bSideItem $wi_class$"><li>',
				'block_end' => '</li></ul>',
				// This will enclose the title of each widget:
				'block_title_start' => '<h3>',
				'block_title_end' => '</h3>',
				// If a widget displays a list, this will enclose that list:
				'list_start' => '<ul>',
				'list_end' => '</ul>',
				// This will enclose each item in a list:
				'item_start' => '<li>',
				'item_end' => '</li>',
				// This will enclose sub-lists in a list:
				'group_start' => '<ul>',
				'group_end' => '</ul>',
				// This will enclose (foot)notes:
				'notes_start' => '<div class="notes">',
				'notes_end' => '</div>',
			) );
			// ----------------------------- END OF "Sidebar" CONTAINER -----------------------------
		?>
    <p class="center"><!-- Please help us promote b2evolution and leave this link on your blog. --><a href="http://b2evolution.net/" title="b2evolution: next generation blog software"><img src="../../rsc/img/powered-by-b2evolution-120t.gif" alt="powered by b2evolution free blog software" title="b2evolution: next generation blog software" width="120" height="32" border="0" /></a><br />
    <a href="http://validator.w3.org/check?uri=referer"><img src="images/valid-xhtml10.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a><br />
    <a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="width:88px;height:31px" src="images/vcss.png" alt="Valid CSS!" />
 </a></p>

		</div>
		<!-- end #sidebar -->
	</div>
	<!-- end #page -->
<?php
// ------------------------- BODY FOOTER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>
<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
// vi: ts=2 sw=2 nu et
?>
