<?php
/** 404 page (not found)
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
* @package candy 
*/

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'candy' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'womp womp! ', 'candy' ); ?></p>

				</div>
			</section>

		</main>
	</div>

<?php
get_footer();