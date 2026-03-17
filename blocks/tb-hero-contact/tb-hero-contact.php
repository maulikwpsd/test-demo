<?php
/**
 * Block template file: tb-hero-contact.php
 *
 * Tb Hero Contact Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-hero-contact-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-hero-contact';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// Hero fields
$hero_microTitle = get_field( 'micro_title' );
$hero_mainTitle  = get_field( 'main_title' );
$hero_content    = get_field( 'hero_content' );

// Form fields
$form_title        = get_field( 'form_title' );
$form_id           = get_field( 'form_id' );
$enable_shortcode  = get_field( 'enable_shortcode' );
$shortcode         = get_field( 'shortcode' );

// Background fields
$background_style = get_field( 'background_style' );
$solid_color      = get_field( 'solid_color' );
$gradient_type    = get_field( 'gradient_type' );

$theme_select_locations = get_field('theme_select_locations', 'option');

// Initialize variables
$phone_number = '';
$email = '';
$map_link = '';
$address_text = '';

// Check if single or multi location
if ($theme_select_locations == 'theme-locations--single') {
    // Single location - get phone and email from main location
    $phone_number = get_main_location('theme_loc_phone');
    $email = get_main_location('theme_loc_email');
    
    // Get address from single location
    $theme_single_footer_location = get_field('theme_single_footer_location', 'option');
    if ($theme_single_footer_location) {
        $location = $theme_single_footer_location[0]; // Get first item
        $map_link = get_field('theme_loc_google_map_link', $location->ID);
        $address_1 = get_field('theme_loc_address_1', $location->ID);
        $address_2 = get_field('theme_loc_address_2', $location->ID);
        $address_text = trim($address_1 . ' ' . $address_2);
    }
} else {
    // Multi location - get everything from first location
    $theme_multi_footer_location = get_field('theme_multi_footer_location', 'option');
    if ($theme_multi_footer_location) {
        $location = $theme_multi_footer_location[0]; // Get first item
        $phone_number = get_field('theme_loc_phone', $location->ID);
        $email = get_field('theme_loc_email', $location->ID);
        $map_link = get_field('theme_loc_google_map_link', $location->ID);
        $address_1 = get_field('theme_loc_address_1', $location->ID);
        $address_2 = get_field('theme_loc_address_2', $location->ID);
        $address_text = trim($address_1 . ' ' . $address_2);
    }
}
?>

<section
	id="<?php echo esc_attr( $id ); ?>"
	class="pb-lg <?php echo esc_attr( $classes ); ?>
	<?php echo ( $background_style === 'solid-color' ) ? esc_attr( $solid_color ) : esc_attr( $gradient_type ); ?>"
	aria-label="page introduction">
	<div class="contact-inner">
		<?php if (has_post_thumbnail()) { ?>
			<picture class="hero-img bg--image-abs overlay">
				<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
			</picture>
		<?php } ?>
		<?php if ( ! empty( $hero_mainTitle || $hero_microTitle || $hero_content ) ) : ?>
			<div class="hero-content">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-9 ta-c">
							<div class="contact-content d-flex flex-column">
								<header class="hero-header d-flex flex-column row-gap-16">
									<?php
									$hero_microTitle = get_field('micro_title');
									$hero_mainTitle = get_field('main_title');; ?>
									<?php if ($hero_microTitle) : ?>
										<h1 class="micro"><?php echo $hero_microTitle; ?></h1>
										<h2 class="lvl-2"><?php echo $hero_mainTitle; ?></h2>
									<?php else : ?>
										<h1 class="lvl-2"><?php echo $hero_mainTitle; ?></h1>
									<?php endif; ?>
								</header>
								<?php 
								if ( ! empty( $hero_content ) ) : ?>
									<div class="editor-content">
										<?php echo wp_kses_post( $hero_content ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>	
	</div>
	<div class="contact-bottom-items">
		<div class="container">
			<?php if ( ! empty( $form_title || $form_id ) ) : ?>
				<div class="form-detail">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<div id="form" class="form-wrapper bg-bas-lig">
									<?php if ( $form_title ) : ?>
										<h3><?php echo esc_html( $form_title ); ?></h3>
									<?php endif; 
									if ( $enable_shortcode && $shortcode ) {
										echo do_shortcode( $shortcode );
									} elseif ( $form_id ) {
										echo do_shortcode(
											'[gravityform id="' . esc_attr( $form_id ) . '" title="false" description="false" ajax="false"]'
										);
									}
									get_template_part( 'template-parts/components/social', 'ratings' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( ! empty($email) || ! empty($phone_number) || ! empty($address_text) ) : ?>
				<div class="contact-footer-links">
					<div class="container">
						<div class="row justify-content-between row-gap-4">
							<?php if ( $phone_number ) : ?>
								<div class="col-lg-auto col-md-6">
									<div class="info_block mw-550">
										<p class="d-flex align-items-center fs-12 mb-2">
											<img src="/wp-content/uploads/2026/01/icon-phone-dark.svg" alt="Phone Icon">
											Phone
										</p>
										<a
											href="<?php echo esc_url( $phone_number['url'] ); ?>"
											target="<?php echo esc_attr( $phone_number['target'] ); ?>"
											class="contact-box_link">
											<?php echo esc_html( $phone_number['title'] ); ?>
										</a>
									</div>
								</div>
							<?php endif; ?>
			
							<?php if ( $email ) : ?>
								<div class="col-lg-auto col-md-6">
									<div class="info_block mw-550">
										<p class="d-flex align-items-center fs-12 mb-2">
											<img src="/wp-content/uploads/2026/01/icon-email-dark.svg" alt="Email Icon">
											Email 
										</p>
										<a
											href="<?php echo esc_url( $email['url'] ); ?>"
											target="<?php echo esc_attr( $email['target'] ); ?>"
											class="contact-box_link">
											<?php echo esc_html( $email['title'] ); ?>
										</a>
									</div>
								</div>
							<?php endif; ?>
			
							<?php if ($address_text && $map_link) : ?>
								<div class="col-lg-auto col-md-12">
									<div class="info_block mw-550">
										<p class="d-flex align-items-center fs-12 mb-2">
											<img src="/wp-content/uploads/2026/01/icon-location-dark.svg" alt="Location Icon">
											Address
										</p>
										<a target="_blank" href="<?php echo esc_url($map_link); ?>" class="contact-box_link">
										 	<?php echo esc_html($address_text); ?>
										</a>
									</div>
								</div>
							<?php endif; ?>
			
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
