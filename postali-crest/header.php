<?php
/**
 * Theme header.
 *
 * @package Postali Crest Controller Theme
 * @author Postali LLC
**/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-N34NJN');</script>
	<!-- End Google Tag Manager -->

	<!-- Add JSON Schema here -->
    <?php 
    // Global Schema
    $global_schema = get_field('global_schema', 'options');
    if ( !empty($global_schema) ) :
        echo '<script type="application/ld+json">' . $global_schema . '</script>';
    endif;

    // Single Page Schema
    $single_schema = get_field('single_schema');
    if ( !empty($single_schema) ) :
        echo '<script type="application/ld+json">' . $single_schema . '</script>';
    endif; ?>
	
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>

	<?php get_template_part('block','design'); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php get_template_part('block','font-select'); ?>

</head>

<a class="skip-link" href='#main-content'>Skip to Main Content</a>

<body <?php body_class(); ?>>

	<?php if( get_field('enable_banner', 'options') ) : $marketing_link = get_field('marketing_banner_link', 'options'); ?>
		<div class="marketing-banner">
			<?php if( $marketing_link ) : ?>
				<a href="<?php echo esc_url($marketing_link['url']); ?>" target="<?php echo esc_attr($marketing_link['target']); ?>">
					<?php echo esc_html($marketing_link['title']); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

		<?php if( get_field('enable_secondary_banner', 'options') ) : $secondary_marketing_link = get_field('secondary_marketing_banner', 'options'); ?>
		<div class="marketing-banner secondary-banner">
			<?php if( $secondary_marketing_link ) : ?>
				<a href="<?php echo esc_url($secondary_marketing_link['url']); ?>" target="<?php echo esc_attr($secondary_marketing_link['target']); ?>">
					<?php echo esc_html($secondary_marketing_link['title']); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="secondary-banner-spacer"></div>
	<?php endif; ?>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N34NJN"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<header <?php if( get_field('enable_secondary_banner', 'options') ) { echo 'class="secondary-banner-adjustment"'; } ?>>
		<div id="header-top" class="container">
			<div id="header-top_left">
				<?php the_custom_logo(); ?>
			</div>
			
			<div id="header-top_right">
				<div id="header-top_right_menu">
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'header-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
					<div id="header-top_mobile">
						<div id="menu-icon" class="toggle-nav">
							<span class="line line-1"></span>
							<span class="line line-2"></span>
							<span class="line line-3"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header> 