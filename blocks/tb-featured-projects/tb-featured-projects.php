<?php
/**
 * Block template file: tb-featured-projects.php
 *
 * Tb Featured Projects Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-featured-projects-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-featured-projects';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$microTitle = get_field( 'micro_title');
$mainTitle = get_field( 'main_title');
$section_cta = get_field( 'section_cta_button');
$select_projects = get_field( 'select_projects' );
?>

<section id="<?php echo esc_attr( $id ); ?>" class="featured-projects <?php echo esc_attr( $classes ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?>">
    <div class="container">
        <div class="row justify-content-center cs-pb-md">
            <?php if ( $select_projects ) : ?>
                <div class="col-lg-7">
                    <div class="projects-slider">
                        <?php  $i = 1;
                        foreach ( $select_projects as $post ) :                        
                            setup_postdata( $post ); 
                            $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'large' ); 
                            $title = sanitize_title( get_the_title($post->ID));
                            if ( $featured_img_url ) : ?>
                                <div class="slide">
                                    <div class="project-item">
                                        <a href="#<?php echo $title . '-' . $i; ?>" class="image-popup">
                                            <div class="project-block">
                                                <picture class="project-image overlay">
                                                    <img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <div class="plus"></div>
                                                </picture>
                                            </div>
                                        </a>
                                        <div id="<?php echo $title . '-' . $i; ?>" class="mfp-hide proj-popup-detail">  
                                            <div class="proj-popup_single-img">
                                                <picture class="single-image">
                                                    <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php the_title_attribute(); ?>">
                                                </picture>
                                            </div>                             
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php  $i++; endforeach; 
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-5"> 
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
                <?php if ( $section_cta ) : ?>
                    <div class="btn-wrap pt-4">
                        <a class="btn btn--secondary" href="<?php echo esc_url( $section_cta['url'] ); ?>" target="<?php echo esc_attr( $section_cta['target'] ); ?>" aria-label="Open Link">
                            <span><?php echo esc_html( $section_cta['title'] ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="custom-button">
                    <button class="prev-btn"></button>
                    <button class="next-btn"></button>
                </div>
            </div>
        </div>
    </div>
</section>