<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Zuki
 * @since Zuki 1.0
 */

get_header(); ?>

<div id="primary" class="site-content archive cf" role="main">
	<?php   
		global $wp_query;	
		$number_of_posts = $wp_query->found_posts; 
	?>
	<?php if ( have_posts() ) : ?>

		<header class="archive-header">
			<h1 class="archive-title">
					<?php
						if ( is_category() ) :
							printf( single_cat_title( '', false ) );

						elseif ( is_tag() ) :
							printf( __( 'All posts tagged: %s', 'zuki' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'zuki' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'zuki' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'zuki' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'zuki' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'zuki' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'zuki' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'zuki');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'zuki');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'zuki' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'zuki' );

						elseif ( is_tax( 'amnen') || is_tax( 'museer' ) || is_tax( 'platser' ) || is_tax( 'lander' ) || is_tax( 'utstallningar' ) ) :
							printf( 'Allt om %s', single_term_title('', false) );

						elseif ( is_tax( 'artiklar' ) ) :
							$term = get_queried_object();
							printf( 'Alla %s', get_field('plural', $term) );

						elseif ( is_tax( 'forfattare' ) ) : 
							printf( '<span>Alla artiklar av</span>' . ' %s ', single_term_title('', false) );

						elseif ( is_tax( 'nummer' ) ) : 
							printf( '<span>Alla artiklar i</span>' . ' %s ', single_term_title('', false) );

						else :
							printf( 'Arkivet' );

						endif;
					?>
			</h1>
			<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
				//printf('<button class="facetwp-flyout-open">Filter</button>'); 
				printf('<div class="taxonomy-count"><span>' . '%s artiklar', $number_of_posts, '</span>
				</div>');
			?>
			
		</header><!-- end .archive-header -->
		<p class="mobile"><button class="facetwp-flyout-open">Filtrera artiklar</button></p>
		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php else : ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'zuki' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'zuki' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php endif; ?>
		<?php
		// Previous/next post navigation.
		// zuki_content_nav( 'nav-below' );

		if(shortcode_exists('facetwp')){
			echo do_shortcode('[facetwp facet="pager_archive"]');
		}
		?>

</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>