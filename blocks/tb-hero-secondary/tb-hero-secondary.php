<?php
/**
 * Block template file: tb-hero-secondary.php
 *
 * Tb Hero Secondary Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-hero-secondary-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-hero-secondary';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
// ACF fields
$hero_content     = get_field( 'hero_content' );
$background_style = get_field( 'background_style' );
$solid_color      = get_field( 'solid_color' );
$gradient_type    = get_field( 'gradient_type' );
$hero_cta_link    = get_field( 'hero_cta_button' );
$secondary_image    = get_field( 'secondary_image' );

// Background classes
$bg_class = '';
if ( $background_style === 'solid-color' && $solid_color ) {
	$bg_class = $solid_color;
} elseif ( $background_style === 'gradient' && $gradient_type ) {
	$bg_class = $gradient_type;
}
$imagecorner = get_field( 'select_image_corner', 'option' ); 
$cornerclass = ($imagecorner == 1) ? 'sec-tb-square' : 'sec-tb-circle';
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo $background_style === 'solid-color' ? $solid_color : $gradient_type; ?> <?php echo esc_attr( $cornerclass ); ?>" aria-label="page introduction">          
	<div class="hero-secondary-inner">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="hero-content">
						<?php get_template_part( 'template-parts/components/hero', 'headings' ); 
						if ( ! empty( $hero_content ) ) : ?>
							<div class="editor-content">
								<?php echo wp_kses_post( $hero_content ); ?>
							</div>
						<?php endif; 
						get_template_part( 'template-parts/components/highlight', 'list' ); 
						if ( ! empty( $hero_cta_link ) ) : ?>
							<div class="btn-wrap">
								<a
									class="btn btn--primary-light"
									href="<?php echo esc_url( $hero_cta_link['url'] ); ?>"
									<?php if ( ! empty( $hero_cta_link['target'] ) ) : ?>
										target="<?php echo esc_attr( $hero_cta_link['target'] ); ?>"
										rel="noopener noreferrer"
									<?php endif; ?>>
									<?php echo esc_html( $hero_cta_link['title'] ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if (has_post_thumbnail()) { ?>
					<div class="col-lg-6">			
						<div class="hero-img-block">
							<picture class="hero-img">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
							</picture>				
							<?php if(!empty($secondary_image)):?>
								<picture class="hero-sec-img">
									<img src="<?php echo esc_url( $secondary_image['url'] ); ?>" alt="<?php echo esc_attr( $secondary_image['alt'] ); ?>" />
								</picture>
							<?php endif;?>
						</div>	
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>