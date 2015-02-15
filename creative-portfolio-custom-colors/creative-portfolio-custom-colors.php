<?php
/**
 * This plugin is intended to be used as a custom colors add-on to the Creative Portfolio WordPress Theme.
 * It will be of no use if you have not purchased the self-hosted version of Creative Portfolio.
 *
 * @wordpress-plugin
 * Plugin Name: Creative Portfolio Custom Colors
 *  Plugin URI: https://creativemarket.com/professionalthemes/185375-Creative-Portfolio-WordPress-Theme/
 * Description: This plugin adds custom colors functionality into the Creative Portfolio WordPress Theme.
 *      Author: Professional Themes
 *  Author URI: https://creativemarket.com/professionalthemes
 *     Version: 1.0.0
 * Text Domain: creative-portfolio-custom-colors
 * Domain Path: /languages/
 *     License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @see     function add_action
 * @see     function add_control
 * @see     function add_setting
 * @see     function get_control
 * @see     function get_theme_mod
 * @see     function maybe_hash_hex_color
 * @see     function sanitize_hex_color_no_hash
 * @see     function sanitize_text_field
 * @see     function wp_get_theme
 * @since   1.0.0
 * @package Creative_Portfolio_Custom_Colors
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'creative_portfolio_custom_colors_hex_to_rgb' ) ) :
	/**
	 * Simple hex to rgb conversion for better custom color handling
	 *
	 * @link http://php.net/manual/en/function.hexdec.php
	 */
	function creative_portfolio_custom_colors_hex_to_rgb( $hex = false ) {
		if ( false == $hex ) {
			return;
		}
		$color        = (int) hexdec( $hex );
		$rgb          = array();
		$rgb['red']   = (int) 0xFF & ( $color >> 0x10 );
		$rgb['green'] = (int) 0xFF & ( $color >> 0x8 );
		$rgb['blue']  = (int) 0xFF & $color;

		return $rgb;
	} // end function creative_portfolio_custom_colors_hex_to_rgb
endif;

