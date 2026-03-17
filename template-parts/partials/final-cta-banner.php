<?php 
/*
 * This is the layout for the page-bottom CTA Banner
 *
 * By default this layout will pull in field data from 'Theme Options > CTAs'.
 *
 * This can be overridden on an individual basis using the 'Page Options' panel on specific pages.
 *
 */

// Theme Options default fields
$cta_main_headline = get_field( 'final_cta_banner_main_title', 'option' );
$cta_micro_title = get_field( 'final_cta_banner_micro_title', 'option' );
$primary_cta = get_field( 'final_cta_banner_link', 'option' );
$def_image = get_field( 'final_cta_banner_image', 'option' );
$def_image_size = 'full';
$show_options = get_field( 'display_final_cta_banner' );

// Page Options override fields
$override_headline = get_field( 'cta_banner_override_main_title' );
$override_micro_title = get_field( 'cta_banner_override_micro_title' );
$override_cta = get_field( 'cta_banner_override_link' );
$override_image = get_field( 'cta_banner_override_image' );
$override_image_size = 'full';

$ppc_page_override_link = get_field( 'ppc_page_override_link', get_the_ID());

$micro_title = $override_micro_title ?: $cta_micro_title;
$headline    = $override_headline ?: $cta_main_headline;

$imagecorner = get_field( 'select_image_corner', 'option' ); 
$cornerclass = ($imagecorner == 1) ? 'cta-tb-square' : 'cta-tb-circle';
?>

<section id="cta-banner-<?php echo $post->ID;?>" class="cta-banner <?php echo esc_attr( $cornerclass ); ?>" aria-label="contact us today">      
    <div class="cta-banner-inner">
        <div class="container">
            <div class="row"> 
                <div class="col-md-6">
                    <div class="cta-form-wrapper">
                        <div class="cta-banner-info-wrapper">
                            <div class="cta-banner--info white-bg d-flex flex-column row-gap-24 align-items-start">
                                <header>
                                    <div class="section-header">
                                        <?php if ( $micro_title ) : ?>
                                            <h2 class="micro"><?php echo esc_html( $micro_title ); ?></h2>
                                            <h3 class="lvl-1"><?php echo esc_html( $headline ); ?></h3>
                                        <?php else : ?>
                                            <h2><?php echo esc_html( $headline ); ?></h2>
                                        <?php endif; ?>
                                    </div>
                                </header>
                                <?php if(!empty( $ppc_page_override_link )) : ?>
                                    <a class="btn btn--primary" href="<?php echo esc_url( $ppc_page_override_link['url'] ); ?>" target="<?php echo esc_attr( $ppc_page_override_link['target'] ?: '_self' ); ?>" aria-label="Contact Us"><?php echo esc_html( $ppc_page_override_link['title'] ); ?></a>
                                <?php elseif ( $override_cta ) : ?>
                                    <a class="btn btn--primary" href="<?php echo esc_url( $override_cta['url'] ); ?>" target="<?php echo esc_attr( $override_cta['target'] ?: '_self' ); ?>" aria-label="Contact Us"><?php echo esc_html( $override_cta['title'] ); ?></a>
                                <?php elseif ( $primary_cta ) : ?>
                                    <a class="btn btn--primary" href="<?php echo esc_url( $primary_cta['url'] ); ?>" target="<?php echo esc_attr( $primary_cta['target'] ?: '_self' ); ?>" aria-label="Contact Us"><?php echo esc_html( $primary_cta['title'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="cta-img">
            <picture class="cta-banner-bg">
                <?php if ( $override_image ) : ?>
                    <?php echo wp_get_attachment_image( $override_image, $override_image_size ); ?>
                <?php elseif ( $def_image ) : ?>
                    <?php echo wp_get_attachment_image( $def_image, $def_image_size ); ?>
                <?php endif; ?>
            </picture>
        </div>
    </div>
</section>

