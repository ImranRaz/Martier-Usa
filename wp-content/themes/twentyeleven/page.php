<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="container">
				<h1 class="entry-title"><?php the_title(); ?></h1>	
				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php /*?><?php comments_template( '', true ); ?><?php */?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>