if ( ! function_exists( 'creative_portfolio_custom_colors_customize_register' ) ) :
	// Customizer Registration
	function creative_portfolio_custom_colors_customize_register( $wp_customize ) {
		// Point users to Jetpack Custom CSS if they'd like more control over their colors
		$wp_customize->get_section( 'colors' )->description = __( 'If you would like even more fine-grained control over your colors, take advantage of the Jetpack <a href="http://jetpack.me/support/custom-css/">Custom CSS</a> module.', 'creative-portfolio-custom-colors' );
		// Ensure that core controls are shown above Creative Portfolio Custom Colors controls
		$wp_customize->get_control( 'background_color' )->priority = 1;
		$wp_customize->get_control( 'header_textcolor' )->priority = 2;

		/**
		 * Main Accent Color
		 */
		$wp_customize->add_setting(
			'creative_portfolio_main_accent_bg_color',
			array(
				'default'				=> '0a0a0a',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_main_accent_bg_color',
			array(
				'label'		=> __( 'Main Accent Background', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 100,
			)
		) );
		$wp_customize->add_setting(
			'creative_portfolio_main_accent_txt_color',
			array(
				'default'				=> 'ffffff',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_main_accent_txt_color',
			array(
				'label'		=> __( 'Main Accent Text', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 100,
			)
		) );

		/**
		 * Secondary Accent Color
		 */
		$wp_customize->add_setting(
			'creative_portfolio_secondary_accent_bg_color',
			array(
				'default'				=> '518bbc',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_secondary_accent_bg_color',
			array(
				'label'		=> __( 'Secondary Accent Background', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 101,
			)
		) );
		$wp_customize->add_setting(
			'creative_portfolio_secondary_accent_txt_color',
			array(
				'default'				=> 'ffffff',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_secondary_accent_txt_color',
			array(
				'label'		=> __( 'Secondary Accent Text', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 101,
			)
		) );

		/**
		 * Links
		 */
		$wp_customize->add_setting(
			'creative_portfolio_links_color',
			array(
				'default'				=> '333333',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_links_color',
			array(
				'label'		=> __( 'Links', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 102,
			)
		) );

		/**
		 * Site Top Content
		 */
		$wp_customize->add_setting(
			'creative_portfolio_site_top_content_bg_color',
			array(
				'default'				=> '222222',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_site_top_content_bg_color',
			array(
				'label'		=> __( 'Site Top Content Background', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 103,
			)
		) );
		$wp_customize->add_setting(
			'creative_portfolio_site_top_content_txt_color',
			array(
				'default'				=> 'cccccc',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'creative_portfolio_site_top_content_txt_color',
			array(
				'label'		=> __( 'Site Top Content Text', 'creative-portfolio-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 103,
			)
		) );
	} // end function creative_portfolio_custom_colors_customize_register
endif;

if ( ! function_exists( 'creative_portfolio_customized_colors' ) ) :
	// Output custom colors
	function creative_portfolio_customized_colors() {
		// Retrieve custom colors settings and also provide their rgb equivalents
		$main_accent_bg       = get_theme_mod( 'creative_portfolio_main_accent_bg_color' );
		$main_accent_txt      = get_theme_mod( 'creative_portfolio_main_accent_txt_color' );
		$secondary_accent_bg  = get_theme_mod( 'creative_portfolio_secondary_accent_bg_color' );
		$secondary_accent_txt = get_theme_mod( 'creative_portfolio_secondary_accent_txt_color' );
		$links                = get_theme_mod( 'creative_portfolio_links_color' );
		$site_top_content_bg  = get_theme_mod( 'creative_portfolio_site_top_content_bg_color' );
		$site_top_content_txt = get_theme_mod( 'creative_portfolio_site_top_content_txt_color' );

		/**
		 * Main Accent
		 */
		if ( ! empty( $main_accent_bg ) && '0a0a0a' != $main_accent_bg ) : ?>
			<style type="text/css">
				.site-header,
				.site-footer,
				.main-navigation,
				.main-navigation ul,
				.main-navigation ul ul,
				.infinite-scroll #infinite-handle span {
					background-color: #<?php echo sanitize_text_field( $main_accent_bg ); ?>;
				}
				#page .main-navigation .search-field {
					border: none;
				}
				.main-navigation,
				.main-navigation ul ul {
					-moz-box-shadow:    none;
					-webkit-box-shadow: none;
					box-shadow:         none;
				}
				.menu-visible .menu-toggle {
					background-color: transparent;
				}
			</style><?php
		endif;
		if ( ! empty( $main_accent_txt ) && 'ffffff' != $main_accent_txt ) :
			$main_accent_txt = creative_portfolio_custom_colors_hex_to_rgb( $main_accent_txt ); ?>
			<style type="text/css">
				.main-navigation li.current_page_item > a,
				.main-navigation li.current-menu-item > a,
				.main-navigation li.current_page_ancestor > a,
				.main-navigation li.current-menu-ancestor > a,
				.main-navigation li:hover > a,
				.main-navigation li:active > a,
				.main-navigation li:focus > a,
				.main-navigation li li a:hover,
				.main-navigation li li a:active,
				.main-navigation li li a:focus,
				#page .main-navigation .search-field,
				#page .main-navigation .search-field:hover,
				#page .main-navigation .search-field:active,
				#page .main-navigation .search-field:focus,
				.main-navigation a:hover,
				.main-navigation a:active,
				.main-navigation a:focus,
				.menu-visible .menu-toggle,
				.site-footer a:hover,
				.site-footer a:active,
				.site-footer a:focus,
				.site-title a:hover span,
				.site-title a:active span,
				.site-title a:focus span,
				.infinite-scroll #infinite-handle span {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, 1 );
				}
				.main-navigation a,
				.menu-toggle,
				.site-footer,
				.site-footer a {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .9 );
				}
				.main-navigation ul ul li,
				.main-navigation ul ul li a,
				.main-navigation li li a:hover,
				.main-navigation li li a:active,
				.main-navigation li li a:focus,
				.site-description {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .8 );
				}
				.main-navigation li li a {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .7 );
				}
				.menu-item-description {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .6 );
				}
				.site-footer a:hover,
				.site-footer a:active,
				.site-footer a:focus {
					-webkit-box-shadow: inset 0 -1px 0 0 rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, 1 );
					   -moz-box-shadow: inset 0 -1px 0 0 rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, 1 );
					        box-shadow: inset 0 -1px 0 0 rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, 1 );
				}
				.main-navigation ::-webkit-input-placeholder {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .8 );
				}
				.main-navigation :-moz-placeholder {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .8 );
				}
				.main-navigation ::-moz-placeholder {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .8 );
				}
				.main-navigation :-ms-input-placeholder {
					color: rgba( <?php echo sanitize_text_field( $main_accent_txt['red'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['green'] ); ?>, <?php echo sanitize_text_field( $main_accent_txt['blue'] ); ?>, .8 );
				}
			</style><?php
		endif;

		/**
		 * Secondary Accent
		 */
		if ( ! empty( $secondary_accent_bg ) && '1cd6b5' != $secondary_accent_bg ) : ?>
			<style type="text/css">
				#front-page-banner,
				#featured-video,
				#site-callout {
					background-color: #<?php echo sanitize_text_field( $secondary_accent_bg ); ?>;
				}
			</style><?php
		endif;
		if ( ! empty( $secondary_accent_txt ) && 'ffffff' != $secondary_accent_txt ) : ?>
			<style type="text/css">
				#front-page-banner,
				#featured-video,
				#site-callout,
				#site-callout .call-to-action {
					color: #<?php echo sanitize_text_field( $secondary_accent_txt ); ?>;
				}
			</style><?php
		endif;

		/**
		 * Links
		 */
		if ( ! empty( $links ) && '333333' != $links ) :
			$links = creative_portfolio_custom_colors_hex_to_rgb( $links ); ?>
			<style type="text/css">
				#page #page-content a,
				#page .no-results a,
				#page .entry-content p > a,
				#page .comment-content a,
				#page .taxonomy-description a,
				.entry-content > ul > li > a,
				.entry-content > ol > li > a,
				#page dt a,
				#page dl dd a,
				#page .entry-content h1 a,
				#page .entry-content h2 a,
				#page .entry-content h3 a,
				#page .entry-content h4 a,
				#page .entry-content h5 a,
				#page .entry-content h6 a,
				#page table a,
				big a,
				small a,
				#page-content em a,
				.entry-content em a,
				#page-content strong a,
				.entry-content strong a,
				#tertiary .textwidget a,
				.textwidget a,
				.post-navigation a,
				.image-navigation a div,
				.blog .excerpt-more a,
				.archive .excerpt-more a,
				.search .excerpt-more a,
				.notice a,
				.error a,
				.info a,
				.success a {
					color: rgb( <?php echo sanitize_text_field( $links['red'] ); ?>, <?php echo sanitize_text_field( $links['green'] ); ?>, <?php echo sanitize_text_field( $links['blue'] ); ?> );
				}
				#page #page-content a,
				#page .no-results a,
				#page .entry-content p > a,
				#page .comment-content a,
				#page .taxonomy-description a,
				.entry-content > ul > li > a,
				.entry-content > ol > li > a,
				#page dt a,
				#page dl dd a,
				#page .entry-content h1 a,
				#page .entry-content h2 a,
				#page .entry-content h3 a,
				#page .entry-content h4 a,
				#page .entry-content h5 a,
				#page .entry-content h6 a,
				#page table a {
					background-color: rgba( <?php echo sanitize_text_field( $links['red'] ); ?>, <?php echo sanitize_text_field( $links['green'] ); ?>, <?php echo sanitize_text_field( $links['blue'] ); ?>, .02 );
					border-color: rgba( <?php echo sanitize_text_field( $links['red'] ); ?>, <?php echo sanitize_text_field( $links['green'] ); ?>, <?php echo sanitize_text_field( $links['blue'] ); ?>, .1 );
				}
			</style><?php
		endif;

		/**
		 * Site Top Content
		 */
		if ( ! empty( $site_top_content_bg ) && '222222' != $site_top_content_bg ) : ?>
			<style type="text/css">
				#site-top-content {
					background-color: #<?php echo sanitize_text_field( $site_top_content_bg ); ?>;
				}
			</style><?php
		endif;
		if ( ! empty( $site_top_content_txt ) && 'cccccc' != $site_top_content_txt ) :
			$site_top_content_txt = creative_portfolio_custom_colors_hex_to_rgb( $site_top_content_txt ); ?>
			<style type="text/css">
				#site-top-content {
					color: rgba( <?php echo sanitize_text_field( $site_top_content_txt['red'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['green'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['blue'] ); ?>, .8 );
				}
				#site-top-content a {
					color: rgba( <?php echo sanitize_text_field( $site_top_content_txt['red'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['green'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['blue'] ); ?>, .9 );
				}
				#site-top-content a:hover {
					color: rgba( <?php echo sanitize_text_field( $site_top_content_txt['red'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['green'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['blue'] ); ?>, .95 );
				}
				#site-top-content a:active,
				#site-top-content a:focus {
					color: rgb( <?php echo sanitize_text_field( $site_top_content_txt['red'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['green'] ); ?>, <?php echo sanitize_text_field( $site_top_content_txt['blue'] ); ?> );
				}
			</style><?php
		endif;
	}// end function creative_portfolio_customized_colors
endif;

// Only proceed if Creative Portfolio is in use.
$current_theme          = wp_get_theme();
$current_theme_name     = ! empty( $current_theme ) ? (string) $current_theme->Name : null;
$current_theme_template = ! empty( $current_theme ) ? (string) $current_theme->Template : null;
if ( 'Creative Portfolio' === $current_theme_name || 'creative-portfolio' === $current_theme_template ) :
	add_action( 'customize_register', 'creative_portfolio_custom_colors_customize_register', 11 );
	add_action( 'wp_head', 'creative_portfolio_customized_colors' );
endif;