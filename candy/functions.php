<?php
/** candy functions & definitions
* @link https://developer.wordpress.org/themes/basics/theme-functions/
* @package candy
*/

if ( ! function_exists( 'candy_setup' ) ) :
	function candy_setup() {
		add_theme_support( 'title-tag' );

		//feature image
		add_theme_support( 'post-thumbnails' );

		//  wp_nav_menu() 
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'candy' ),
		) );

	}
endif;
add_action( 'after_setup_theme', 'candy_setup' );
 
 // @global int $content_width
function candy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'candy_content_width', 640 );
}
add_action( 'after_setup_theme', 'candy_content_width', 0 );

/**
 * register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function candy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'sidebar', 'candy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( '+ widgets here.', 'candy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'candy_widgets_init' );

// styles
function candy_scripts() {
	wp_enqueue_style( 'candy-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'candy_scripts' );

/**
 * register an editor stylesheet for the theme.
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
 */
 add_editor_style( 'css/custom-editor-style.css' );


 //time and date of post
if ( ! function_exists( 'candy_posted_on' ) ) :
	function candy_posted_on() {
		$time = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time = sprintf( $time,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'posted on %s', 'post date', 'candy' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;

//post author
if ( ! function_exists( 'candy_posted_by' ) ) :
	function candy_posted_by() {
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'candy' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; 
	}
endif;

// adding category & edit to posts footer
if ( ! function_exists( 'candy_entry_footer' ) ) :
	function candy_entry_footer() {
		if ( 'post' === get_post_type() ) {

			$categories_list = get_the_category_list( esc_html__( ', ', 'candy' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'category: %1$s', 'candy' ) . '</span>', $categories_list ); 
			}
		}
		edit_post_link(
			sprintf(
				wp_kses(
					__( 'edit this post', 'candy' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * display feature image on posts
 * @link https://developer.wordpress.org/reference/functions/the_post_thumbnail/ 
 */

if ( ! function_exists( 'candy_post_thumbnail' ) ) :
	function candy_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; 
	}
endif;