<?php
/**
 * template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package candy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				candy_posted_on();
				candy_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<?php candy_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				__( 'read more<span class="screen-reader-text"> "%s"</span>', 'candy' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'pages:', 'candy' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<footer class="entry-footer">
		<?php candy_entry_footer(); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->