<?php
/**
 * Block template file: tb-form.php
 *
 * Tb Form Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-form-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-form';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$section_spacing = get_field('section_spacing') ?: [];
$pt     = $section_spacing['section_top_spacing'] ?? '';
$pb  = $section_spacing['section_bottom_spacing'] ?? '';
$form_title = get_field( 'form_title' );
$form_id = get_field( 'form_id' );
$enable_text = get_field( 'enable_text' );
$shortcode = get_field( 'shortcode' );
?>
<section id="form-content-<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-11">
                <div id="form" class="form-wrapper bg-bas-lig">
                    <?php if ( $form_title ) : ?>
                        <h3><?php echo $form_title; ?></h3>
                    <?php endif; ?>
                    <?php if($enable_text){
                        echo do_shortcode($shortcode);
                    } else {
                        echo do_shortcode('[gravityform id="' . $form_id . '" title="false" description="false" ajax="false"]');
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>