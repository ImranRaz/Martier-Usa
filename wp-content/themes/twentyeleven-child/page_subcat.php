<?php
/**
 * Template Name: Sub Category Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
		<div class="span-5 left prepend-top">
					<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>	
					<?php
		  if($post->post_parent)
		  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
		  else
		  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
		  if ($children) { ?>
		  <ul class="sub_cat">
		  <?php echo $children; ?>
		  </ul>
	<?php } ?>
    
    </div>
		<div id="primary">
			<div id="content" role="main" class="span-18 last prepend-1">


		<?php the_post(); ?>
        
        
		
		<?php get_template_part( 'content', 'page' ); ?>

				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
