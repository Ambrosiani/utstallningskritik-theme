<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-cats">
			<?php $terms = get_the_term_list($post->ID, 'nummer', ' ', ' | ', ' ');
					echo $terms; ?>
		</div><!-- end .entry-cats -->

		<?php if ( comments_open() ) : ?>
			<div class="entry-comments">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
			</div><!-- end .entry-comments -->
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'zuki' ), '<div class="entry-edit">', '</div>' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-author">
        <?php
        echo get_the_term_list( $post->ID, 'artiklar', '', ', ', '<br/>' );
        echo get_the_term_list( $post->ID, 'forfattare', '<span class="description">Av </span> ', ', ', '' );
        ?>
			<br/>
			<?php /* the_terms( $post->ID, 'forfattare', 'Av: ', ', ', '<br/>' ); */ ?>
		</div><!-- end .entry-author -->
	</header><!-- end .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'zuki' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- end .entry-content -->

	<footer class="entry-meta">
		<p>
		<?php echo 'Permanent länk till denna artikel: <a class="code" href="https://utstallningskritik.se/?p=';
		echo the_id();
		echo '">https://utstallningskritik.se/?p=';
		echo the_id();
		echo '</a>';

		$ursprunglig_adress = get_field( "ursprunglig_adress" );

		if( $ursprunglig_adress ) {
			echo '<br/>Ursprunglig adress till denna artikel: <a class="code" href="';
    		echo $ursprunglig_adress;
    		echo '">';
    		echo $ursprunglig_adress;
    		echo '</a>';
		} else {
		}	
		echo '</p>';
		?>
		
		<?php if ( get_the_author_meta( 'description' ) ): ?>
			<div class="authorbox cf">
				<div class="author-info">
					<h3 class="author-name"><span><?php _e('by ', 'zuki') ?></span><?php printf( "<a href='" .  esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) . "' rel='author'>" . get_the_author() . "</a>" ); ?></h3>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'zuki_author_bio_avatar_size', 120 ) ); ?>
					<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
				</div><!-- end .author-info -->
			</div><!-- end .author-wrap -->
		<?php endif; ?>
	</footer><!-- end .entry-meta -->
</article><!-- end .post-<?php the_ID(); ?> -->