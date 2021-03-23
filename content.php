<?php
/**
 * The default template for displaying content
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail(); ?></a>
		</div><!-- end .entry-thumbnail -->
	<?php endif; ?>
				<?php if ( is_archive() || is_search() ) : // Display custom taxonomies for archives and search results. ?>
	<div class="entry-details">		
		<div class="entry-cats">
				<?php the_terms( $post->ID, 'nummer', '', ', '); ?>
		</div><!-- end .entry-cats -->
	</div><!-- end .entry-details -->
				<?php endif; ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?> 
			<div class="entry-details">

				<div class="entry-author">
				<?php
					$authorInfo = get_the_term_list( $post->ID, 'forfattare', '<br/><span class="description">Av</span> ', ', ', '<br/>' );
					echo $authorInfo;
				?>
				</div><!-- end .entry-author -->
				<?php 
					$terms = get_the_term_list($post->ID, 'artiklar', ' ', ' | ', ' ');
					echo $terms;
				?>
		</div><!-- end .entry-details -->
	</header><!-- end .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- end .entry-summary -->
	

		<footer class="entry-meta cf">
			<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'zuki' ), '<div class="entry-edit">', '</div>' ); ?>
		</footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->