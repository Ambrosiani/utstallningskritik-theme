<?php
/**
 * The template for displaying the footer.
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<?php get_sidebar( 'footer' ); ?>

<footer id="colophon" class="site-footer cf">
	<?php if ( '' != get_bloginfo('description') ) : ?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php endif; ?>

	<?php if (has_nav_menu( 'footer-social' ) ) : ?>
		<div id="footer-social-nav">
			<?php if ( get_theme_mod( 'footer_socialmenu_title' ) ) : ?>
				<h3 class="social-nav-title"><?php echo wp_kses_post( get_theme_mod( 'footer_socialmenu_title' ) ); ?></h3>
			<?php else : ?>
				<h3 class="social-nav-title"><?php esc_html_e('Follow Us', 'zuki') ?></h3>
			<?php endif; ?>
			<?php wp_nav_menu( array('theme_location' => 'footer-social', 'container' => 'false', 'depth' => -1));  ?>
		</div><!-- end #footer-social -->
	<?php endif; ?>

	<div id="site-info">
		<ul class="credit" role="contentinfo">
			<li class="copyright"><?php esc_html_e('Copyright', 'zuki') ?> &copy; 2005–<?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ); ?>">Föreningen UtställningsEstetiskt Forum</a> | 2021 stöder Kulturrådet UtställningsEstetiskt Forum & Utställningskritik | <a href="http://kulturradet.se/sv/bidrag/kulturtidskrifter/Produktionsstod/" target="_blank"><img src="https://media.ueforum.se/2019/06/kulturradet_logo.png" width="126" height="13" scale="0"></a></li>
			<?php
				/* Include Privacy Policy link. */
				if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<li>', '</li>', 'zuki');
				}
			?>
		</ul><!-- end .credit -->
	</div><!-- end #site-info -->

</footer><!-- end #colophon -->
</div><!-- end #main-wrap -->

</div><!-- end #container -->

<?php wp_footer(); ?>

</body>
</html>
