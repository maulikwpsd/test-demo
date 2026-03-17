<?php
/**
 * Block template file: tb-our-process.php
 *
 * Tb Our Process Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-our-process-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-our-process';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$background_color = get_field( 'background_color' );
$microTitle = get_field( 'company_process_micro_title', 'option' );
$mainTitle = get_field( 'company_process_main_title', 'option' );
$process_steps = get_field( 'process_steps', 'option' );
$process_image = get_field( 'company_process_image', 'option' );
$form_title = get_field( 'process_form_title', 'option' );
$form_id = get_field( 'process_form_id', 'option' );
$enable_shortcode = get_field( 'processenable_shortcode', 'option' );
$shortcode = get_field( 'process_shortcode', 'option' );
$process_order = get_field( 'process_order', 'option' );
$imagecorner = get_field( 'select_image_corner', 'option' ); 
$cornerclass = ($imagecorner == 1) ? 'process-tb-square' : 'process-tb-circle';
?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr($process_order);?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?> <?php echo esc_attr( $cornerclass ); ?>">
	<div class="proces-inner">
        <?php if (!empty($process_image['url'])) : ?>
            <picture class="company-process-image">
                <img src="<?php echo esc_url( $process_image['url'] ); ?>" alt="<?php echo esc_attr( $process_image['alt'] ); ?>" />
            </picture>
        <?php endif; ?>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                     <?php if ( $shortcode || $form_id ) : ?>
                    <div id="form" class="form-wrapper bg-bas-lig">
                        <?php if ( $form_title ) : ?>
                            <h3><?php echo esc_html( $form_title ); ?></h3>
                        <?php endif; ?>
    
                        <?php
                        if ( $enable_shortcode == 1) {
                            echo do_shortcode( $shortcode );
                        } elseif ( $form_id ) {
                            echo do_shortcode(
                                '[gravityform id="' . esc_attr( $form_id ) . '" title="false" description="false" ajax="false"]'
                            );
                        }
                        ?>
                        <?php
                        get_template_part( 'template-parts/components/social', 'ratings' );
                        ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="process-right-block">
                        <?php if ( !empty($microTitle) ) : ?>
                            <div class="section-header">
                                <h2 class="micro"><?php echo $microTitle;?></h2>
                                <?php if ( $mainTitle ) : ?>
                                <h3 class="lvl-2"><?php echo $mainTitle;?></h3>
                                <?php endif; ?>
                            </div>
                        <?php elseif ( !empty($mainTitle) ) : ?>
                            <div class="section-header">
                                <h2><?php echo $mainTitle;?></h2>
                            </div>
                        <?php endif ; ?>
                        <?php if ( have_rows( 'process_steps', 'option' ) ) : ?>
                            <div class="procces-block">
                                <?php while ( have_rows( 'process_steps', 'option' ) ) : the_row();
                                $icon = get_sub_field( 'icon' ); 
                                $micro_title = get_sub_field( 'micro_title' ); 
                                $title = get_sub_field( 'title' ); 
                                $process_description = get_sub_field( 'process_description' ); 
                                ?>
                                    <div class="process-block-item">
                                        <?php if ( !empty($icon) ) : ?>
                                            <div class="icon">
                                                <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
                                            </div>
                                        <?php endif; ?>
                                        <div class="process-block-inner">
                                            <?php if(!empty($micro_title)) : ?>
                                                <p class="fs-12 mb-1"><?php echo $micro_title;?></p>
                                            <?php endif; ?>
                                            <?php if(!empty($title)) : ?>
                                                <h4><?php echo $title;?></h4>
                                            <?php endif; ?>
                                            <?php if(!empty($process_description)) : ?>
                                                <p class="pt-3"><?php echo $process_description;?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>