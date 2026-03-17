<?php
/**
 * Block template file: tb-services-block.php
 *
 * Tb Services Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-services-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-services-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$microTitle = get_field('micro_title');
$mainTitle  = get_field('main_title');
$section_cta = get_field( 'section_cta_button');
$services_select = get_field( 'services_select');
$layout = get_field( 'select_layout');
$card_links = get_field( 'turn_off_card_links_ppc');
if ( $layout == true) {
	$ltClass = 'featured-layout';
} else {
	$ltClass = 'default-layout';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="featured-service <?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $ltClass ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?>">
	<div class="container">
  		<?php if ( $layout == true ) : ?>
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="content-block d-flex flex-column flex-lg-row row-gap-24 align-items-start align-items-lg-end justify-content-between cs-pb-md">
						<?php if ( $microTitle ) : ?>
							<div class="section-header">
								<h2 class="micro"><?php echo $microTitle;?></h2>
								<?php if ( $mainTitle ) : ?>
								<h3 class="lvl-2"><?php echo $mainTitle;?></h3>
								<?php endif; ?>
							</div>
						<?php elseif ( $mainTitle ) : ?>
							<div class="section-header">
								<h2><?php echo $mainTitle;?></h2>
							</div>
						<?php endif ; ?>
						<?php if ( $section_cta ) : ?>
							<div class="btn-wrap">
								<a class="btn btn--secondary" href="<?php echo esc_url( $section_cta['url'] ); ?>" target="<?php echo esc_attr( $section_cta['target'] ); ?>" aria-label="Open Link">
									<span><?php echo esc_html( $section_cta['title'] ); ?></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (have_rows('services_select')) : ?>
			<div class="row">
				<div class="col-12">
					<div class="service-inner">
						<?php while (have_rows('services_select')) : the_row();
							$service_description = get_sub_field( 'service_description' );
							$page = get_sub_field('page'); 
							if ($page) : 
							$post = $page; 
								setup_postdata($post); ?>
								<div class="service-block">
									<?php if ( $card_links == false) : ?>         
									<a aria-label="Read about <?php echo get_the_title($post->ID); ?>" href="<?php the_permalink($post->ID); ?>" class="card--block-link d-block">
										<?php endif; ?>
										<div class="card--service-blocks pos-rel d-flex align-items-end">
											<?php if (has_post_thumbnail($post->ID)) { ?>
												<picture class="service_img bg--image-abs">                                          
													<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>                                           
												</picture>
											<?php } ?>
											<div class="service-block-wrapper">
												<div class="service-title d-flex align-items-center">											
													<?php if (get_sub_field('custom_title')) : ?>
														<h3 class="tt-ca"><?php the_sub_field('custom_title'); ?></h3>
													<?php else : ?>
														<h3 class="tt-ca"><?php echo get_the_title($post->ID); ?></h3>
													<?php endif; ?>
												</div>
												<div class="services-info">
													<?php $terms = get_the_terms($post->ID, 'service-type');
														if ($terms) : ?>
														<div class="chip-wrapper">												
															<?php foreach ($terms as $term) : ?>
																<span class="btn btn--chip">
																	<?php echo esc_html($term->name); ?>
																</span>
															<?php endforeach; ?>											
														</div>
													<?php endif; ?>
													<?php if (!empty($service_description)) : ?>
														<div class="editor-content c-wt">
															<p>
																<?php echo $service_description; ?>
															</p>
														</div>
													<?php endif; ?>  
													<?php if ( $card_links == false) : ?>                                          
													<p class="btn btn--tertiary">Learn More</p>
													<?php endif; ?>  
												</div>
											</div>
										</div>
										<?php if ( $card_links == false) : ?>         
										</a>
										<?php endif; ?>
								</div>
								<?php wp_reset_postdata(); 
							endif; 
						endwhile; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

