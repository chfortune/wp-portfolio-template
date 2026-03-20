<?php
/**
 * Portfolio Template Functions
 * À ajouter dans functions.php de votre thème
 *
 * @package WordPress
 * @subpackage Portfolio_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles
 */
function portfolio_enqueue_assets() {
	wp_enqueue_style(
		'portfolio-styles',
		get_template_directory_uri() . '/portfolio-one-pager.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_script(
		'portfolio-scripts',
		get_template_directory_uri() . '/portfolio-functions.js',
		array(),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_assets' );

/**
 * Theme support
 */
function portfolio_theme_support() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'editor-font-sizes' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'appearance-tools' );
}
add_action( 'after_setup_theme', 'portfolio_theme_support' );

/**
 * Add custom block editor settings
 */
function portfolio_block_editor_settings( $settings ) {
	$settings['colors'] = array(
		array(
			'color' => '#0073aa',
			'name'  => 'Primary Blue',
			'slug'  => 'primary-blue',
		),
		array(
			'color' => '#1a1a1a',
			'name'  => 'Dark',
			'slug'  => 'dark',
		),
		array(
			'color' => '#f9f9f9',
			'name'  => 'Light Gray',
			'slug'  => 'light-gray',
		),
		array(
			'color' => '#ffffff',
			'name'  => 'White',
			'slug'  => 'white',
		),
	);

	return $settings;
}
add_filter( 'block_editor_settings_all', 'portfolio_block_editor_settings' );

/**
 * Custom block category
 */
function portfolio_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				slug  => 'portfolio',
				title => __( 'Portfolio Blocks', 'textdomain' ),
				icon  => 'format-gallery',
			),
		)
	);
}
add_filter( 'block_categories_all', 'portfolio_block_category' );

/**
 * Add portfolio body class
 */
function portfolio_body_class( $classes ) {
	if ( is_page_template( 'portfolio-template.php' ) ) {
		$classes[] = 'portfolio-page';
	}
	return $classes;
}
add_filter( 'body_class', 'portfolio_body_class' );

/**
 * Sanitize and escape portfolio content
 */
function portfolio_sanitize_content( $content ) {
	return wp_kses_post( $content );
}

/**
 * Get portfolio projects
 */
function get_portfolio_projects( $args = array() ) {
	$defaults = array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'meta_key'       => '_portfolio_project',
		'meta_value'     => '1',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);

	$args = wp_parse_args( $args, $defaults );
	return get_posts( $args );
}

/**
 * Display portfolio project
 */
function display_portfolio_project( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return;
	}

	$featured_image = get_the_post_thumbnail_url( $post_id, 'medium_large' );
	$description    = get_post_meta( $post_id, '_portfolio_description', true );
	$client         = get_post_meta( $post_id, '_portfolio_client', true );
	$year           = get_post_meta( $post_id, '_portfolio_year', true );

	?>
	<div class="portfolio-project wp-block-group is-style-card">
		<?php if ( $featured_image ) : ?>
			<div class="portfolio-project__image wp-block-image">
				<img src="<?php echo esc_url( $featured_image ); ?>" 
					 alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
			</div>
		<?php endif; ?>
		<div class="portfolio-project__content">
			<h3 class="wp-block-heading"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
			<?php if ( $client ) : ?>
				<p><strong><?php esc_html_e( 'Client:', 'textdomain' ); ?></strong> <?php echo esc_html( $client ); ?></p>
			<?php endif; ?>
			<?php if ( $year ) : ?>
				<p><strong><?php esc_html_e( 'Year:', 'textdomain' ); ?></strong> <?php echo esc_html( $year ); ?></p>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p><?php echo wp_kses_post( $description ); ?></p>
			<?php endif; ?>
			</div>
		</div>
	<?php
}

/**
 * Register custom REST API fields for portfolio
 */
function register_portfolio_rest_fields() {
	register_rest_field(
		'page',
		'portfolio_data',
		array(
			'get_callback'    => function( $post ) {
				return array(
					'description' => get_post_meta( $post['id'], '_portfolio_description', true ),
					'client'      => get_post_meta( $post['id'], '_portfolio_client', true ),
					'year'        => get_post_meta( $post['id'], '_portfolio_year', true ),
				);
			},
			'update_callback' => null,
			'schema'          => null,
		)
	);
}
add_action( 'rest_api_init', 'register_portfolio_rest_fields' );
?>