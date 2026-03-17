<?php
/**
 * Block template file: cs-two-column.php
 *
 * Cs Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cs-two-column-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.

$classes = 'block-cs-two-column';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$row_order = get_field('row_order');
$microTitle = get_field('micro_title');
$mainTitle  = get_field('main_title');
$sectionContent = get_field('section_content');
$section_cta = get_field( 'section_cta_button' );
$enable_video_lightbox = get_field( 'enable_video_lightbox' );
$section_image = get_field( 'section_image' );
$youtube_video_id = get_field( 'youtube_video_id' );
$size = 'medium';
$background_style = get_field( 'background_style' );
$solid_color = get_field( 'solid_color' );
$gradient_type = get_field( 'gradient_type' );
$review_shortcode = get_field('review_shortcode');
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?> <?php echo esc_attr($row_order);?> <?php echo $background_style === 'solid-color' ? $solid_color : $gradient_type; ?>">
	<div class="container">
        <div class="row align-items-center row-gap-30">
			<div class="col-lg-6">
				<div class="image-block">
                <?php if ($enable_video_lightbox == '1' ) : ?>
					<a class="yt-video" href="http://www.youtube.com/watch?v=<?php echo $youtube_video_id; ?>">
				<?php endif; ?>
                    <picture>
						<?php if ( $section_image ) : ?>
							<?php echo wp_get_attachment_image( $section_image, $size ); ?>
						<?php endif; ?>
					</picture>
				<?php if ($enable_video_lightbox == '1' ) : ?>
					</a>
				<?php endif; ?>
				<?php if ( ! empty($review_shortcode) ) {
					echo do_shortcode($review_shortcode);
				} ?>
				</div>
            </div>
            <div class="col-lg-6">
				<div class="content-block d-flex flex-column row-gap-24">
                <?php if ( $microTitle ) : ?>
					<div class="section-header">
						<h2 class="micro"><?php echo $microTitle;?></h2>
						<h3 class="lvl-2"><?php echo $mainTitle;?></h3>
					</div>
				<?php else : ?>
					<div class="section-header">
						<h2><?php echo $mainTitle;?></h2>
					</div>
				<?php endif ; ?>
                <?php if ( $sectionContent ) : ?>
					<div class="editor-content">
						<?php echo $sectionContent;?>
					</div>
				<?php endif ; ?>
                <?php if ( $section_cta ) : ?>
					<div class="btn-wrap">
						<a class="btn btn--secondary" 
								href="<?php echo esc_url( $section_cta['url'] ); ?>" 
								target="<?php echo esc_attr( $section_cta['target'] ); ?>" 
								aria-label="Open Link">
							<span><?php echo esc_html( $section_cta['title'] ); ?></span>
						</a>
					</div>
				<?php endif; ?>
				</div>	
            </div>
        </div>
    </div>
</section>