<?php
/**
 * The template for displaying search results.
 *
 * @package Zuki
 * @since Zuki 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content archive cf" role="main">

	<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php echo '<span>' . absint($wp_query->found_posts); ?> <?php printf( __( 'Sökresultat för: %s', 'zuki' ), '</span>' . get_search_query() ); ?></h1>
			</header><!--end .page-header -->
			<p class="mobile"><button class="facetwp-flyout-open">Filtrera artiklar</button></p>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php	get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php else : ?>

			<article id="post-0" class="page no-results not-found">

			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'zuki' ); ?></h1>
			</header><!-- end .entry-header -->

					<div class="entry-content cf">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zuki' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- end .entry-content -->

			</article>

	<?php endif; ?>

<?php
		// Previous/next post navigation.
		zuki_content_nav( 'nav-below' ); ?>

	</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>