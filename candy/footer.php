<?php
/** @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
* @package candy
*/
?>

	</div><!-- content ends here -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'candy' ) ); ?>">
				<?php
				printf( esc_html__( 'powered by %s', 'candy' ), 'wp' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				printf( esc_html__( 'theme: %1$s by %2$s.', 'candy' ), 'candy', '<a href="http://carolinacodes.com">carolinacodes.com</a>' );
				?>
		</div>
	</footer>
</div><!-- page ends here -->

<?php wp_footer(); ?>

</body>
</html>