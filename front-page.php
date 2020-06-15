<?php

/**
 * Workstation Pro.
 *
 * This file adds the front page to the Workstation Pro Theme.
 *
 * @package Workstation
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/workstation/
 */

// Filter the homepage site description.
add_filter('genesis_seo_description', 'workstation_seo_description', 10, 2);
function workstation_seo_description($description, $inside)
{

	$inside = esc_html(get_bloginfo('description'));


	// * Get ACF slogan from page Startsida
	if (have_rows('slogan_group')) :
		while (have_rows('slogan_group')) : the_row();

			// Check if the slogan exists and print
			if (get_sub_field('text')) {
				echo '<div class="slogan-wrapper">';
				echo '<h2 class="slogan">';
				echo get_sub_field('text');
				echo '<br>';

				if (get_sub_field('kalla')) {
					// If Källa exists, add an en dash and print
					echo '<span class="slogan__source">';
					echo '–';
					echo get_sub_field('kalla');
					echo '</span>';
				}

				echo '</h2>';
			}
		endwhile;
	endif;

	if (get_field('slogan_bild')) {
		echo '<div class="after-slogan" style="background-image: url(' . get_field('slogan_bild') . ');"></div>';
	}

	if (have_rows('slogan_group')) :
		while (have_rows('slogan_group')) : the_row();

			// Check if the slogan exists and print
			if (get_sub_field('text')) {
				echo '</span>';
			}
		endwhile;
	endif;

	// $description = sprintf( '<h2 class="site-description">%s</h2>', $inside );
	// return $description;

}

add_action('genesis_meta', 'workstation_front_page_genesis_meta');
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function workstation_front_page_genesis_meta()
{
	// Remove the conditional to trigger the layout without using widgets. 

	// if (is_active_sidebar('front-page-1') || is_active_sidebar('front-page-2') || is_active_sidebar('front-page-3') || is_active_sidebar('front-page-4')) {

	// Add front-page body class.
	add_filter('body_class', 'workstation_body_class');

	// Force full width content layout.
	add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

	// Remove breadcrumbs.
	remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');

	// Remove the default Genesis loop.
	remove_action('genesis_loop', 'genesis_do_loop');

	// Add the rest of front page widgets.
	add_action('genesis_loop', 'workstation_front_page_widgets');

	// Conditional removed.
	// }
}

// Define front-page body class.
function workstation_body_class($classes)
{

	$classes[] = 'front-page';

	return $classes;
}

