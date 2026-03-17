<?php

/**

 * Block template file: cs-callout-banner.php

 *

 * Cs Two Column Block Template.

 *

 * @param   array $block The block settings and attributes.

 * @param   string $content The block inner HTML (empty).

 * @param   bool $is_preview True during AJAX preview.

 * @param   (int|string) $post_id The post ID this block is saved to.

 */



// Create id attribute allowing for custom "anchor" value.

$id = 'cs-callout-banner-' . $block['id'];

if ( ! empty($block['anchor'] ) ) {

    $id = $block['anchor'];

}



// Create class attribute allowing for custom "className" and "align" values.

$classes = 'block-cs-callout-banner';

if ( ! empty( $block['className'] ) ) {

    $classes .= ' ' . $block['className'];

}

if ( ! empty( $block['align'] ) ) {

    $classes .= ' align' . $block['align'];

}

$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$content_alignment = get_field( 'content_alignment' );
$choose_layout = get_field( 'choose_layout' );
$microTitle = get_field('micro_headline');
$mainTitle  = get_field('main_headline');
$sectionContent = get_field('banner_content');
$section_cta = get_field( 'section_cta_button' );
$callout_image = get_field( 'callout_image' );
$callout_logo = get_field( 'callout_logo' );
$background_color = get_field( 'background_color' );
$size = 'full';
$imagecorner = get_field( 'select_image_corner', 'option' ); 
$cornerclass = ($imagecorner == 1) ? 'callout-tb-square' : 'callout-tb-circle';
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo $background_color; ?> <?php echo esc_attr( $choose_layout ); ?> <?php echo esc_attr( $cornerclass ); ?>" aria-label="callout banner">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="callout-inner-block">
					<div class="callout-inner d-grid align-items-center">
						<?php if ( !empty($callout_image) ) : ?>
							<div class="callout-img">
								<picture>
									<?php echo wp_get_attachment_image( $callout_image, $size ); ?>
								</picture>
								<?php if ( !empty($callout_logo) ) : ?>
									<div class="callout-logo">
										<img src="<?php echo esc_url( $callout_logo['url'] ); ?>" alt="<?php echo esc_attr( $callout_logo['alt'] ); ?>" />
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( !empty($microTitle || $mainTitle || $sectionContent || $section_cta) ) : ?>
							<div class="content-block d-flex flex-column row-gap-24">
								<?php if ( !empty($microTitle) ) : ?>
									<div class="section-header">
										<h2 class="micro"><?php echo $microTitle;?></h2>
										<?php if ( $mainTitle ) : ?>
										<h3 class="lvl-2"><?php echo $mainTitle;?></h3>
										<?php endif ; ?>
									</div>
								<?php elseif ( !empty($mainTitle) ) : ?>
									<div class="section-header">
										<h2><?php echo $mainTitle;?></h2>
									</div>
								<?php endif ; ?>
								<?php if ( !empty($sectionContent) ) : ?>
									<div class="editor-content">
										<?php echo $sectionContent;?>
									</div>
								<?php endif ; ?>
								<?php if ( !empty($section_cta) ) : ?>
									<div class="btn-wrap">
										<a class="btn btn--tertiary" 
												href="<?php echo esc_url( $section_cta['url'] ); ?>" 
												target="<?php echo esc_attr( $section_cta['target'] ); ?>" 
												aria-label="Open Link">
											<span><?php echo esc_html( $section_cta['title'] ); ?></span>
										</a>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>