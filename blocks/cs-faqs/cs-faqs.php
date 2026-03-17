<?php

/**

 * Block template file: cs-faqs.php

 *

 * Cs Two Column Block Template.

 *

 * @param   array $block The block settings and attributes.

 * @param   string $content The block inner HTML (empty).

 * @param   bool $is_preview True during AJAX preview.

 * @param   (int|string) $post_id The post ID this block is saved to.

 */

// Create id attribute allowing for custom "anchor" value.



$id = 'cs-faqs-' . $block['id'];

if ( ! empty($block['anchor'] ) ) {

    $id = $block['anchor'];

}



// Create class attribute allowing for custom "className" and "align" values.

$classes = 'block-cs-faqs';

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

$background_style = get_field( 'background_style' );

$solid_color = get_field( 'solid_color' );

$gradient_type = get_field( 'gradient_type' );

$select_faqs = get_field( 'select_faqs' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?> <?php echo $background_style === 'solid-color' ? $solid_color : $gradient_type; ?>">

	<div class="container">

        <div class="row align-items-center justify-content-center">

            <div class="col-lg-8">

				<div class="faqs-content-inner">
                    <div class="faqs-content-block">

                    <?php if ( $microTitle ) : ?>

                        <div class="section-header ta-c">

                            <h2 class="micro"><?php echo $microTitle;?></h2>
                            <?php if ( $mainTitle ) : ?>
                            <h3 class="lvl-2"><?php echo $mainTitle;?></h3>
                            <?php endif ; ?>
                        </div>

                    <?php elseif ( $mainTitle ) :  ?>

                        <div class="section-header ta-c">

                            <h2><?php echo $mainTitle;?></h2>

                        </div>

                    <?php endif ; ?>

                    <?php if ( $section_cta ) : ?>

                        <div class="btn-wrap ta-c">

                            <a class="btn btn--secondary" 

                                    href="<?php echo esc_url( $section_cta['url'] ); ?>" 

                                    target="<?php echo esc_attr( $section_cta['target'] ); ?>" 

                                    aria-label="Open Link">

                                <span><?php echo esc_html( $section_cta['title'] ); ?></span>

                            </a>

                        </div>

                    <?php endif; ?>

                    </div>	


                    <div class="faqs-wrapper">

                        <?php if (!empty($select_faqs)) : ?> 

                            <div class="faqs__wrapper d-flex flex-column">

                                <?php foreach ( $select_faqs as $faq_post ) : ?>

                                    <?php setup_postdata( $faq_post ); ?>



                                    <div class="faq-single bg-bas-lig">

                                        <div class="faq-title d-flex align-items-center col-gap-3">

                                            <div class="plus"></div>

                                            <h4 class="ff-body"><?php echo get_the_title( $faq_post->ID ); ?></h4>

                                        </div>



                                        <div class="faq-content">

                                            <div class="faq-content_wrapper pt-3">

                                                <?php echo apply_filters('the_content', $faq_post->post_content); ?>

                                            </div>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                                <?php wp_reset_postdata(); ?>

                            </div>

                        <?php endif; ?>

                    </div>

                    </div>

            </div>

        </div>

    </div>

</section>