// Output the front page widget areas.
function workstation_front_page_widgets()
{

	$image_section_1 = get_option('1-workstation-image', sprintf('%s/images/bg-1.jpg', get_stylesheet_directory_uri()));

	$image_section_2 = get_option('2-workstation-image', sprintf('%s/images/bg-2.jpg', get_stylesheet_directory_uri()));

	if (!empty($image_section_1)) {
		echo '<div class="image-section-1"></div>';
	}

	// Add sales pitch from custom fields
	if (get_field('text_del_1')) {
		echo '<div class="sales-pitch">';
		echo '<div class="sales-pitch__part-1">';
		echo get_field('text_del_1');
		echo '</div>';
	}

	if (get_field('text_del_2')) {
		echo '<div class="sales-pitch__part-2">';
		echo '<div class="sales-pitch__part-2-content">';
		echo get_field('text_del_2');

		// Check for the cta button
		if (get_field('cta')) {
			echo '<div class=sales-pitch__cta"><a href="' . site_url() . '/forskola" class="button">' . get_field('cta') . '</a></div>';
		}

		echo '</div>';
		echo '</div>';
		echo '</div>'; // close .sales-pitch
	} else {
		// No part 2, close the flex box .sales-pitch and print the button if it exists
		echo '</div>'; // close .sales-pitch

		// Check for the cta button
		if (get_field('cta')) {
			echo '<div class=sales-pitch__cta"><a href="' . site_url() . '/forskola" class="button">' . get_field('cta') . '</a></div>';
		}
	}

	// Matsedel

	// Query the latest entry from this custom post type.
	$args = array('post_type' => 'matsedel', 'posts_per_page' => 1);
	$loop = new WP_Query($args);
?>

	<?php while ($loop->have_posts()) : $loop->the_post(); ?>

		<div class="matsedel">

			<h3><?php the_title(); ?></h3>

			<ul>

				<?php if (have_rows('mandag')) : ?>
					<?php while (have_rows('mandag')) : the_row(); ?>

						<li class="dag">
							<h4>Måndag</h4>

							<?php
							if (get_sub_field('stangt') == 1) {
								echo '<p><strong>Stängt</strong></p>';
							} else {
								echo '<p>';
								echo '<strong>Lunch</strong><br />';
								echo get_sub_field('lunch') . '<br />';
								echo '<strong>Mellanmål</strong><br />';
								echo get_sub_field('mellanmal');
								echo '</p>';
							}
							?>

						</li>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php if (have_rows('tisdag')) : ?>
					<?php while (have_rows('tisdag')) : the_row(); ?>

						<li class="dag">
							<h4>Tisdag</h4>

							<?php
							if (get_sub_field('stangt') == 1) {
								echo '<p><strong>Stängt</strong></p>';
							} else {
								echo '<p>';
								echo '<strong>Lunch</strong><br />';
								echo get_sub_field('lunch') . '<br />';
								echo '<strong>Mellanmål</strong><br />';
								echo get_sub_field('mellanmal');
								echo '</p>';
							}
							?>

						</li>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php if (have_rows('onsdag')) : ?>
					<?php while (have_rows('onsdag')) : the_row(); ?>

						<li class="dag">
							<h4>Onsdag</h4>

							<?php
							if (get_sub_field('stangt') == 1) {
								echo '<p><strong>Stängt</strong></p>';
							} else {
								echo '<p>';
								echo '<strong>Lunch</strong><br />';
								echo get_sub_field('lunch') . '<br />';
								echo '<strong>Mellanmål</strong><br />';
								echo get_sub_field('mellanmal');
								echo '</p>';
							}
							?>

						</li>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php if (have_rows('torsdag')) : ?>
					<?php while (have_rows('torsdag')) : the_row(); ?>

						<li class="dag">
							<h4>Torsdag</h4>

							<?php
							if (get_sub_field('stangt') == 1) {
								echo '<p><strong>Stängt</strong></p>';
							} else {
								echo '<p>';
								echo '<strong>Lunch</strong><br />';
								echo get_sub_field('lunch') . '<br />';
								echo '<strong>Mellanmål</strong><br />';
								echo get_sub_field('mellanmal');
								echo '</p>';
							}
							?>

						</li>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php if (have_rows('fredag')) : ?>
					<?php while (have_rows('fredag')) : the_row(); ?>

						<li class="dag">
							<h4>Fredag</h4>

							<?php
							if (get_sub_field('stangt') == 1) {
								echo '<p><strong>Stängt</strong></p>';
							} else {
								echo '<p>';
								echo '<strong>Lunch</strong><br />';
								echo get_sub_field('lunch') . '<br />';
								echo '<strong>Mellanmål</strong><br />';
								echo get_sub_field('mellanmal');
								echo '</p>';
							}
							?>

						</li>

					<?php endwhile; ?>
				<?php endif; ?>

			</ul>
		</div>

		<?php wp_reset_postdata(); ?>
	<?php endwhile; ?>

<?php


	genesis_widget_area('front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="flexible-widgets widget-area wrap' . workstation_widget_area_class('front-page-1') . '">',
		'after'  => '</div></div>',
	));

	genesis_widget_area('front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="flexible-widgets widget-area wrap' . workstation_widget_area_class('front-page-2') . '">',
		'after'  => '</div></div>',
	));

	genesis_widget_area('front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="flexible-widgets widget-area wrap' . workstation_widget_area_class('front-page-3') . '">',
		'after'  => '</div></div>',
	));

	if (!empty($image_section_2)) {
		echo '<div class="image-section-2"></div>';
	}

	genesis_widget_area('front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4"><div class="flexible-widgets widget-area wrap' . workstation_widget_area_class('front-page-4') . '">',
		'after'  => '</div></div>',
	));
}

// Run the Genesis loop.
genesis();
